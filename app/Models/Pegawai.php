<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $fillable = [
        'nip',
        'nama',
        'jabatan',
        'unit_kerja',
        'pangkat',
    ];

    public function timProjects()
    {
        return $this->hasMany(
            TimProject::class,
            'pegawai_id'
        );
    }

    public function suratTugas()
    {
        return $this->hasMany(
            SuratTugas::class,
            'pegawai_id'
        );
    }
}