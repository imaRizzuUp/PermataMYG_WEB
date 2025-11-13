<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalIbadah extends Model
{
    protected $fillable = [
        'nama_ibadah',
        'lokasi_ibadah',
        'tanggal_ibadah',
        'status',
    ];
}
