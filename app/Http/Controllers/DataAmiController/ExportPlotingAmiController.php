<?php

namespace App\Http\Controllers\DataAmiController;

use App\Http\Controllers\Controller;
use App\Models\PeriodePelaksanaan;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Dompdf\Options;

class ExportPlotingAmiController extends Controller
{
    public function exportPdf()
    {
        // Ambil periode terbaru
        $periodeTerbaru = PeriodePelaksanaan::where('status', 'Sedang Berjalan')
            ->orderBy('tanggal_pembukaan_ami', 'desc')
            ->first();

        if (!$periodeTerbaru) {
            return redirect()->back()->with('error', 'Tidak ada periode yang terbuka. Silakan buat periode terlebih dahulu.');
        }

        $selectedJadwalAmiId = $periodeTerbaru->jadwal_ami_id;

        // Ambil data unit berdasarkan periode
        $dataPloting = Unit::with([
            'units_cabang.audites.user_audite:user_id,nama',
            'audite.user_audite:user_id,nama',
            'auditor.auditor1:user_id,nama',
            'auditor.auditor2:user_id,nama'
        ])
            ->where('jadwal_ami_id', $selectedJadwalAmiId)
            ->get();
        
        $data_user = User::all();

        // Render HTML untuk PDF
        $html = view('data_ami.ploating_ami.export_ploating_ami', [
            'periode' => $periodeTerbaru,
            'data_ploting' => $dataPloting, 
            'data_user' => $data_user, 
        ])->render();

        // Konfigurasi DOMPDF
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Unduh PDF
        $filename = 'Jadwal_AMI_' . $periodeTerbaru->nama_periode_ami . '.pdf';
        return $dompdf->stream($filename, ['Attachment' => true]);
    }
}
