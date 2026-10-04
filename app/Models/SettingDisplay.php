<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SettingDisplay extends Model
{
    protected $fillable = [
        'nama_setting',
        'nilai',
    ];
}