<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Project;

class SlideDisplay extends Model
{
    protected $table = 'slide_displays';

    protected $fillable = [
        'project_id',
        'judul',
        'gambar',
        'urutan',
        'aktif',
    ];

    protected $casts = [
        'project_id' => 'integer',
        'urutan' => 'integer',
        'aktif' => 'boolean',
    ];

    /**
     * Slide ini milik satu project.
     */
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
}
