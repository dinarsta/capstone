<?php

namespace App\Http\Controllers;

use App\Models\SuratTugas;
use Illuminate\Http\Request;

class PimpinanController extends Controller
{
    public function index()
    {
        $jumlahMenunggu = SuratTugas::where('status', 'diajukan')->count();

        $jumlahDisetujui = SuratTugas::where('status', 'disetujui')->count();

        $jumlahDitolak = SuratTugas::where('status', 'ditolak')->count();

        return view('pimpinan.dashboard', compact(
            'jumlahMenunggu',
            'jumlahDisetujui',
            'jumlahDitolak'
        ));
    }

    public function suratTugas()
    {
        $suratTugas = SuratTugas::with([
            'pegawai',
            'pembuat'
        ])
        ->where('status', 'diajukan')
        ->latest()
        ->get();

        return view('pimpinan.surat-tugas.index', compact('suratTugas'));
    }

    public function detailSurat($id)
    {
        $surat = SuratTugas::with([
            'pegawai',
            'pembuat'
        ])->findOrFail($id);

        return view('pimpinan.surat-tugas.detail', compact('surat'));
    }

    public function approve($id)
    {
        $surat = SuratTugas::findOrFail($id);

        $surat->update([
            'status' => 'disetujui',
            'approved_by' => auth()->id(),
            'approved_at' => now(),
        ]);

        return redirect()
            ->route('pimpinan.surat-tugas')
            ->with('success', 'Surat tugas berhasil disetujui.');
    }

    public function reject(Request $request, $id)
    {
        $request->validate([
            'catatan' => 'required|string',
        ]);

        $surat = SuratTugas::findOrFail($id);

        $surat->update([
            'status' => 'ditolak',
            'catatan' => $request->catatan,
            'approved_by' => auth()->id(),
            'approved_at' => now(),
        ]);

        return redirect()
            ->route('pimpinan.surat-tugas')
            ->with('success', 'Surat tugas ditolak.');
    }
}