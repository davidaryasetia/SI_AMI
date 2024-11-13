<?php

namespace App\Http\Controllers\DataAmiController
;

use App\Http\Controllers\Controller;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;

class DataUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $data_user = User::get();
        return view('data_ami.data_user.user', [
            'title' => 'Data User',
            'data_user' => $data_user,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('data_ami.data_user.create', [
            'title' => 'Tambah User Pengguna',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = new User();
        $user->nama = $request->nama;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);

        // Set nilai boolean berdasarkan checkbox
        $user->is_admin = in_array('admin', $request->roles) ? true : false;
        $user->is_audite = in_array('audite', $request->roles) ? true : false;
        $user->is_auditor = in_array('auditor', $request->roles) ? true : false;

        $user->save();

        return redirect()->route('data_user.index')->with('success', 'User berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data_user = User::findOrFail($id);

        return view('data_ami.data_user.edit', [
            'title' => 'Edit Data User',
            'data_user' => $data_user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email',
            'roles' => 'nullable|array', // roles bisa kosong jika tidak memilih apapun
            'password' => 'nullable|string',
        ]);

        $data_user = User::findOrFail($id);

        // Set nilai yang diinput
        $data_user->nama = $request->input('nama');
        $data_user->email = $request->input('email');

        // Reset kolom boolean
        $data_user->is_admin = false;
        $data_user->is_audite = false;
        $data_user->is_auditor = false;

        // Jika ada role yang dipilih, atur nilai boolean sesuai pilihan
        if ($request->has('roles')) {
            $roles = $request->input('roles');
            $data_user->is_admin = in_array('admin', $roles) ? true : false;
            $data_user->is_audite = in_array('audite', $roles) ? true : false;
            $data_user->is_auditor = in_array('auditor', $roles) ? true : false;
        }

        // Update password hanya jika checkbox reset_password di-check
        if ($request->has('reset_password') && $request->filled('password')) {
            $data_user->password = Hash::make($request->password);
        }

        // Simpan perubahan ke database
        if ($data_user->save()) {
            return redirect('/data_user')->with(['success' => 'Data User Berhasil Diperbarui !!']);
        } else {
            return redirect('/data_user')->with(['error' => 'Data User Gagal Diperbarui !!!']);
        }
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data_user = User::destroy($id);

        if ($data_user) {
            return redirect('/data_user')->with('success', 'Data User Berhasil Dihapus !!!');
        } else {
            return redirect('/data_user')->with('error', 'Data User Berhasil Dihapus !!!');
        }
    }

    public function resetStatus()
    {
        // Dapatkan user_id dari user yang sedang login
        $currentUserId = auth()->user()->user_id;

        // Reset semua status kecuali untuk user yang sedang login
        User::where('user_id', '!=', $currentUserId)->update([
            'is_admin' => false,
            'is_audite' => false,
            'is_auditor' => false
        ]);

        return redirect()->route('data_user.index')->with('success', 'Status user berhasil direset kecuali user yang sedang login.');
    }

}
