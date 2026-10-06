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

    /**
     * Project dibuat oleh satu user.
     */
    public function createdBy()
    {
        return $this->belongsTo(
            User::class,
            'created_by'
        );
    }

    /**
     * Project memiliki banyak anggota tim.
     */
    public function timProjects()
    {
        return $this->hasMany(
            TimProject::class,
            'project_id'
        );
    }

    /**
     * Project memiliki banyak slide display.
     */
    public function slides()
    {
        return $this->hasMany(
            SlideDisplay::class,
            'project_id'
        );
    }
}