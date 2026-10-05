<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SlideDisplay extends Model
{
    protected $table = 'slide_displays';

    protected $fillable = [
        'judul',
        'gambar',
        'urutan',
        'aktif',
    ];

    protected $casts = [
        'aktif' => 'boolean',
        'urutan' => 'integer',
    ];
}