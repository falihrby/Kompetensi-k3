<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Peserta;

class PesertaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Sample data for pesertas table
        $pesertas = [
            ['id' => 3, 'user_id' => 3, 'nama' => 'Ali Ahmad', 'nomor' => '54321', 'program_studi' => 'Mathematics', 'fakultas' => 'Science', 'instansi' => 'University C', 'email' => 'ali@example.com', 'password' => Hash::make('password'), 'kategori_ujian_wajib' => 'Statistics'],
            // Add more sample data as needed
        ];

        // Insert sample data into pesertas table
        DB::table('pesertas')->insert($pesertas);
    }
}
