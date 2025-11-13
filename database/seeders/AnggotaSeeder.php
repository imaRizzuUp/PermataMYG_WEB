<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Anggota; // Import model Anggota

class AnggotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
  

        // Buat beberapa data anggota
        Anggota::create([
            'nama' => 'Henoch Saerang',
            'telepon' => '082154325366',
            'alamat' => 'Langowan'
        ]);
        

    }
}