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
                'nama' => 'Jason Pratama',
                'jabatan' => 'Pranata Komputer',
                'unit_kerja' => 'Bidang Teknologi Informasi',
                'pangkat' => 'Penata Muda',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('pegawais')->updateOrInsert(
            ['id' => 5],
            [
                'nip' => '199002152021021002',
                'nama' => 'Andi Setiawan',
                'jabatan' => 'Analis Sistem Informasi',
                'unit_kerja' => 'Bidang Teknologi Informasi',
                'pangkat' => 'Penata',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('pegawais')->updateOrInsert(
            ['id' => 6],
            [
                'nip' => '199305202022031003',
                'nama' => 'Rina Marlina',
                'jabatan' => 'Pengelola Data',
                'unit_kerja' => 'Bidang Data dan Informasi',
                'pangkat' => 'Penata Muda Tingkat I',
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
                'kategori' => 'lokasi',
                'nama' => 'Kantor Diskominfo Jakarta',
                'aktif' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('master_models')->updateOrInsert(
            ['id' => 6],
            [
                'kategori' => 'jenis_kegiatan',
                'nama' => 'Rapat Koordinasi',
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
                'deskripsi' => 'Pengembangan sistem untuk pengelolaan, pengajuan, validasi, dan pencetakan surat tugas secara terintegrasi.',
                'tanggal_mulai' => '2026-09-01',
                'tanggal_selesai' => '2026-12-31',
                'progress' => 35,
                'status' => 'berjalan',
                'created_by' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('projects')->updateOrInsert(
            ['id' => 5],
            [
                'nama_project' => 'Digitalisasi Arsip Surat Dinas',
                'deskripsi' => 'Pengembangan sistem digitalisasi dan pengelolaan arsip surat dinas secara terintegrasi.',
                'tanggal_mulai' => '2026-08-01',
                'tanggal_selesai' => '2026-11-30',
                'progress' => 60,
                'status' => 'berjalan',
                'created_by' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('projects')->updateOrInsert(
            ['id' => 6],
            [
                'nama_project' => 'Sistem Monitoring Kegiatan Pegawai',
                'deskripsi' => 'Pengembangan sistem untuk memantau kegiatan dan pelaksanaan tugas pegawai.',
                'tanggal_mulai' => '2026-10-01',
                'tanggal_selesai' => '2027-01-31',
                'progress' => 20,
                'status' => 'berjalan',
                'created_by' => 4,
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
                'project_id' => 5,
                'pegawai_id' => 5,
                'peran' => 'System Analyst',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('tim_projects')->updateOrInsert(
            ['id' => 6],
            [
                'project_id' => 6,
                'pegawai_id' => 6,
                'peran' => 'Data Analyst',
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
                'deskripsi' => 'Pembahasan progres dan kebutuhan pengembangan Sistem Informasi Manajemen Surat Tugas.',
                'tanggal' => '2026-10-06',
                'waktu' => '09:00:00',
                'lokasi' => 'Ruang Rapat Diskominfo',
                'status' => 'aktif',
                'created_by' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('agendas')->updateOrInsert(
            ['id' => 5],
            [
                'judul' => 'Evaluasi Digitalisasi Arsip',
                'deskripsi' => 'Evaluasi perkembangan digitalisasi dan pengelolaan arsip surat dinas.',
                'tanggal' => '2026-10-15',
                'waktu' => '10:00:00',
                'lokasi' => 'Ruang Rapat Utama',
                'status' => 'aktif',
                'created_by' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('agendas')->updateOrInsert(
            ['id' => 6],
            [
                'judul' => 'Monitoring Kegiatan Pegawai',
                'deskripsi' => 'Pembahasan dan monitoring pelaksanaan kegiatan pegawai.',
                'tanggal' => '2026-10-22',
                'waktu' => '13:00:00',
                'lokasi' => 'Ruang Monitoring',
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
                'kegiatan' => 'Rapat Koordinasi Pengembangan Sistem Informasi',
                'pegawai_id' => 4,
                'instansi_id' => 4,
                'lokasi_id' => 5,
                'jenis_kegiatan_id' => 6,
                'tanggal_mulai' => '2026-10-06',
                'tanggal_selesai' => '2026-10-06',
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

        DB::table('surat_tugas')->updateOrInsert(
            ['id' => 5],
            [
                'nomor_surat' => 'ST/005/2026',
                'kegiatan' => 'Evaluasi Digitalisasi Arsip Surat',
                'pegawai_id' => 5,
                'instansi_id' => 4,
                'lokasi_id' => 5,
                'jenis_kegiatan_id' => 6,
                'tanggal_mulai' => '2026-10-15',
                'tanggal_selesai' => '2026-10-15',
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

        DB::table('surat_tugas')->updateOrInsert(
            ['id' => 6],
            [
                'nomor_surat' => 'ST/006/2026',
                'kegiatan' => 'Monitoring Kegiatan Pegawai',
                'pegawai_id' => 6,
                'instansi_id' => 4,
                'lokasi_id' => 5,
                'jenis_kegiatan_id' => 6,
                'tanggal_mulai' => '2026-10-22',
                'tanggal_selesai' => '2026-10-22',
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
                'judul' => 'Pengembangan Sistem Informasi Manajemen Surat Tugas',
                'gambar' => 'slide-display/project.jpg',
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
                'judul' => 'Digitalisasi Arsip Surat Dinas',
                'gambar' => 'slide-display/archive.jpg',
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
                'judul' => 'Sistem Monitoring Kegiatan Pegawai',
                'gambar' => 'slide-display/monitoring.jpg',
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
                'teks' => 'Selamat datang di Sistem Informasi Manajemen Surat Tugas',
                'aktif' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('teks_berjalans')->updateOrInsert(
            ['id' => 5],
            [
                'teks' => 'Selamat datang di halaman display informasi kegiatan',
                'aktif' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('teks_berjalans')->updateOrInsert(
            ['id' => 6],
            [
                'teks' => 'Pastikan seluruh kegiatan dan surat tugas tercatat dengan baik',
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
                'nilai' => 'SISTEM INFORMASI MANAJEMEN SURAT TUGAS',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('setting_displays')->updateOrInsert(
            ['id' => 5],
            [
                'nama_setting' => 'subjudul_display',
                'nilai' => 'SISTEM INFORMASI KEGIATAN DAN SURAT TUGAS',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('setting_displays')->updateOrInsert(
            ['id' => 6],
            [
                'nama_setting' => 'footer_display',
                'nilai' => 'DINAS KOMUNIKASI DAN INFORMATIKA',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}