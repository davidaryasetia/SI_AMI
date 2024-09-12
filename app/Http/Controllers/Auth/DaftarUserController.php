<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DaftarUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $data_user = User::select(
            'user.nama as nama', 
            'user.email as email', 
            'unit.nama_unit as nama_unit', 
            'user.status_admin as status'
        )
            ->join('unit', 'user.unit_id', '=', 'unit.unit_id')
            ->get();

        return view('auth.daftar_user.user', [
            'title' => 'Data User', 
            'data_user' => $data_user, 
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auth.daftar_user.create', [
            'title' => 'Tambah User Pengguna', 
        ]);
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
