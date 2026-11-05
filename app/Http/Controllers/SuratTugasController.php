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
        'nomor_surat.required' => 'Nomor surat wajib diisi.',
        'nomor_surat.unique' => 'Nomor surat sudah digunakan.',
        'kegiatan.required' => 'Kegiatan wajib diisi.',
        'pegawai_id.required' => 'Pegawai wajib dipilih.',
        'pegawai_id.exists' => 'Pegawai yang dipilih tidak ditemukan.',
        'instansi_id.exists' => 'Instansi yang dipilih tidak ditemukan.',
        'lokasi_id.exists' => 'Lokasi yang dipilih tidak ditemukan.',
        'jenis_kegiatan_id.exists' => 'Jenis kegiatan yang dipilih tidak ditemukan.',
        'tanggal_mulai.required' => 'Tanggal mulai wajib diisi.',
        'tanggal_selesai.after_or_equal' => 'Tanggal selesai tidak boleh sebelum tanggal mulai.',
        'dokumen_pdf.required' => 'Dokumen PDF wajib diupload.',
        'dokumen_pdf.mimes' => 'Dokumen harus berupa PDF.',
        'dokumen_pdf.max' => 'Ukuran PDF maksimal 10 MB.',
    ]);

    // Folder penyimpanan langsung ke public/surat-tugas
    $folder = public_path('surat-tugas');

    if (!is_dir($folder)) {
        mkdir($folder, 0755, true);
    }

    // Upload PDF
    if ($request->hasFile('dokumen_pdf')) {
        $file = $request->file('dokumen_pdf');

        $filename = $file->hashName();

        $file->move($folder, $filename);

        // Simpan nama file ke database
        $data['dokumen_pdf'] = $filename;
    }

    // Data tambahan
    $data['created_by'] = auth()->id();
    $data['status'] = 'draft';
    $data['approved_by'] = null;
    $data['approved_at'] = null;

    // Simpan database
    SuratTugas::create($data);

    return redirect()
        ->route('admin.surat-tugas.index')
        ->with('success', 'Surat Tugas berhasil dibuat.');
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

  public function update(Request $request, SuratTugas $suratTugas)
{
    // Hanya draft dan ditolak yang boleh diedit
    if (!in_array($suratTugas->status, ['draft', 'ditolak'])) {
        return redirect()
            ->route('admin.surat-tugas.index')
            ->with(
                'error',
                'Surat Tugas yang sudah diajukan atau disetujui tidak dapat diubah.'
            );
    }

    // Validasi data
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
        'nomor_surat.required' => 'Nomor surat wajib diisi.',
        'nomor_surat.unique' => 'Nomor surat sudah digunakan.',
        'kegiatan.required' => 'Kegiatan wajib diisi.',
        'pegawai_id.required' => 'Pegawai wajib dipilih.',
        'pegawai_id.exists' => 'Pegawai yang dipilih tidak ditemukan.',
        'instansi_id.exists' => 'Instansi yang dipilih tidak ditemukan.',
        'lokasi_id.exists' => 'Lokasi yang dipilih tidak ditemukan.',
        'jenis_kegiatan_id.exists' => 'Jenis kegiatan yang dipilih tidak ditemukan.',
        'tanggal_mulai.required' => 'Tanggal mulai wajib diisi.',
        'tanggal_selesai.after_or_equal' => 'Tanggal selesai tidak boleh sebelum tanggal mulai.',
        'dokumen_pdf.mimes' => 'Dokumen harus berupa PDF.',
        'dokumen_pdf.max' => 'Ukuran PDF maksimal 10 MB.',
    ]);

    // Folder penyimpanan
    $folder = public_path('surat-tugas');

    if (!is_dir($folder)) {
        mkdir($folder, 0755, true);
    }

    // Jika upload PDF baru
    if ($request->hasFile('dokumen_pdf')) {

        // Hapus PDF lama
        if ($suratTugas->dokumen_pdf) {
            $oldFile = $folder . '/' . basename($suratTugas->dokumen_pdf);

            if (file_exists($oldFile)) {
                unlink($oldFile);
            }
        }

        // Upload PDF baru
        $file = $request->file('dokumen_pdf');

        $filename = $file->hashName();

        $file->move($folder, $filename);

        $data['dokumen_pdf'] = $filename;

    } else {

        // Jika tidak upload, pertahankan PDF lama
        $data['dokumen_pdf'] = $suratTugas->dokumen_pdf;
    }

    // Jika sebelumnya ditolak, kembalikan ke draft
    if ($suratTugas->status === 'ditolak') {
        $data['status'] = 'draft';
        $data['approved_by'] = null;
        $data['approved_at'] = null;
    }

    // Update database
    $suratTugas->update($data);

    return redirect()
        ->route('admin.surat-tugas.index')
        ->with('success', 'Surat Tugas berhasil diperbarui.');
}


    /*
    |--------------------------------------------------------------------------
    | DESTROY
    |--------------------------------------------------------------------------
    */

   public function destroy(SuratTugas $suratTugas)
{
    // Hanya draft dan ditolak yang boleh dihapus
    if (!in_array($suratTugas->status, ['draft', 'ditolak'])) {
        return back()->with(
            'error',
            'Surat Tugas yang sudah diajukan atau disetujui tidak dapat dihapus.'
        );
    }

    // Hapus file PDF dari public/surat-tugas
    if ($suratTugas->dokumen_pdf) {

        $filePath = public_path(
            'surat-tugas/' . basename($suratTugas->dokumen_pdf)
        );

        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }

    // Hapus data database
    $suratTugas->delete();

    return redirect()
        ->route('admin.surat-tugas.index')
        ->with('success', 'Surat Tugas berhasil dihapus.');
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