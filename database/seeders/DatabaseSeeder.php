<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Membuat atau memperbarui pengguna admin
        $admin = [
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'nomor' => '123456789012',
            'usertype' => 'admin',
            'program_studi' => 'Teknik Informatika',
            'fakultas' => 'Sains dan Teknologi',
            'instansi' => 'UIN Syarif Hidayatullah Jakarta',
            'password' => Hash::make('adm1nus3r'),
            'created_at' => now(),
            'updated_at' => now(),
        ];

        User::updateOrCreate(
            ['email' => $admin['email']],
            $admin
        );

        // Membuat atau memperbarui pengguna user
        $users = [
            [
                'name' => 'Regular User',
                'email' => 'user@example.com',
                'nomor' => '987654321098',
                'usertype' => 'user',
                'program_studi' => 'Kimia',
                'fakultas' => 'Sains dan Teknologi',
                'instansi' => 'UIN Syarif Hidayatullah Jakarta',
                'password' => Hash::make('us3rpass'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($users as $userData) {
            User::updateOrCreate(
                ['email' => $userData['email']],
                $userData
            );
        }
    }
}
