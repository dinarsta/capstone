<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }

    public function pembuat()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function instansi()
    {
        return $this->belongsTo(MasterModel::class, 'instansi_id');
    }

    public function lokasi()
    {
        return $this->belongsTo(MasterModel::class, 'lokasi_id');
    }

    public function jenisKegiatan()
    {
        return $this->belongsTo(MasterModel::class, 'jenis_kegiatan_id');
    }
}