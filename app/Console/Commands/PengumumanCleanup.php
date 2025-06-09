<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PengumumanCleanup extends Command
{
    protected $signature = 'pengumuman:cleanup';
    protected $description = 'Hapus data pengumuman_user_read yang sudah lebih dari 14 hari';

    public function handle()
    {
        $this->info('Mulai proses cleanup pengumuman_user_read...');

        $dateLimit = Carbon::now()->subDays(14);

        $deleted = DB::table('pengumuman_user_read')
            ->where('created_at', '<', $dateLimit)
            ->delete();

        $this->info("Berhasil menghapus $deleted data lama.");

        return 0;
    }
}
