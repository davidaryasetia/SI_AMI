<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Auth;
use Hash;
use Illuminate\Http\Request;

class ProfileAuditeController extends Controller
{
   /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('data_audite.profile_audite.profile_audite', [
            'title' => 'Profile'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id)
    {
        // Dapatkan user berdasarkan ID yang sedang login
        $user = Auth::user();

        return view('data_audite.profile.edit', [
            'title' => 'Edit Profile',
            'user' => $user,
        ]);
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'nullable|string|min:8|confirmed',
            'foto_gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();  // Ambil data user yang sedang login

        // Update nama dan email
        $user->nama = $request->input('nama');
        $user->email = $request->input('email');

        // Jika password diisi, update password
        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        // Jika gambar di-upload, cek apakah ada foto lama, lalu hapus sebelum menyimpan yang baru
        if ($request->hasFile('foto_gambar')) {
            // Hapus foto lama jika ada
            if ($user->foto_gambar && \Storage::exists('public/profile/' . $user->foto_gambar)) {
                \Storage::delete('public/profile/' . $user->foto_gambar);
            }

            // Simpan foto baru
            $file = $request->file('foto_gambar');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/profile', $fileName);  // Simpan di folder storage/app/public/profile
            $user->foto_gambar = $fileName;
        }

        // Simpan perubahan
        $user->save();

        return redirect()->route('profile_audite.index')->with('success', 'Profil berhasil diperbarui');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
