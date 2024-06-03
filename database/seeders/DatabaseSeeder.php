<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Membuat atau memperbarui pengguna spesifik
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'usertype' => 'admin',
                'password' => Hash::make('admin123'), // Kata sandi: "admin123"
            ]
        );

        User::updateOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => Hash::make('testuser123'), // Kata sandi: "testuser123"
            ]
        );

        User::updateOrCreate(
            ['email' => 'falih.rahmat21@gmail.com'],
            [
                'name' => 'Falih Rahmat Ramadhan',
                'password' => Hash::make('falihrahmat21'), // Kata sandi: "testuser123"
            ]
        );

        // Panggil PesertaSeeder untuk membuat data peserta
        $this->call(PesertaSeeder::class);
    }
}
