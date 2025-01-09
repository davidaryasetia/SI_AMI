<?php

namespace App\Http\Controllers\DataAmiController;

use App\Http\Controllers\Controller;
use App\Models\IndikatorKinerjaUnit;
use App\Models\IndikatorKinerjaUnitKerja;
use App\Models\PeriodePelaksanaan;
use App\Models\TransaksiData;
use App\Models\Unit;
use Illuminate\Http\Request;

class DataIndikatorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // -----------------------------------------------Logic untuk mendapatkan Periode Terbaru---------------
        $jadwalPeriode = PeriodePelaksanaan::orderBy('tanggal_pembukaan_ami', 'desc')->get();
        $selectedJadwalAmiId = $request->input('jadwal_ami_id');

        // Mengambil data semua unit untuk ditampilkan di dropdown
        if (!$selectedJadwalAmiId) {
            $periodeTerbaru = PeriodePelaksanaan::where('status', 'Sedang Berjalan')
                ->orderBy('tanggal_pembukaan_ami', 'desc')
                ->first();

            if (!$periodeTerbaru) {
                $periodeTerbaru = PeriodePelaksanaan::orderBy('tanggal_pembukaan_ami', 'desc')->first();
            }

            $selectedJadwalAmiId = $periodeTerbaru ? $periodeTerbaru->jadwal_ami_id : null;
        }

        $units = Unit::orderBy('unit_id')
            ->where('jadwal_ami_id', $selectedJadwalAmiId)
            ->get();

        // Mendapatkan nilai unit_id dari input form
        $unitId = $request->input('unit_id');

        $data_ami = IndikatorKinerjaUnitKerja::select(
            'indikator_kinerja_unit_kerja_id',
            'kode_ikuk',
            'isi_indikator_kinerja_unit_kerja',
            'satuan_ikuk',
            'target1',
            'target2',
            'link',
            'tipe',
            'unit.nama_unit as nama_unit',
            'unit.unit_id as unit_id',
        )
            ->join('unit', 'indikator_kinerja_unit_kerja.unit_id', '=', 'unit.unit_id')
            ->where('indikator_kinerja_unit_kerja.jadwal_ami_id', $selectedJadwalAmiId);


        if ($unitId) {
            // Anda harus menentukan tabel untuk kolom unit_id di dalam klausa where
            $data_ami->where('indikator_kinerja_unit_kerja.unit_id', $unitId);
        }

        // Ambil data yang sudah difilter dan kirimkan ke view
        $filteredDataAMI = $data_ami->get();

        return view('data_ami.data_indikator.indikator', [
            'title' => 'Instrument IKUK',
            'units' => $units,
            'data_ami' => $filteredDataAMI,
            'unit_id' => $unitId,
            'jadwal_ami_id' => $selectedJadwalAmiId,
            'jadwalPeriode' => $jadwalPeriode,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('data_ami.data_indikator.create', [
            'title' => 'Tambah Indikator Unit Kerja',
        ]);
    }

    public function create_ikuk_id(string $id)
    {
        $data_unit = Unit::select(
            'unit_id',
            'nama_unit'
        )
            ->where('unit.unit_id', $id)
            ->first();

        return view('data_ami.data_indikator.create', [
            'title' => 'Tambah Indikator Kinerja Unit Kerja',
            'data' => $data_unit
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'unit_id' => 'required',
            'kode_ikuk' => 'required',
            'isi_indikator_kinerja_unit_kerja' => 'required',
            'satuan_ikuk' => 'required',
            'target1' => 'nullable',
            'target2' => 'nullable',
            'link' => 'nullable',
            'tipe' => 'nullable',
        ]);

        $unit_id = $request->input('unit_id');
        $kode_ikuk = $request->input('kode_ikuk');
        $isi_indikator_kinerja_unit_kerja = $request->input('isi_indikator_kinerja_unit_kerja');
        $satuan_ikuk = $request->input('satuan_ikuk');
        $target_ikuk = $request->input('target_ikuk');
        $target1 = $request->input('target1');
        $target2 = $request->input('target2');
        $link = $request->input('link');
        $tipe = $request->input('tipe');

        // -------------------------------- Cek Periode "Sedang Berjalan" --------------------------------
        $periodeTerbaru = PeriodePelaksanaan::where('status', 'Sedang Berjalan')
            ->orderBy('tanggal_pembukaan_ami', 'desc')
            ->first();


        if (!$periodeTerbaru) {
            return redirect()->to('/data_indikator?unit_id=' . $unit_id)->with('error', 'Tidak ada periode terbuka. Silakan buat periode terlebih dahulu.');
        }

        $jadwalAmiId = $periodeTerbaru->jadwal_ami_id;
        $data_indikator_kinerja_unit = [];
        $transaksi_data = [];

        foreach ($kode_ikuk as $index => $kode) {
            // Tambahkan indikator kinerja unit kerja ke array
            $indikator = [
                'jadwal_ami_id' => $jadwalAmiId,
                'unit_id' => $unit_id,
                'kode_ikuk' => $kode,
                'isi_indikator_kinerja_unit_kerja' => $isi_indikator_kinerja_unit_kerja[$index],
                'satuan_ikuk' => $satuan_ikuk[$index],
                'target1' => $target1[$index],
                'target2' => $target2[$index],
                'link' => $link[$index],
                'tipe' => $tipe[$index],
                'created_at' => now(),
                'updated_at' => now()
            ];
            $data_indikator_kinerja_unit[] = $indikator;
        }

        // Insert indikator ke database
        $insert_ikuk = IndikatorKinerjaUnitKerja::insert($data_indikator_kinerja_unit);

        if ($insert_ikuk) {
            // Ambil indikator yang baru saja dimasukkan
            $indikators = IndikatorKinerjaUnitKerja::where('unit_id', $unit_id)
                ->whereIn('kode_ikuk', $kode_ikuk)
                ->get();

            foreach ($indikators as $indikator) {
                // Tambahkan transaksi data berdasarkan periode terbuka dan indikator baru
                $transaksi_data[] = [
                    'indikator_kinerja_unit_kerja_id' => $indikator->indikator_kinerja_unit_kerja_id,
                    'jadwal_ami_id' => $jadwalAmiId,
                    'riwayat_nama_unit' => null,
                    'hasil_audit' => null,
                    'status_pengisian_audite' => false,
                    'status_pengisian_auditor' => false,
                    'status_finalisasi_auditor1' => false,
                    'status_finalisasi_auditor2' => false,
                    'realisasi_ikuk' => null,
                    'analisis_usulan_keberhasilan' => null,
                    'target_lama' => null,
                    'usulan_target_tahun_depan' => null,
                    'strategi_pencapaian' => null,
                    'sarpras_yang_dibutuhkan' => null,
                    'faktor_pendukung' => null,
                    'faktor_penghambat' => null,
                    'akar_masalah' => null,
                    'tindak_lanjut' => null,
                    'data_dukung' => null,
                    'saran_auditor1' => null,
                    'saran_auditor2' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            // Insert transaksi data ke database
            TransaksiData::insert($transaksi_data);

            return redirect()->to('/data_indikator?unit_id=' . $unit_id)->with('success', 'Data Indikator dan Transaksi Data Berhasil Ditambahkan !!!');
        } else {
            return redirect()->to('/data_indikator?unit_id=' . $unit_id)->with('error', 'Data Indikator Gagal Ditambahkan !!!');
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
        $edit_data_ami = IndikatorKinerjaUnitKerja::select(
            'indikator_kinerja_unit_kerja_id',
            'kode_ikuk',
            'isi_indikator_kinerja_unit_kerja',
            'satuan_ikuk',
            'target1',
            'target2',
            'link',
            'tipe',
            'unit.nama_unit as nama_unit',
            'unit.unit_id as unit_id',
        )
            ->where('indikator_kinerja_unit_kerja_id', $id)
            ->join('unit', 'indikator_kinerja_unit_kerja.unit_id', '=', 'unit.unit_id')
            ->first();

        $data_ikuk = IndikatorKinerjaUnitKerja::where('indikator_kinerja_unit_kerja_id', $id)->firstOrFail();
        return view('data_ami.data_indikator.edit', [
            'title' => 'Edit Data Indikator',
            'data' => $edit_data_ami,
        ]);
    }

    /**
     * Edit Semua Indikator Kinerja Unit Kerja
     */
    public function editAllByUnit($unitId)
    {
        $data_indikator = IndikatorKinerjaUnitKerja::where('unit_id', $unitId)->get();
        $total_indikator = $data_indikator->count();
        $unit = Unit::findOrFail($unitId);
        return view('data_ami.data_indikator.edit_all', [
            'title' => 'Edit All',
            'unit' => $unit,
            'data_indikator' => $data_indikator,
            'total_indikator' => $total_indikator ?? 0, 
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'kode_ikuk' => 'required',
            'isi_indikator_kinerja_unit_kerja' => 'required',
            'satuan_ikuk' => 'required',
            'target1' => 'nullable|integer',
            'target2' => 'nullable|integer',
            'link' => 'nullable',
            'tipe' => 'nullable',
        ]);

        $unit_id = $request->input('unit_id');

        // -------------------------------- Cek Periode "Sedang Berjalan" --------------------------------
        $periodeTerbaru = PeriodePelaksanaan::where('status', 'Sedang Berjalan')
            ->orderBy('tanggal_pembukaan_ami', 'desc')
            ->first();

        if (!$periodeTerbaru) {
            return redirect()->to('/data_indikator?unit_id=' . $unit_id)->with('error', 'Tidak ada periode terbuka. Silakan buat periode terlebih dahulu.');
        }

        $jadwalAmiId = $periodeTerbaru->jadwal_ami_id;


        $data_indikator = IndikatorKinerjaUnitKerja::where('indikator_kinerja_unit_kerja_id', $id)
            ->where('jadwal_ami_id', $jadwalAmiId)
            ->firstOrFail();

        $data_indikator->update([
            'kode_ikuk' => $request->input('kode_ikuk'),
            'isi_indikator_kinerja_unit_kerja' => $request->input('isi_indikator_kinerja_unit_kerja'),
            'satuan_ikuk' => $request->input('satuan_ikuk'),
            'target1' => $request->input('target1'),
            'target2' => $request->input('target2'),
            'link' => $request->input('link'),
            'tipe' => $request->input('tipe'),
        ]);

        if ($data_indikator) {
            return redirect()->to('/data_indikator?unit_id=' . $unit_id)->with('success', 'Data Indikator Kinerja Unit Berhasil Diperbarui !!!');
        } else {
            return redirect()->to('/data_indikator?unit_id=' . $unit_id)->with('error', 'Data Indikator Kinerja Unit Gagal Diperbarui !!!');
        }
    }

    public function updateAllByUnit(Request $request, $unitId)
    {
        $request->validate([
            'indikator.*.id' => 'integer',
            'indikator.*.kode_ikuk' => 'string',
            'indikator.*.isi_indikator_kinerja_unit_kerja' => 'string',
            'indikator.*.satuan_ikuk' => 'nullable|string',
            'indikator.*.target1' => 'nullable',
            'indikator.*.target2' => 'nullable',
            'indikator.*.link' => 'nullable',
            'indikator.*.tipe' => 'nullable',
        ]);

        $updateSuccess = true;
        foreach ($request->indikator as $indikatorData) {
            $indikator = IndikatorKinerjaUnitKerja::find($indikatorData['id']);
            if ($indikator) {
                $update = $indikator->update([
                    'kode_ikuk' => $indikatorData['kode_ikuk'],
                    'isi_indikator_kinerja_unit_kerja' => $indikatorData['isi_indikator_kinerja_unit_kerja'],
                    'satuan_ikuk' => $indikatorData['satuan_ikuk'],
                    'target1' => $indikatorData['target1'],
                    'target2' => $indikatorData['target2'],
                    'link' => $indikatorData['link'],
                    'tipe' => $indikatorData['tipe'],
                ]);

                if (!$update) {
                    $updateSuccess = false;
                    break;
                }
            } else {
                $updateSuccess = false;
                break;
            }
        }

        if ($updateSuccess) {
            return redirect()->to('/data_indikator?unit_id=' . $unitId)
                ->with('success', 'Data Indikator Kinerja Unit Berhasil Diperbarui !!!');
        } else {
            return redirect()->to('/data_indikator?unit_id=' . $unitId)
                ->with('error', 'Data Indikator Kinerja Unit Gagal Diperbarui !!!');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function destroyWithUnit($indikator_id, $unit_id)
    {
        $delete_data_ikuk = IndikatorKinerjaUnitKerja::destroy($indikator_id);

        if ($delete_data_ikuk) {
            return redirect()->to('/data_indikator?unit_id=' . $unit_id)->with('success', 'Data Indikator Kinerja Unit Berhasil Dihapus !!!');
        } else {
            return redirect()->to('/data_indikator?unit_id=' . $unit_id)->with('error', 'Data Indikator Kinerja Unit Gagal Dihapus !!!');
        }
    }


}
