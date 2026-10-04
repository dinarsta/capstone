<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterModel extends Model
{
    protected $fillable = [
        'kategori',
        'nama',
        'aktif',
    ];

    protected $casts = [
        'aktif' => 'boolean',
    ];
}