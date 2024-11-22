<?php

namespace App\Console\Commands;

use App\Models\PeriodePelaksanaan;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CloseExpiredPeriodeAudit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:close-expired-periode-audit';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = Carbon::today();

        $expiredPeriodes = PeriodePelaksanaan::where('status', 'Sedang Berjalan')
        ->where('tanggal_penutupan_ami','<', $today)
        ->get();

        foreach ($expiredPeriodes as $periode){
            $periode->update(['status' => 'Tutup']);
            $this->info("Periode audit {$periode->nama_periode_ami} telah ditutup.");
        }

        $this->info("Proses selesai. Semua periode audit yang kadaluarsa telah diperbarui");
    }
}
