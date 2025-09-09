<?php

namespace App\Http\Controllers\DataAmiController;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Dompdf\Options;


class ExportUserAmiController extends Controller
{
    public function exportPdf()
    {
        $data_user = User::all();

        $html = view('data_ami.data_user.export_user_ami', [
            'data_user' => $data_user,
        ])->render();

        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // unduh pdf 
        $filename = 'Data Akun User.pdf';
        return $dompdf->stream($filename, ['Attachment' => true]);
    }
}
