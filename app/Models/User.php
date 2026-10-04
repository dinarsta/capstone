<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
    ];

    public function agendas()
    {
        return $this->hasMany(Agenda::class, 'created_by');
    }

    public function projects()
    {
        return $this->hasMany(Project::class, 'created_by');
    }

    public function suratTugas()
    {
        return $this->hasMany(SuratTugas::class, 'created_by');
    }

    public function suratDisetujui()
    {
        return $this->hasMany(SuratTugas::class, 'approved_by');
    }
}