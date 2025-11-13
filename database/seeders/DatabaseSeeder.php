<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema; // <-- 1. IMPORT SCHEMA FACADE

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 2. Nonaktifkan pemeriksaan foreign key
        Schema::disableForeignKeyConstraints();

        // Panggil seeder individual Anda di sini
        $this->call([
            AnggotaSeeder::class,
            AdminPermataSeeder::class,
        ]);

        // 3. Aktifkan kembali pemeriksaan foreign key
        Schema::enableForeignKeyConstraints();
    }
}