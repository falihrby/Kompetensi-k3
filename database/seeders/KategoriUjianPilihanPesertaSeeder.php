<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriUjianPilihanPesertaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Fetch pesertas data to use for populating the nama column
        $pesertas = DB::table('pesertas')->get();

        // Sample data for kategori_ujian_pilihan_peserta table with specific categories
        $kategoriUjianPilihanPeserta = $pesertas->map(function ($peserta) {
            return [
                [
                    'peserta_id' => $peserta->id,
                    'kategori_ujian_pilihan' => 'Khusus Lab FITISIMAT',
                    'nama' => $peserta->nama,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'peserta_id' => $peserta->id,
                    'kategori_ujian_pilihan' => 'Khusus Lab Pengujian',
                    'nama' => $peserta->nama,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ];
        })->flatten(1)->toArray(); // Flatten the array to have a single-level array

        // Insert sample data into kategori_ujian_pilihan_peserta table
        DB::table('kategori_ujian_pilihan_peserta')->insert($kategoriUjianPilihanPeserta);
    }
}
