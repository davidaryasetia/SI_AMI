<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\PeriodePelaksanaan;
use App\Models\User;
use Auth;
use Hash;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Ambil periode terbaru dengan status "Sedang Berjalan"
        $periodeTerbaru = PeriodePelaksanaan::where('status', 'Sedang Berjalan')
            ->orderBy('tanggal_pembukaan_ami', 'desc')
            ->first();

        if (!$periodeTerbaru) {
            $periodeTerbaru = PeriodePelaksanaan::orderBy('tanggal_pembukaan_ami', 'desc')->first();
        }

        $jadwalAmiId = $periodeTerbaru ? $periodeTerbaru->jadwal_ami_id : null;


        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Cari user berdasarkan email
        $user = User::where('email', $request->email)->first();

        // Jika user ditemukan dan password benar
        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);
            session(['user_id' => $user->user_id]);

            // Simpan data jadwal AMI ke dalam session
            session(['jadwal_ami_id' => $jadwalAmiId]);

            // Tentukan role yang dimiliki user berdasarkan jadwal AMI
            $roles = [];
            $unitData = [];

            // -------------------------- Filter Audite Data by jadwal_ami_id --------------------------
            // -------------------------- Filter Audite Data --------------------------
            if ($jadwalAmiId) {
                $auditeData = $user->audite()
                    ->where('jadwal_ami_id', $jadwalAmiId)
                    ->with('units', 'units_cabang')
                    ->first();

                if ($auditeData) {
                    $roles[] = 'audite';
                    $unitData['audite'] = [
                        'unit_id' => $auditeData->units->unit_id ?? null,
                        'nama_unit' => $auditeData->units->nama_unit ?? null,
                        'units_cabang' => $auditeData->units_cabang ? [
                            'unit_cabang_id' => $auditeData->units_cabang->unit_cabang_id,
                            'nama_unit_cabang' => $auditeData->units_cabang->nama_unit_cabang
                        ] : null,
                    ];
                }
            }

            // -------------------------- Filter Auditor Data --------------------------
            $auditor1Units = $user->auditor1()
                ->where('jadwal_ami_id', $jadwalAmiId)
                ->with('units')
                ->get();

            $auditor2Units = $user->auditor2()
                ->where('jadwal_ami_id', $jadwalAmiId)
                ->with('units')
                ->get();

            if ($auditor1Units->isNotEmpty() || $auditor2Units->isNotEmpty()) {
                $roles[] = 'auditor';
                $unitData['auditor'] = [];

                foreach ($auditor1Units as $auditorData) {
                    $unitData['auditor'][] = [
                        'unit_id' => $auditorData->units->unit_id ?? null,
                        'nama_unit' => $auditorData->units->nama_unit ?? null,
                        'status_auditor' => 'auditor_1'
                    ];
                }

                foreach ($auditor2Units as $auditorData) {
                    $unitData['auditor'][] = [
                        'unit_id' => $auditorData->units->unit_id ?? null,
                        'nama_unit' => $auditorData->units->nama_unit ?? null,
                        'status_auditor' => 'auditor_2'
                    ];
                }
            }

            // -------------------------- Tambahkan Role Admin jika User Adalah Admin --------------------------
            if ($user->is_admin) {
                $roles[] = 'admin';
            }

            // Simpan data ke dalam session
            session(['roles' => $roles]);

            if (!empty($roles)) {
                session(['active_role' => $roles[0]]);
            }

            session($unitData);
            session(['jadwal_ami_nama' => $periodeTerbaru ? $periodeTerbaru->nama_periode_ami : 'Tidak Ada Jadwal Aktif']);

            // -------------------------- Pilih Role --------------------------
            if (empty($roles)) {
                return redirect()->route('errors.403');
            } elseif (count($roles) === 1) {
                return $this->redirectToRole($roles[0]);
            } else {
                return redirect()->route('choose.role');
            }
        } else {
            return redirect()->back()->with('error', 'Email atau password salah !!!');
        }
    }

    private function redirectToRole($role)
    {
        switch ($role) {
            case 'admin':
                return redirect('/home');
            case 'auditor':
                return redirect('/home/auditor');
            case 'audite':
                return redirect('/home/audite');
            default:
                return redirect()->route('login')->with('error', 'Anda tidak memiliki akses role yang valid');
        }
    }

    public function chooseRole()
    {
        $roles = session('roles', []);

        if (empty($roles)) {
            return redirect()->route('errors.403');
        }

        if (count($roles) === 1) {
            return $this->redirectToRole($roles[0]);
        }

        return view('choose_role.choose_role', compact('roles'));
    }

    public function selectRole(Request $request)
    {
        $role = $request->input('role');
        if (in_array($role, session('roles', []))) {
            session(['active_role' => $role]);
            return $this->redirectToRole($role);
        }

        return redirect()->route('errors.403');
    }

    public function switchRole(Request $request)
    {
        $newRole = $request->input('role');

        // Cek apakah role baru ini ada di array roles dalam session
        if (in_array($newRole, session('roles', []))) {
            session(['active_role' => $newRole]);
            return response()->json(['status' => 'success', 'message' => 'Role changed successfully.']);
        }

        return response()->json(['status' => 'error', 'message' => 'Invalid role.'], 400);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
