# PERMATA MYG WEB - Sektor Minahasa Tomohon

[![Laravel Version](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel)](https://laravel.com)
[![PHP Version](https://img.shields.io/badge/PHP-8.2%2B-777BB4?style=for-the-badge&logo=php)](https://www.php.net/)
[![License](https://img.shields.io/badge/License-MIT-blue?style=for-the-badge)](https://opensource.org/licenses/MIT)

Aplikasi web untuk manajemen data, jadwal, berita, dan statistik kegiatan persekutuan Mahasiswa dan Profesional Muda Maranatha (PERMATA MYG) Sektor Minahasa Tomohon.

## Fitur Utama Aplikasi

Aplikasi ini menyediakan modul lengkap untuk mengelola aktivitas internal dan menampilkan informasi untuk pengunjung.

### Modul Pengunjung (Guest)
* **Beranda (`/`):** Tampilan *hero slider*, misi, jadwal ibadah mendatang, dan 3 berita terbaru.
* **Semua Berita (`/berita/semua`):** Daftar berita lengkap dengan paginasi.
* **Detail Berita (`/berita/{berita}`):** Halaman tunggal untuk membaca isi berita secara penuh.
* **Tentang:** Halaman informasi misi dan sejarah komunitas.

### Modul Admin (Dashboard)
* **Dashboard:** Ringkasan statistik cepat (Admin, Berita, Jadwal Total, Jadwal Menunggu).
* **Manajemen Anggota:** CRUD data anggota biasa.
* **Manajemen Admin:** Daftar admin terdaftar dan formulir registrasi admin baru (dilindungi oleh *Laravel Gates* berdasarkan jabatan).
* **Manajemen Berita:** CRUD berita dengan unggah gambar, dilengkapi fitur *filter* (Semua, Terbaru, Terlama) menggunakan JavaScript.
* **Manajemen Jadwal Ibadah:** CRUD jadwal, termasuk pembaruan status (`menunggu`, `berhasil`, `gagal`), dengan fitur *filter* status.
* **Statistik:** Menampilkan grafik Donut dan rasio keberhasilan/kegagalan ibadah.
* **Pengaturan Akun:** Fitur untuk memperbarui profil dan mengganti *password* akun admin.

## Tumpukan Teknologi

| Area | Komponen | Versi/Catatan |
| :--- | :--- | :--- |
| **Backend** | Laravel Framework | ^12.0 |
| | PHP | ^8.2 |
| | Database Default | SQLite (`DB_CONNECTION=sqlite`) |
| **Frontend** | Tailwind CSS | ^4.0.0 (via `@tailwindcss/vite`) |
| | Vite | ^7.0.4 |
| | Bootstrap 5 | Digunakan pada halaman Admin/Dashboard. |

## Prasyarat

Pastikan sistem Anda sudah memiliki:
* **PHP** (Versi 8.2 atau lebih tinggi)
* **Composer**
* **Node.js dan NPM/Yarn**

## Panduan Instalasi

Ikuti langkah-langkah berikut untuk menjalankan aplikasi:

### 1. Kloning Repositori dan Instalasi Dependensi

```bash
# Kloning repositori
git clone <URL_REPO_ANDA> permatamyg_web
cd permatamyg_web

# Instalasi dependensi PHP
composer install

# Instalasi dependensi NPM dan Build Frontend
npm install
npm run build
