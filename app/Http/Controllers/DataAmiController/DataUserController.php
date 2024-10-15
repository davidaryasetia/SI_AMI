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

        $data_user = User::with([
            'audite:audite_id,user_id,unit_id',
            'auditor1:auditor_id,auditor_1,unit_id',
            'auditor2:auditor_id,auditor_2,unit_id'
        ])->get();
        // dump($data_user->toArray());
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
            'nama' => 'required|string|max:255',
            'nip' => 'required',
            'email' => 'required|string|max:255',
            'status_admin' => 'required',
            'password' => 'required|string|max:255',
        ]);

        $exist_email = User::where('email', $request->input('email'))->first();

        if ($exist_email) {
            return redirect('/data_user')->with(['error' => 'Username Email Sudah Ada !!!']);
        }

        $data_user = [
            'nama' => $request->input('nama'),
            'email' => $request->input('email'),
            'nip' => $request->input('nip'),
            'status_admin' => $request->input('status_admin'),
            'password' => Hash::make($request->password),
        ];

        $insert_data_user = User::create($data_user);

        if ($insert_data_user) {
            return redirect('/data_user')->with(['success' => 'User Register Sukses !!!']);
        } else {
            return redirect('/data_user')->with(['error' => 'Error Register Data User !!!']);
        }
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
        $request->validate([
            'nama' => 'required|string|max:255', 
            'nip' => 'required|string|max:20', 
            'email' => 'required|string|email', 
            'status_admin' => 'required|boolean', 
            'password' => 'nullable|string', 
        ]);

        $data_user = User::findOrFail($id);

        $data_user->nama = $request->input('nama');
        $data_user->email = $request->input('email');
        $data_user->nip = $request->input('nip');
        $data_user->status_admin = $request->input('status_admin');

        if ($request->filled('password')){
            $data_user->password = Hash::make($request->password);
        }

        if ($data_user->save()){
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

        if ($data_user){
            return redirect('/data_user')->with('success', 'Data User Berhasil Dihapus !!!');
        } else {
            return redirect('/data_user')->with('error', 'Data User Berhasil Dihapus !!!');
        }
    }
}
