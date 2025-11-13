<?php

namespace App\Providers;

use App\Models\adminPermata;
use App\Models\Anggota;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // =======================================================
        // === DEFINISIKAN GATE OTORISASI DI SINI ===============
        // =======================================================
        Gate::define('delete-admin', function (adminPermata $user) {
            $allowedRoles = [
                'admin',
                'ketua',
                'wakil ketua',
                'sekretaris',
                'wakil sekretaris',
                'bendahara',
                'wakil bendahara',
            ];
            return in_array(strtolower($user->jabatan), $allowedRoles);
        });

        Gate::define('delete-anggota', function (AdminPermata $user) {
            $allowedRoles = [
                'admin',
                'ketua',
                'wakil ketua',
                'sekretaris',
                'wakil sekretaris',
                'bendahara',
                'wakil bendahara',
            ];
            return in_array(strtolower($user->jabatan), $allowedRoles);
        });

        // =======================================================
        // === GATE BARU: HANYA YANG BERWENANG BISA BUAT ADMIN ===
        // =======================================================
        Gate::define('create-admin', function (AdminPermata $user) {
            // Logikanya sama persis dengan 'delete-admin'
            $allowedRoles = [
                'admin', 'ketua', 'wakil ketua', 'sekretaris', 
                'wakil sekretaris', 'bendahara', 'wakil bendahara',
            ];
            // Mengembalikan true jika jabatan user ada di daftar, false jika tidak.
            return in_array(strtolower($user->jabatan), $allowedRoles);
        });
    }
}
