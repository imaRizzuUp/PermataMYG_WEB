<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class storeBerita extends Model
{
    protected $fillable = [
        'admin_permata_id',
        'judul',
        'gambar',
        'isi',
    ];

    public function admin()
    {
        return $this->belongsTo(adminPermata::class, 'admin_permata_id');
    }
}
