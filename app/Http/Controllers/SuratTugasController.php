<?php

namespace App\Http\Controllers;

use App\Models\SuratTugas;
use App\Models\Pegawai;
use App\Models\MasterModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SuratTugasController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $suratTugas = SuratTugas::with([
            'pegawai',
            'pembuat',
            'approver',
            'instansi',
            'lokasi',
            'jenisKegiatan',
        ])
        ->latest()
        ->get();

        $pegawais = Pegawai::orderBy('nama')->get();

        $instansi = MasterModel::where('kategori', 'instansi')
            ->where('aktif', true)
            ->orderBy('nama')
            ->get();

        $lokasi = MasterModel::where('kategori', 'lokasi')
            ->where('aktif', true)
            ->orderBy('nama')
            ->get();

        $jenisKegiatan = MasterModel::where('kategori', 'jenis_kegiatan')
            ->where('aktif', true)
            ->orderBy('nama')
            ->get();

        return view('admin.surat-tugas.index', compact(
            'suratTugas',
            'pegawais',
            'instansi',
            'lokasi',
            'jenisKegiatan'
        ));
    }


    /*
    |--------------------------------------------------------------------------
    | CREATE
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $pegawais = Pegawai::orderBy('nama')->get();

        $instansi = MasterModel::where('kategori', 'instansi')
            ->where('aktif', true)
            ->orderBy('nama')
            ->get();

        $lokasi = MasterModel::where('kategori', 'lokasi')
            ->where('aktif', true)
            ->orderBy('nama')
            ->get();

        $jenisKegiatan = MasterModel::where('kategori', 'jenis_kegiatan')
            ->where('aktif', true)
            ->orderBy('nama')
            ->get();

        return view('admin.surat-tugas.create', compact(
            'pegawais',
            'instansi',
            'lokasi',
            'jenisKegiatan'
        ));
    }


    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $data = $request->validate([
            'nomor_surat' => [
                'required',
                'string',
                'max:255',
                'unique:surat_tugas,nomor_surat',
            ],

            'kegiatan' => [
                'required',
                'string',
                'max:255',
            ],

            'pegawai_id' => [
                'required',
                'integer',
                'exists:pegawais,id',
            ],

            'instansi_id' => [
                'nullable',
                'integer',
                'exists:master_models,id',
            ],

            'lokasi_id' => [
                'nullable',
                'integer',
                'exists:master_models,id',
            ],

            'jenis_kegiatan_id' => [
                'nullable',
                'integer',
                'exists:master_models,id',
            ],

            'tanggal_mulai' => [
                'required',
                'date',
            ],

            'tanggal_selesai' => [
                'nullable',
                'date',
                'after_or_equal:tanggal_mulai',
            ],

            'dokumen_pdf' => [
                'required',
                'file',
                'mimes:pdf',
                'max:10240',
            ],

            'catatan' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ], [

            'nomor_surat.required' =>
                'Nomor surat wajib diisi.',

            'nomor_surat.unique' =>
                'Nomor surat sudah digunakan.',

            'kegiatan.required' =>
                'Kegiatan wajib diisi.',

            'pegawai_id.required' =>
                'Pegawai wajib dipilih.',

            'pegawai_id.exists' =>
                'Pegawai yang dipilih tidak ditemukan.',

            'instansi_id.exists' =>
                'Instansi yang dipilih tidak ditemukan.',

            'lokasi_id.exists' =>
                'Lokasi yang dipilih tidak ditemukan.',

            'jenis_kegiatan_id.exists' =>
                'Lokasi yang dipilih tidak ditemukan.',

            'tanggal_mulai.required' =>
                'Tanggal mulai wajib diisi.',

            'tanggal_selesai.after_or_equal' =>
                'Tanggal selesai tidak boleh sebelum tanggal mulai.',

            'dokumen_pdf.required' =>
                'Dokumen PDF wajib diupload.',

            'dokumen_pdf.mimes' =>
                'Dokumen harus berupa PDF.',

            'dokumen_pdf.max' =>
                'Ukuran PDF maksimal 10 MB.',
        ]);


        /*
        |--------------------------------------------------------------------------
        | UPLOAD PDF
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('dokumen_pdf')) {

            $data['dokumen_pdf'] = $request
                ->file('dokumen_pdf')
                ->store('surat-tugas', 'public');
        }


        /*
        |--------------------------------------------------------------------------
        | DATA TAMBAHAN
        |--------------------------------------------------------------------------
        */

        $data['created_by'] = auth()->id();

        $data['status'] = 'draft';

        $data['approved_by'] = null;

        $data['approved_at'] = null;


        /*
        |--------------------------------------------------------------------------
        | CREATE
        |--------------------------------------------------------------------------
        */

        SuratTugas::create($data);


        return redirect()
            ->route('admin.surat-tugas.index')
            ->with(
                'success',
                'Surat Tugas berhasil dibuat.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | SHOW
    |--------------------------------------------------------------------------
    */

    public function show(SuratTugas $suratTugas)
    {
        $suratTugas->load([
            'pegawai',
            'pembuat',
            'approver',
            'instansi',
            'lokasi',
            'jenisKegiatan',
        ]);

        return view(
            'admin.surat-tugas.show',
            compact('suratTugas')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */

    public function edit(SuratTugas $suratTugas)
    {
        /*
        | Surat yang sudah diajukan/disetujui tidak boleh diedit.
        */

        if (!in_array($suratTugas->status, [
            'draft',
            'ditolak'
        ])) {

            return redirect()
                ->route('admin.surat-tugas.index')
                ->with(
                    'error',
                    'Surat Tugas yang sudah diajukan atau disetujui tidak dapat diubah.'
                );
        }


        $pegawais = Pegawai::orderBy('nama')->get();

        $instansi = MasterModel::where('kategori', 'instansi')
            ->where('aktif', true)
            ->orderBy('nama')
            ->get();

        $lokasi = MasterModel::where('kategori', 'lokasi')
            ->where('aktif', true)
            ->orderBy('nama')
            ->get();

        $jenisKegiatan = MasterModel::where(
                'kategori',
                'jenis_kegiatan'
            )
            ->where('aktif', true)
            ->orderBy('nama')
            ->get();


        return view(
            'admin.surat-tugas.edit',
            compact(
                'suratTugas',
                'pegawais',
                'instansi',
                'lokasi',
                'jenisKegiatan'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */

    public function update(
        Request $request,
        SuratTugas $suratTugas
    ) {

        /*
        | Hanya draft dan ditolak yang boleh diedit.
        */

        if (!in_array($suratTugas->status, [
            'draft',
            'ditolak'
        ])) {

            return redirect()
                ->route('admin.surat-tugas.index')
                ->with(
                    'error',
                    'Surat Tugas yang sudah diajukan atau disetujui tidak dapat diubah.'
                );
        }


        $data = $request->validate([

            'nomor_surat' => [
                'required',
                'string',
                'max:255',
                'unique:surat_tugas,nomor_surat,' . $suratTugas->id,
            ],

            'kegiatan' => [
                'required',
                'string',
                'max:255',
            ],

            'pegawai_id' => [
                'required',
                'integer',
                'exists:pegawais,id',
            ],

            'instansi_id' => [
                'nullable',
                'integer',
                'exists:master_models,id',
            ],

            'lokasi_id' => [
                'nullable',
                'integer',
                'exists:master_models,id',
            ],

            'jenis_kegiatan_id' => [
                'nullable',
                'integer',
                'exists:master_models,id',
            ],

            'tanggal_mulai' => [
                'required',
                'date',
            ],

            'tanggal_selesai' => [
                'nullable',
                'date',
                'after_or_equal:tanggal_mulai',
            ],

            /*
            | PDF TIDAK required ketika edit.
            | Kalau kosong -> PDF lama tetap dipakai.
            */

            'dokumen_pdf' => [
                'nullable',
                'file',
                'mimes:pdf',
                'max:10240',
            ],

            'catatan' => [
                'nullable',
                'string',
                'max:1000',
            ],

        ], [

            'nomor_surat.required' =>
                'Nomor surat wajib diisi.',

            'nomor_surat.unique' =>
                'Nomor surat sudah digunakan.',

            'kegiatan.required' =>
                'Kegiatan wajib diisi.',

            'pegawai_id.required' =>
                'Pegawai wajib dipilih.',

            'pegawai_id.exists' =>
                'Pegawai yang dipilih tidak ditemukan.',

            'instansi_id.exists' =>
                'Instansi yang dipilih tidak ditemukan.',

            'lokasi_id.exists' =>
                'Lokasi yang dipilih tidak ditemukan.',

            'jenis_kegiatan_id.exists' =>
                'Jenis kegiatan yang dipilih tidak ditemukan.',

            'tanggal_mulai.required' =>
                'Tanggal mulai wajib diisi.',

            'tanggal_selesai.after_or_equal' =>
                'Tanggal selesai tidak boleh sebelum tanggal mulai.',

            'dokumen_pdf.mimes' =>
                'Dokumen harus berupa PDF.',

            'dokumen_pdf.max' =>
                'Ukuran PDF maksimal 10 MB.',
        ]);


        /*
        |--------------------------------------------------------------------------
        | PDF
        |--------------------------------------------------------------------------
        |
        | PENTING:
        |
        | Kalau user TIDAK upload PDF baru:
        | PDF lama tetap dipertahankan.
        |
        | Kalau user upload PDF baru:
        | PDF lama dihapus lalu diganti dengan PDF baru.
        |
        */

        if ($request->hasFile('dokumen_pdf')) {

            /*
            | Hapus PDF lama
            */

            if ($suratTugas->dokumen_pdf) {

                Storage::disk('public')
                    ->delete($suratTugas->dokumen_pdf);
            }


            /*
            | Simpan PDF baru
            */

            $data['dokumen_pdf'] = $request
                ->file('dokumen_pdf')
                ->store('surat-tugas', 'public');

        } else {

            /*
            | Tidak upload PDF baru.
            | Ambil kembali PDF lama.
            */

            $data['dokumen_pdf'] = $suratTugas->dokumen_pdf;
        }


        /*
        |--------------------------------------------------------------------------
        | STATUS
        |--------------------------------------------------------------------------
        */

        if ($suratTugas->status === 'ditolak') {

            /*
            | Setelah diperbaiki:
            | ditolak -> draft
            */

            $data['status'] = 'draft';

            $data['approved_by'] = null;

            $data['approved_at'] = null;
        }


        /*
        |--------------------------------------------------------------------------
        | UPDATE
        |--------------------------------------------------------------------------
        */

        $suratTugas->update($data);


        return redirect()
            ->route('admin.surat-tugas.index')
            ->with(
                'success',
                'Surat Tugas berhasil diperbarui.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | DESTROY
    |--------------------------------------------------------------------------
    */

    public function destroy(SuratTugas $suratTugas)
    {
        /*
        | Hanya draft dan ditolak yang boleh dihapus.
        */

        if (!in_array($suratTugas->status, [
            'draft',
            'ditolak'
        ])) {

            return back()->with(
                'error',
                'Surat Tugas yang sudah diajukan atau disetujui tidak dapat dihapus.'
            );
        }


        /*
        | Hapus file PDF
        */

        if ($suratTugas->dokumen_pdf) {

            Storage::disk('public')
                ->delete($suratTugas->dokumen_pdf);
        }


        /*
        | Hapus database
        */

        $suratTugas->delete();


        return redirect()
            ->route('admin.surat-tugas.index')
            ->with(
                'success',
                'Surat Tugas berhasil dihapus.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | AJUKAN
    |--------------------------------------------------------------------------
    */

    public function ajukan(SuratTugas $suratTugas)
    {
        /*
        | Hanya draft dan ditolak yang bisa diajukan.
        */

        if (!in_array($suratTugas->status, [
            'draft',
            'ditolak'
        ])) {

            return back()->with(
                'error',
                'Surat Tugas tidak dapat diajukan pada status saat ini.'
            );
        }


        /*
        | PDF wajib ada.
        */

        if (!$suratTugas->dokumen_pdf) {

            return back()->with(
                'error',
                'Dokumen PDF wajib diupload sebelum diajukan.'
            );
        }


        $suratTugas->update([

            'status' => 'diajukan',

            'catatan' => null,

            'approved_by' => null,

            'approved_at' => null,

        ]);


        return back()->with(
            'success',
            'Surat Tugas berhasil diajukan ke pimpinan.'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | CETAK
    |--------------------------------------------------------------------------
    */

    public function cetak(SuratTugas $suratTugas)
    {
        if ($suratTugas->status !== 'disetujui') {

            return back()->with(
                'error',
                'Surat Tugas belum disetujui pimpinan.'
            );
        }


        $suratTugas->load([
            'pegawai',
            'pembuat',
            'approver',
            'instansi',
            'lokasi',
            'jenisKegiatan',
        ]);


        return view(
            'admin.surat-tugas.cetak',
            compact('suratTugas')
        );
    }
}