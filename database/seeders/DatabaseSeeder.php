<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | 1. USERS
        |--------------------------------------------------------------------------
        */

        DB::table('users')->updateOrInsert(
            ['id' => 4],
            [
                'name' => 'Jason Pratama',
                'email' => 'admin2@gmail.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | 2. PEGAWAIS
        |--------------------------------------------------------------------------
        */

        DB::table('pegawais')->updateOrInsert(
            ['id' => 4],
            [
                'nip' => '198901012020011001',
                'nama' => 'Jason Pratama',
                'jabatan' => 'Pranata Komputer',
                'unit_kerja' => 'Bidang Teknologi Informasi',
                'pangkat' => 'Penata Muda',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | 3. MASTER MODELS
        |--------------------------------------------------------------------------
        */

        DB::table('master_models')->updateOrInsert(
            ['id' => 4],
            [
                'kategori' => 'instansi',
                'nama' => 'Dinas Komunikasi dan Informatika',
                'aktif' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | 4. PROJECTS
        |--------------------------------------------------------------------------
        */

        DB::table('projects')->updateOrInsert(
            ['id' => 4],
            [
                'nama_project' => 'Pengembangan Sistem Informasi Manajemen Surat Tugas',
                'deskripsi' => 'Pengembangan sistem pengelolaan surat tugas.',
                'tanggal_mulai' => '2026-09-01',
                'tanggal_selesai' => '2026-12-31',
                'progress' => 35,
                'status' => 'berjalan',
                'created_by' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | 5. TIM PROJECTS
        |--------------------------------------------------------------------------
        */

        DB::table('tim_projects')->updateOrInsert(
            ['id' => 4],
            [
                'project_id' => 4,
                'pegawai_id' => 4,
                'peran' => 'Programmer',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | 6. AGENDAS
        |--------------------------------------------------------------------------
        */

        DB::table('agendas')->updateOrInsert(
            ['id' => 4],
            [
                'judul' => 'Rapat Koordinasi Pengembangan Sistem',
                'deskripsi' => 'Pembahasan progres pengembangan sistem surat tugas.',
                'tanggal' => '2026-10-15',
                'waktu' => '09:00:00',
                'lokasi' => 'Ruang Rapat Diskominfo',
                'status' => 'aktif',
                'created_by' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | 7. SURAT TUGAS
        |--------------------------------------------------------------------------
        */

        DB::table('surat_tugas')->updateOrInsert(
            ['id' => 4],
            [
                'nomor_surat' => 'ST/004/2026',
                'kegiatan' => 'Rapat Koordinasi Pengembangan Sistem',
                'pegawai_id' => 4,
                'instansi_id' => 4,
                'lokasi_id' => null,
                'jenis_kegiatan_id' => null,
                'tanggal_mulai' => '2026-10-15',
                'tanggal_selesai' => '2026-10-15',
                'dokumen_pdf' => null,
                'status' => 'diajukan',
                'catatan' => null,
                'created_by' => 4,
                'approved_by' => null,
                'approved_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | 8. SLIDE DISPLAYS
        |--------------------------------------------------------------------------
        |
        | Tidak diisi data.
        |
        */

        /*
        |--------------------------------------------------------------------------
        | 9. TEKS BERJALANS
        |--------------------------------------------------------------------------
        */

        DB::table('teks_berjalans')->updateOrInsert(
            ['id' => 4],
            [
                'teks' => 'Selamat datang di Sistem Informasi Manajemen Surat Tugas',
                'aktif' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | 10. SETTING DISPLAYS
        |--------------------------------------------------------------------------
        */

        DB::table('setting_displays')->updateOrInsert(
            ['id' => 4],
            [
                'nama_setting' => 'judul_display',
                'nilai' => 'SISTEM INFORMASI MANAJEMEN SURAT TUGAS',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | 11. BERTUGAS
        |--------------------------------------------------------------------------
        |
        | Tidak diisi data.
        |
        */
    }
}
