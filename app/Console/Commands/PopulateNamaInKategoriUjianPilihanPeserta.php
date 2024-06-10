<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class PopulateNamaInKategoriUjianPilihanPeserta extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'populate:nama';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Populate nama column in kategori_ujian_pilihan_peserta table from pesertas table';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        DB::table('kategori_ujian_pilihan_peserta')
            ->join('pesertas', 'kategori_ujian_pilihan_peserta.peserta_id', '=', 'pesertas.id')
            ->update(['kategori_ujian_pilihan_peserta.nama' => DB::raw('pesertas.nama')]);

        $this->info('Nama column populated successfully.');
        return 0;
    }
}
