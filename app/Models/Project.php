<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'nama_project',
        'deskripsi',
        'tanggal_mulai',
        'tanggal_selesai',
        'progress',
        'status',
        'created_by',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function timProject()
    {
        return $this->hasMany(TimProject::class);
    }
}