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
        | 1. AKUN ADMIN
        |--------------------------------------------------------------------------
        */

        DB::table('users')->updateOrInsert(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('123456'),
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        $adminId = DB::table('users')
            ->where('email', 'admin@gmail.com')
            ->value('id');


        /*
        |--------------------------------------------------------------------------
        | 2. DUMMY DATA PEGAWAI
        |--------------------------------------------------------------------------
        */

        $pegawais = [
            [
                'id' => 5,
                'nip' => '199205152021011002',
                'nama' => 'Andi Saputra',
                'jabatan' => 'Analis Sistem Informasi',
                'unit_kerja' => 'Bidang Teknologi Informasi',
                'pangkat' => 'Penata Muda Tingkat I',
            ],
            [
                'id' => 6,
                'nip' => '199408202022012003',
                'nama' => 'Siti Rahmawati',
                'jabatan' => 'Pranata Komputer',
                'unit_kerja' => 'Bidang Persandian',
                'pangkat' => 'Penata Muda',
            ],
        ];

        foreach ($pegawais as $pegawai) {
            DB::table('pegawais')->updateOrInsert(
                ['id' => $pegawai['id']],
                array_merge($pegawai, [
                    'created_at' => now(),
                    'updated_at' => now(),
                ])
            );
        }


        /*
        |--------------------------------------------------------------------------
        | 3. DUMMY DATA AGENDAS
        |--------------------------------------------------------------------------
        */

        $agendas = [
            [
                'id' => 5,
                'judul' => 'Pengembangan Sistem Informasi Manajemen Surat Tugas',
                'deskripsi' => 'Pembahasan pengembangan sistem informasi manajemen surat tugas.',
                'tanggal' => '2026-11-15',
                'waktu' => '09:00:00',
                'lokasi' => 'Ruang Rapat Diskominfo',
            ],
            [
                'id' => 6,
                'judul' => 'Rapat Koordinasi Tim Teknologi Informasi',
                'deskripsi' => 'Koordinasi dan evaluasi pekerjaan tim teknologi informasi.',
                'tanggal' => '2026-11-17',
                'waktu' => '10:00:00',
                'lokasi' => 'Ruang Rapat Utama',
            ],
            [
                'id' => 7,
                'judul' => 'Evaluasi Progres Project Sistem Informasi',
                'deskripsi' => 'Evaluasi progres project dan pembahasan kendala pengembangan.',
                'tanggal' => '2026-11-20',
                'waktu' => '13:30:00',
                'lokasi' => 'Laboratorium Komputer',
            ],
        ];

        foreach ($agendas as $agenda) {
            DB::table('agendas')->updateOrInsert(
                ['id' => $agenda['id']],
                array_merge($agenda, [
                    'status' => 'aktif',
                    'created_by' => $adminId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ])
            );
        }
    }
}