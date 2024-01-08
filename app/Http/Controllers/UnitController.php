<?php

namespace App\Http\Controllers;
// import model post
use \App\Models\Unit;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

// import Facade "Storage"
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;


class UnitController extends Controller
{
    public function unit(): View{
        // get unit
        $units = Unit::orderBy('unit_id')->paginate(5);

        // render view to unit
        return view('/unit', [
            "title" => "Unit Kerja"
        ], compact('units'));
    }

    public function add_unit(): View{
        return view('add_unit', [
            "title" => "Tambah Unit Kerja"
        ]);
    }

    public function store(Request $request): RedirectResponse{
        $this->validate($request, [
            'nama_unit'=>'required|min:3|unique:unit',
        ]);

        // insert data
        Unit::create([
            'nama_unit'=>$request->nama_unit,
        ]);

        return redirect('/unit')->with(['success-unit'=>'Data Unit Berhasil Ditambahkan']);
    }

    public function edit(string $id): View{
        $unit = Unit::findOrFail($id);
        return view('edit_unit', compact('unit'));
    }

    public function update(Request $request, $id): RedirectResponse {
        $this->validate($request, [
            'nama_unit'=>'required|min:3',
        ]);

        $unit = Unit::findOrFail($id);
        $unit->update([
            'nama_unit'=>request->nama_unit,
        ]);

        return redirect()->route('unit')->with(['success'=>'Data Berhasil Diubah']);
    }

}
