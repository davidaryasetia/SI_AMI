<?php

namespace App\Http\Controllers;
// import model post
use \App\Models\Unit;

// return type redirectResponse
use Illuminate\Http\RedirectResponse;

// return type view
use Illuminate\View\View;

// import Facade "Storage"
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;


class UnitController extends Controller
{
    public function unit(): View{
        // get unit
        $units = Unit::latest()->paginate(5);

        // render view to unit
        return view('unit', compact('units'));
    }

    public function add_unit(): View{
        return view('add_unit');
    }

    public function store(Request $request): RedirectResponse{
        $this->validate($request, [
            'nama_unit'=>'required|min:3',
        ]);

        // insert data
        Unit::create([
            'nama_unit'=>$request->nama_unit,
        ]);

        return redirect()->route('unit')->with(['Success'=>'Data Unit Berhasil Ditambahkan']);
    }


}
