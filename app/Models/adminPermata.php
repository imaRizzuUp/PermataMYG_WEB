<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Model; // <-- Tidak perlu jika sudah extends Authenticatable
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory; // <-- DITAMBAHKAN (Best Practice)
use Illuminate\Foundation\Auth\User as Authenticatable;

// NAMA KELAS DIPERBAIKI: Mengikuti standar PSR (StudlyCaps)
class AdminPermata extends Authenticatable
{
    use HasFactory; // <-- DITAMBAHKAN (Best Practice)

    protected $fillable = ['email', 'password', 'jabatan', 'anggota_id'];

    /**
     * Accessor untuk mendapatkan inisial nama dari relasi anggota.
     */
    protected function initials(): Attribute
    {
        return Attribute::make(
            // DIPERBAIKI: Mengambil nama dari relasi 'anggota', bukan ID.
            // Menggunakan nullsafe operator (?->) untuk mencegah error jika relasi tidak ditemukan.
            get: fn () => static::generateInitials($this->anggota?->nama)
        );
    }

    /**
     * Helper function untuk membuat inisial dari sebuah nama.
     * Fungsi ini sudah bagus, tidak perlu diubah.
     */
    public static function generateInitials(?string $name): string
    {
        if (empty($name)) {
            return '??';
        }
        
        $parts = explode(' ', trim($name));

        if (count($parts) === 1) {
            return strtoupper(substr($parts[0], 0, 1));
        }

        $firstNameInitial = substr($parts[0], 0, 1);
        $lastNameInitial = substr(end($parts), 0, 1);
        
        return strtoupper($firstNameInitial . $lastNameInitial);
    }

    /**
     * Relasi ke model Berita.
     * REKOMENDASI: Sebaiknya nama model juga 'StoreBerita' (StudlyCaps).
     */
    public function beritas()
    {
        // Ganti 'storeBerita' menjadi 'StoreBerita' jika Anda mengubah nama file modelnya
        return $this->hasMany(storeBerita::class, 'admin_permata_id');
    }

    /**
     * Relasi ke model Anggota.
     * Relasi ini sudah benar.
     */
    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'anggota_id');
    }
}