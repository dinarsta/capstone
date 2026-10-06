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
                'name' => 'Dina Rosita',
                'email' => 'admin2@gmail.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('users')->updateOrInsert(
            ['id' => 5],
            [
                'name' => 'Siti Aminah',
                'email' => 'pimpinan2@gmail.com',
                'password' => Hash::make('pimpinan123'),
                'role' => 'pimpinan',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );


        /*
        |--------------------------------------------------------------------------
        | 2. PEGAWAI
        |--------------------------------------------------------------------------
        */

        DB::table('pegawais')->updateOrInsert(
            ['id' => 4],
            [
                'nip' => '198901012020011001',
                'nama' => 'Dina Rosita',
                'jabatan' => 'Programmer',
                'unit_kerja' => 'IT',
                'pangkat' => 'Penata Muda',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('pegawais')->updateOrInsert(
            ['id' => 5],
            [
                'nip' => '199002022021021002',
                'nama' => 'Siti Aminah',
                'jabatan' => 'Project Manager',
                'unit_kerja' => 'IT',
                'pangkat' => 'Penata',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('pegawais')->updateOrInsert(
            ['id' => 6],
            [
                'nip' => '199103032022031003',
                'nama' => 'Andi Saputra',
                'jabatan' => 'System Analyst',
                'unit_kerja' => 'IT',
                'pangkat' => 'Penata Muda',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('pegawais')->updateOrInsert(
            ['id' => 7],
            [
                'nip' => '199204042023041004',
                'nama' => 'Budi Santoso',
                'jabatan' => 'UI/UX Designer',
                'unit_kerja' => 'IT',
                'pangkat' => 'Pengatur',
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

        DB::table('master_models')->updateOrInsert(
            ['id' => 5],
            [
                'kategori' => 'instansi',
                'nama' => 'Dinas Pendidikan',
                'aktif' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('master_models')->updateOrInsert(
            ['id' => 6],
            [
                'kategori' => 'lokasi',
                'nama' => 'Jakarta',
                'aktif' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('master_models')->updateOrInsert(
            ['id' => 7],
            [
                'kategori' => 'lokasi',
                'nama' => 'Bandung',
                'aktif' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('master_models')->updateOrInsert(
            ['id' => 8],
            [
                'kategori' => 'jenis_kegiatan',
                'nama' => 'Rapat Koordinasi',
                'aktif' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('master_models')->updateOrInsert(
            ['id' => 9],
            [
                'kategori' => 'jenis_kegiatan',
                'nama' => 'Monitoring Project',
                'aktif' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('master_models')->updateOrInsert(
            ['id' => 10],
            [
                'kategori' => 'jenis_kegiatan',
                'nama' => 'Presentasi Project',
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
                'nama_project' => 'Bangun Candi',
                'deskripsi' => 'Project pembangunan dan pengembangan sistem monitoring.',
                'tanggal_mulai' => '2026-09-01',
                'tanggal_selesai' => '2026-12-31',
                'progress' => 30,
                'status' => 'berjalan',
                'created_by' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('projects')->updateOrInsert(
            ['id' => 5],
            [
                'nama_project' => 'Sistem Informasi Kepegawaian',
                'deskripsi' => 'Pengembangan sistem informasi kepegawaian.',
                'tanggal_mulai' => '2026-09-05',
                'tanggal_selesai' => '2026-12-20',
                'progress' => 65,
                'status' => 'berjalan',
                'created_by' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('projects')->updateOrInsert(
            ['id' => 6],
            [
                'nama_project' => 'Dashboard Monitoring',
                'deskripsi' => 'Pengembangan dashboard monitoring project.',
                'tanggal_mulai' => '2026-09-10',
                'tanggal_selesai' => '2026-11-30',
                'progress' => 85,
                'status' => 'berjalan',
                'created_by' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );


        /*
        |--------------------------------------------------------------------------
        | 5. TIM PROJECT
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

        DB::table('tim_projects')->updateOrInsert(
            ['id' => 5],
            [
                'project_id' => 4,
                'pegawai_id' => 7,
                'peran' => 'UI/UX Designer',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('tim_projects')->updateOrInsert(
            ['id' => 6],
            [
                'project_id' => 5,
                'pegawai_id' => 5,
                'peran' => 'Project Manager',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('tim_projects')->updateOrInsert(
            ['id' => 7],
            [
                'project_id' => 5,
                'pegawai_id' => 4,
                'peran' => 'Programmer',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('tim_projects')->updateOrInsert(
            ['id' => 8],
            [
                'project_id' => 6,
                'pegawai_id' => 6,
                'peran' => 'System Analyst',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('tim_projects')->updateOrInsert(
            ['id' => 9],
            [
                'project_id' => 6,
                'pegawai_id' => 7,
                'peran' => 'UI/UX Designer',
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
                'judul' => 'Rapat Koordinasi Project',
                'deskripsi' => 'Rapat koordinasi perkembangan seluruh project.',
                'tanggal' => '2026-10-06',
                'waktu' => '09:00:00',
                'lokasi' => 'Ruang Meeting 1',
                'status' => 'aktif',
                'created_by' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('agendas')->updateOrInsert(
            ['id' => 5],
            [
                'judul' => 'Evaluasi Progress Project',
                'deskripsi' => 'Evaluasi progress masing-masing project.',
                'tanggal' => '2026-10-08',
                'waktu' => '13:00:00',
                'lokasi' => 'Ruang Meeting 2',
                'status' => 'aktif',
                'created_by' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('agendas')->updateOrInsert(
            ['id' => 6],
            [
                'judul' => 'Presentasi Hasil Project',
                'deskripsi' => 'Presentasi hasil project kepada pimpinan.',
                'tanggal' => '2026-10-10',
                'waktu' => '10:00:00',
                'lokasi' => 'Aula Utama',
                'status' => 'aktif',
                'created_by' => 5,
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
                'kegiatan' => 'Rapat Koordinasi Project',
                'pegawai_id' => 4,
                'instansi_id' => 4,
                'lokasi_id' => 6,
                'jenis_kegiatan_id' => 8,
                'tanggal_mulai' => '2026-10-06',
                'tanggal_selesai' => '2026-10-06',
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

        DB::table('surat_tugas')->updateOrInsert(
            ['id' => 5],
            [
                'nomor_surat' => 'ST/005/2026',
                'kegiatan' => 'Monitoring Project',
                'pegawai_id' => 5,
                'instansi_id' => 4,
                'lokasi_id' => 6,
                'jenis_kegiatan_id' => 9,
                'tanggal_mulai' => '2026-10-08',
                'tanggal_selesai' => '2026-10-08',
                'dokumen_pdf' => null,
                'status' => 'disetujui',
                'catatan' => 'Surat telah disetujui pimpinan.',
                'created_by' => 4,
                'approved_by' => 5,
                'approved_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('surat_tugas')->updateOrInsert(
            ['id' => 6],
            [
                'nomor_surat' => 'ST/006/2026',
                'kegiatan' => 'Presentasi Project',
                'pegawai_id' => 6,
                'instansi_id' => 4,
                'lokasi_id' => 7,
                'jenis_kegiatan_id' => 10,
                'tanggal_mulai' => '2026-10-10',
                'tanggal_selesai' => '2026-10-10',
                'dokumen_pdf' => null,
                'status' => 'draft',
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
        | 8. SLIDE DISPLAY
        |--------------------------------------------------------------------------
        */

        DB::table('slide_displays')->updateOrInsert(
            ['id' => 4],
            [
                'project_id' => 4,
                'judul' => 'Bangun Candi',
                'gambar' => 'slide-display/candi.jpg',
                'urutan' => 1,
                'aktif' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('slide_displays')->updateOrInsert(
            ['id' => 5],
            [
                'project_id' => 5,
                'judul' => 'Sistem Informasi Kepegawaian',
                'gambar' => 'slide-display/kepegawaian.jpg',
                'urutan' => 2,
                'aktif' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('slide_displays')->updateOrInsert(
            ['id' => 6],
            [
                'project_id' => 6,
                'judul' => 'Dashboard Monitoring',
                'gambar' => 'slide-display/dashboard.jpg',
                'urutan' => 3,
                'aktif' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );


        /*
        |--------------------------------------------------------------------------
        | 9. TEKS BERJALAN
        |--------------------------------------------------------------------------
        */

        DB::table('teks_berjalans')->updateOrInsert(
            ['id' => 4],
            [
                'teks' => 'Selamat datang di Dashboard Monitoring Project',
                'aktif' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('teks_berjalans')->updateOrInsert(
            ['id' => 5],
            [
                'teks' => 'Pastikan setiap project selalu diperbarui progressnya',
                'aktif' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('teks_berjalans')->updateOrInsert(
            ['id' => 6],
            [
                'teks' => 'Informasi project ditampilkan secara realtime pada layar utama',
                'aktif' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );


        /*
        |--------------------------------------------------------------------------
        | 10. SETTING DISPLAY
        |--------------------------------------------------------------------------
        */

        DB::table('setting_displays')->updateOrInsert(
            ['id' => 4],
            [
                'nama_setting' => 'judul_display',
                'nilai' => 'MONITORING PROJECT',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('setting_displays')->updateOrInsert(
            ['id' => 5],
            [
                'nama_setting' => 'interval_slide',
                'nilai' => '5000',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('setting_displays')->updateOrInsert(
            ['id' => 6],
            [
                'nama_setting' => 'kecepatan_teks',
                'nilai' => '28',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}