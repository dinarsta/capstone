<?php

namespace App\Http\Controllers;

use App\Models\SuratTugas;
use Illuminate\Http\Request;

class PimpinanController extends Controller
{
    /**
     * Dashboard Pimpinan
     */
    public function dashboard()
    {
        $totalSurat = SuratTugas::count();

        $diajukan = SuratTugas::where('status', 'diajukan')->count();

        $disetujui = SuratTugas::where('status', 'disetujui')->count();

        $ditolak = SuratTugas::where('status', 'ditolak')->count();

        $suratTerbaru = SuratTugas::with([
            'pegawai',
            'pembuat',
            'approver',
        ])
        ->latest()
        ->take(10)
        ->get();

        return view('pimpinan.dashboard', compact(
            'totalSurat',
            'diajukan',
            'disetujui',
            'ditolak',
            'suratTerbaru'
        ));
    }

    /**
     * Daftar Surat Tugas
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

        return view('pimpinan.surat-tugas.index', compact(
            'suratTugas'
        ));
    }

    /**
     * Detail Surat Tugas
     */
    public function detail(SuratTugas $suratTugas)
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
            'pimpinan.surat-tugas.detail',
            compact('suratTugas')
        );
    }

    /**
     * Approve Surat Tugas
     */
    public function approve(SuratTugas $suratTugas)
    {
        if ($suratTugas->status !== 'diajukan') {
            return back()->with(
                'error',
                'Surat Tugas hanya dapat disetujui jika berstatus diajukan.'
            );
        }

        $suratTugas->update([
            'status' => 'disetujui',
            'approved_by' => auth()->id(),
            'approved_at' => now(),
            'catatan' => null,
        ]);

        return redirect()
            ->route('pimpinan.surat-tugas.index')
            ->with(
                'success',
                'Surat Tugas berhasil disetujui.'
            );
    }

    /**
     * Reject Surat Tugas
     */
    public function reject(
        Request $request,
        SuratTugas $suratTugas
    ) {
        if ($suratTugas->status !== 'diajukan') {
            return back()->with(
                'error',
                'Surat Tugas hanya dapat ditolak jika berstatus diajukan.'
            );
        }

        $request->validate([
            'catatan' => 'required|string|max:1000',
        ]);

        $suratTugas->update([
            'status' => 'ditolak',
            'catatan' => $request->catatan,
            'approved_by' => null,
            'approved_at' => null,
        ]);

        return redirect()
            ->route('pimpinan.surat-tugas.index')
            ->with(
                'success',
                'Surat Tugas berhasil ditolak.'
            );
    }

    /**
     * Cetak Surat Tugas
     */
    public function cetak(SuratTugas $suratTugas)
    {
        if ($suratTugas->status !== 'disetujui') {
            abort(
                403,
                'Surat Tugas belum disetujui dan belum dapat dicetak.'
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