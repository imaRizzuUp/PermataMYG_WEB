<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AdminPermata; // Import model AdminPermata
use App\Models\Anggota;     // Import model Anggota untuk mencari ID
use Illuminate\Support\Facades\Hash; // Import Hash untuk mengenkripsi password

class AdminPermataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // 1. Cari anggota yang akan dijadikan admin
        // Kita gunakan firstOrFail() agar seeder gagal jika AnggotaSeeder belum dijalankan
        $anggotaAdmin = Anggota::where('nama', 'Henoch Saerang')->firstOrFail();

        // 2. Buat akun admin utama
        AdminPermata::create([
            'anggota_id' => $anggotaAdmin->id, // Tautkan ke ID anggota
            'email' => 'henochsaerang@permatamyg.com',
            'password' => Hash::make('henok12345'), // Ganti 'password' dengan password yang kuat
            'jabatan' => 'wakil sekretaris',
        ]);
        

    }
}