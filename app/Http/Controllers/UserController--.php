<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Unit;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('data_audit.data_user_pengguna.user', [
            'title' => 'Data User',
            'users' => User::orderBy('user_id')->paginate(15)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('data_audit.data_user_pengguna.create', [
            'title' => 'Tambah Data Pengguna',
            'units' => Unit::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
           'unit_id' => 'required',
           'nip' => 'required|unique:user',
           'nama_lengkap' => 'required|unique:user|min:3|max:128',
           'email' => 'required|unique:user|email:dns',
           'password' => 'required|min:5|max:255',
           'status_admin' => 'required',
           'status_auditor' => 'required',
           'unit_id_diaudit' => 'required',
           'status_audite' => 'required'
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        return redirect('/data_audit/data_user_pengguna')->with('success', 'Tambah Data User Sukses');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
