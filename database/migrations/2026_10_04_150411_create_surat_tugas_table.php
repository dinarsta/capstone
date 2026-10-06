<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('surat_tugas', function (Blueprint $table) {
            $table->id();

            $table->string('nomor_surat')->unique();

            $table->string('kegiatan');

            $table->foreignId('pegawai_id')
                ->constrained('pegawais')
                ->cascadeOnDelete();

            $table->foreignId('instansi_id')
                ->nullable()
                ->constrained('master_models')
                ->nullOnDelete();

            $table->foreignId('lokasi_id')
                ->nullable()
                ->constrained('master_models')
                ->nullOnDelete();

            $table->foreignId('jenis_kegiatan_id')
                ->nullable()
                ->constrained('master_models')
                ->nullOnDelete();

            $table->date('tanggal_mulai');

            $table->date('tanggal_selesai')
                ->nullable();

            $table->string('dokumen_pdf')
                ->nullable();

            $table->enum('status', [
                'draft',
                'diajukan',
                'disetujui',
                'ditolak'
            ])->default('draft');

            $table->text('catatan')
                ->nullable();

            $table->foreignId('created_by')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('approved_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamp('approved_at')
                ->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_tugas');
    }
};