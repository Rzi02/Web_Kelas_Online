<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Kategori;
use App\Models\Kelas;
use App\Enums\StatusKelas;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Akun admin
        User::updateOrCreate(
            ['email' => 'admin@kelasonline.test'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('admin12345'),
            ]
        );

        // Data kategori
        $teknologi = Kategori::firstOrCreate([
            'nama_kategori' => 'Teknologi',
        ]);

        $programming = Kategori::firstOrCreate([
            'nama_kategori' => 'Programming',
        ]);

        $desain = Kategori::firstOrCreate([
            'nama_kategori' => 'Desain',
        ]);

        // Data kelas
        Kelas::firstOrCreate(
            ['judul' => 'Belajar Laravel Dasar'],
            [
                'id_kategori' => $programming->id_kategori,
                'deskripsi' => 'Belajar membuat website menggunakan Laravel.',
                'instruktur' => 'John Doe',
                'harga' => 150000,
                'status' => StatusKelas::PUBLISHED,
            ]
        );

        Kelas::firstOrCreate(
            ['judul' => 'Dasar Pemrograman Web'],
            [
                'id_kategori' => $teknologi->id_kategori,
                'deskripsi' => 'Mempelajari HTML, CSS, dan JavaScript.',
                'instruktur' => 'Jane Doe',
                'harga' => 0,
                'status' => StatusKelas::PUBLISHED,
            ]
        );

        Kelas::firstOrCreate(
            ['judul' => 'Desain UI/UX untuk Pemula'],
            [
                'id_kategori' => $desain->id_kategori,
                'deskripsi' => 'Mengenal dasar desain antarmuka dan pengalaman pengguna.',
                'instruktur' => 'Alex Smith',
                'harga' => 100000,
                'status' => StatusKelas::PUBLISHED,
            ]
        );
    }
}
