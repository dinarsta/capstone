<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SuratTugas extends Model
{
    protected $fillable = [
        'nomor_surat',
        'kegiatan',
        'pegawai_id',
        'instansi_id',
        'lokasi_id',
        'jenis_kegiatan_id',
        'tanggal_mulai',
        'tanggal_selesai',
        'dokumen_pdf',
        'status',
        'catatan',
        'created_by',
        'approved_by',
        'approved_at',
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
        'approved_at' => 'datetime',
    ];

    public function pegawai(): BelongsTo
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id');
    }

    public function pembuat(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function approver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function instansi(): BelongsTo
    {
        return $this->belongsTo(MasterModel::class, 'instansi_id');
    }

    public function lokasi(): BelongsTo
    {
        return $this->belongsTo(MasterModel::class, 'lokasi_id');
    }

    public function jenisKegiatan(): BelongsTo
    {
        return $this->belongsTo(MasterModel::class, 'jenis_kegiatan_id');
    }
}