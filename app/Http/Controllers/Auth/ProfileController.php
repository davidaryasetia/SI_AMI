<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        return view('auth.profile.profile', [
            'title' => 'Profile',
            'user' => $user,
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
        return view('auth.profile.edit', [
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
            if (Auth::user()->foto_gambar) {
                Storage::disk('s3')->delete(Auth::user()->foto_gambar);
            }

            $filePath = $request->file('foto_gambar')->store('profile_user', 's3', );
            $user->foto_gambar = $filePath;
        }
        // Simpan perubahan
        $user->save();
        return redirect()->route('profile.index')->with('success', 'Profil berhasil diperbarui');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
