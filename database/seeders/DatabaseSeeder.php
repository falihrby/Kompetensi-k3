<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Peserta;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Membuat atau memperbarui pengguna spesifik
        $users = [
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'usertype' => 'admin',
                'password' => Hash::make('admin123'), // Kata sandi: "admin123"
            ],
            [
                'name' => 'Test User',
                'email' => 'test@example.com',
                'usertype' => 'user',
                'password' => Hash::make('testuser123'), // Kata sandi: "testuser123"
            ],
            [
                'name' => 'Falih Rahmat Ramadhan',
                'email' => 'falih.rahmat21@gmail.com',
                'usertype' => 'user',
                'password' => Hash::make('falihrahmat21'), // Kata sandi: "falihrahmat21"
            ],
        ];

        foreach ($users as $userData) {
            $user = User::updateOrCreate(
                ['email' => $userData['email']],
                $userData
            );

            // Jika usertype adalah 'user', tambahkan ke tabel pesertas
            if ($user->usertype === 'user') {
                Peserta::updateOrCreate(
                    ['user_id' => $user->id],
                    [
                        'user_id' => $user->id,
                        'nama' => $user->name,
                        'nomor' => '12345', // Sesuaikan nomor
                        'program_studi' => 'Computer Science', // Sesuaikan program_studi
                        'fakultas' => 'Engineering', // Sesuaikan fakultas
                        'instansi' => 'XYZ University', // Sesuaikan instansi
                        'email' => $user->email,
                        'password' => $user->password, // Password yang sudah di-hash
                        'kategori_ujian_wajib' => 'Kompetensi Umum'
                    ]
                );
            }
        }

        // Panggil PesertaSeeder untuk membuat data peserta tambahan jika diperlukan
        $this->call(PesertaSeeder::class);

        // Panggil KategoriUjianPilihanPesertaSeeder untuk mengisi data di tabel kategori_ujian_pilihan_peserta
        $this->call(KategoriUjianPilihanPesertaSeeder::class);
    }
}
