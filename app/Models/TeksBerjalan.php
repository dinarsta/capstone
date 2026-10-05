<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeksBerjalan extends Model
{
    protected $table = 'teks_berjalans';

    protected $fillable = [
        'teks',
        'aktif',
    ];

    protected $casts = [
        'aktif' => 'boolean',
    ];
}