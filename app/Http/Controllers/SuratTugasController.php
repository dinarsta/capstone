<?php

namespace App\Http\Controllers;

use App\Models\SuratTugas;
use App\Models\Pegawai;
use App\Models\MasterModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SuratTugasController extends Controller
{
    public function index()
    {
        $suratTugas = SuratTugas::with([
            'pegawai',
            'pembuat',
            'approver'
        ])->latest()->get();

        return view('admin.surat-tugas.index', compact('suratTugas'));
    }

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

    public function store(Request $request)
    {
        $data = $request->validate([
            'nomor_surat' => 'required|string|max:255|unique:surat_tugas,nomor_surat',
            'kegiatan' => 'required|string|max:255',
            'pegawai_id' => 'required|integer',
            'instansi_id' => 'nullable|integer',
            'lokasi_id' => 'nullable|integer',
            'jenis_kegiatan_id' => 'nullable|integer',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'dokumen_pdf' => 'nullable|file|mimes:pdf|max:10240',
            'catatan' => 'nullable|string',
        ]);

        if ($request->hasFile('dokumen_pdf')) {
            $data['dokumen_pdf'] = $request
                ->file('dokumen_pdf')
                ->store('surat-tugas', 'public');
        }

        $data['created_by'] = auth()->id();
        $data['status'] = 'draft';

        SuratTugas::create($data);

        return redirect()
            ->route('admin.surat-tugas.index')
            ->with('success', 'Surat tugas berhasil dibuat.');
    }

    public function show(SuratTugas $suratTugas)
    {
        $suratTugas->load([
            'pegawai',
            'pembuat',
            'approver',
            'instansi',
            'lokasi',
            'jenisKegiatan'
        ]);

        return view('admin.surat-tugas.show', compact('suratTugas'));
    }

    public function edit(SuratTugas $suratTugas)
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

        return view('admin.surat-tugas.edit', compact(
            'suratTugas',
            'pegawais',
            'instansi',
            'lokasi',
            'jenisKegiatan'
        ));
    }

    public function update(Request $request, SuratTugas $suratTugas)
    {
        $data = $request->validate([
            'nomor_surat' => 'required|string|max:255|unique:surat_tugas,nomor_surat,' . $suratTugas->id,
            'kegiatan' => 'required|string|max:255',
            'pegawai_id' => 'required|integer',
            'instansi_id' => 'nullable|integer',
            'lokasi_id' => 'nullable|integer',
            'jenis_kegiatan_id' => 'nullable|integer',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'dokumen_pdf' => 'nullable|file|mimes:pdf|max:10240',
            'catatan' => 'nullable|string',
        ]);

        if ($request->hasFile('dokumen_pdf')) {

            if ($suratTugas->dokumen_pdf) {
                Storage::disk('public')->delete($suratTugas->dokumen_pdf);
            }

            $data['dokumen_pdf'] = $request
                ->file('dokumen_pdf')
                ->store('surat-tugas', 'public');
        }

        // Kalau sebelumnya ditolak, setelah diperbaiki
        // status kembali menjadi draft.
        if ($suratTugas->status === 'ditolak') {
            $data['status'] = 'draft';
            $data['approved_by'] = null;
            $data['approved_at'] = null;
        }

        $suratTugas->update($data);

        return redirect()
            ->route('admin.surat-tugas.index')
            ->with('success', 'Surat tugas berhasil diperbarui.');
    }

    public function destroy(SuratTugas $suratTugas)
    {
        if ($suratTugas->dokumen_pdf) {
            Storage::disk('public')->delete($suratTugas->dokumen_pdf);
        }

        $suratTugas->delete();

        return redirect()
            ->route('admin.surat-tugas.index')
            ->with('success', 'Surat tugas berhasil dihapus.');
    }

    public function ajukan(SuratTugas $suratTugas)
    {
        if (!$suratTugas->dokumen_pdf) {
            return back()->with('error', 'Dokumen PDF wajib diupload sebelum diajukan.');
        }

        $suratTugas->update([
            'status' => 'diajukan',
            'catatan' => null,
            'approved_by' => null,
            'approved_at' => null,
        ]);

        return back()->with('success', 'Surat tugas berhasil diajukan ke pimpinan.');
    }

    public function cetak(SuratTugas $suratTugas)
    {
        if ($suratTugas->status !== 'disetujui') {
            return back()->with('error', 'Surat tugas belum disetujui pimpinan.');
        }

        return view('admin.surat-tugas.cetak', compact('suratTugas'));
    }
}