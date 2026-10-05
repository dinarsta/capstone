<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimProject extends Model
{
    protected $fillable = [
        'project_id',
        'pegawai_id',
        'peran',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id');
    }
}