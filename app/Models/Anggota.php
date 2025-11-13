<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    protected $fillable = ['nama', 'telepon', 'alamat'];

    public function admin()
    {
        return $this->hasOne(adminPermata::class, 'anggota_id');
    }
}
