<?php

namespace App\Http\Controllers\DataAuditeController;

use App\Http\Controllers\Controller;
use App\Models\Auditor;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PersetujuanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $date = Carbon::now()->format('d F Y');
        $unitId = session('audite.unit.unit_id');

        $auditorData = Auditor::where('unit_id', $unitId)->first();
        if ($auditorData) {
            $auditor_1 = User::find($auditorData->auditor_1);
            $auditor_2 = User::find($auditorData->auditor_2);

            $auditor1 = $auditor_1 ? $auditor_1->nama : null;
            $auditor2 = $auditor_2 ? $auditor_2->nama : null;
        }



        return view('data_audite.persetujuan.persetujuan', [
            'title' => 'persetujuan',
            'date' => $date,
            'auditor1' => $auditor1,
            'auditor2' => $auditor2,
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
