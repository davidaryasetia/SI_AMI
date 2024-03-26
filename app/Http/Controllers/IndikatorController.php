<?php

namespace App\Http\Controllers;
use App\Models\IndikatorKinerjaUnit;
use App\Models\Unit;
use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class IndikatorController extends Controller
{
    /**
     * Display sting of the resource.
     */
    public function index()
    {
        $IndikatorKinerjaUnit = DB::table('unit AS u')
                                ->join('indikator_kinerja_unit as iku', 'indikator_kinerja_unit_id', '=', 'indikator')
                                ->join('auditor', 'auditor_id', '=', )
                                ->select('kode','indikator_kinerja_unit_kerja','satuan','target')
                                ->paginate(15);


        return view('data_audit.indikator_unit_kerja.indikator', [
            'title' => 'Indikator Kinerja Unit',
            'units' => Unit::all(),
            'IndikatorKinerjaUnit' => DB::table('unit')
                                        ->join('indikator_kinerja_unit', 'indikator_kinerja_unit_id', '=', 'indikator_')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(IndikatorKinerjaUnit $indikatorKinerjaUnit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(IndikatorKinerjaUnit $indikatorKinerjaUnitindikator)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, IndikatorKinerjaUnit $indikatorKinerjaUnitor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(IndikatorKinerjaUnit $indikatorKinerjaUnit)
    {
        //
    }
}
