<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Peserta;

class PesertaSeeder extends Seeder
{
    public function run()
    {
        // Ambil semua user yang memiliki tipe "user"
        $users = User::where('usertype', 'user')->get();

        // Loop melalui setiap user dan tambahkan mereka ke tabel pesertas
        foreach ($users as $user) {
            Peserta::updateOrCreate(
                ['user_id' => $user->id], 
                [
                    'user_id' => $user->id,
                    'nama' => $user->name,
                    'nomor' => '11200000000000',
                    'program_studi' => 'Teknik Informatika',
                    'fakultas' => 'Sains dan Teknologi',
                    'instansi' => 'UIN Syarif Hidayatullah Jakarta',
                ]
            );
        }
    }
}
