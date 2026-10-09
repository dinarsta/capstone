<?php

namespace App\Http\Controllers;

use App\Models\SlideDisplay;
use App\Models\Project;
use App\Models\TeksBerjalan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SlideDisplayController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | ADMIN - SLIDE DISPLAY
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $slides = SlideDisplay::orderBy('urutan')->get();

        return view('admin.slide-display.index', compact('slides'));
    }

    public function create()
    {
        return view('admin.slide-display.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'judul' => 'nullable|string|max:255',
            'gambar' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
            'urutan' => 'nullable|integer',
        ]);

        $data['gambar'] = $request
            ->file('gambar')
            ->store('slide-display', 'public');

        $data['aktif'] = true;

        SlideDisplay::create($data);

        return redirect()
            ->route('admin.slide-display.index')
            ->with('success', 'Slide berhasil ditambahkan.');
    }

    public function show(SlideDisplay $slideDisplay)
    {
        return view(
            'admin.slide-display.show',
            compact('slideDisplay')
        );
    }

    public function edit(SlideDisplay $slideDisplay)
    {
        return view(
            'admin.slide-display.edit',
            compact('slideDisplay')
        );
    }

    public function update(
        Request $request,
        SlideDisplay $slideDisplay
    ) {
        $data = $request->validate([
            'judul' => 'nullable|string|max:255',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'urutan' => 'nullable|integer',
            'aktif' => 'nullable|boolean',
        ]);

        // Pertahankan gambar lama jika tidak ada upload baru
        $data['gambar'] = $slideDisplay->gambar;

        // Ganti gambar hanya jika ada file baru
        if ($request->hasFile('gambar')) {
            $gambarLama = $slideDisplay->gambar;

            $gambarBaru = $request
                ->file('gambar')
                ->store('slide-display', 'public');

            $data['gambar'] = $gambarBaru;

            // Hapus gambar lama setelah gambar baru tersimpan
            if ($gambarLama) {
                Storage::disk('public')->delete($gambarLama);
            }
        }

        // Checkbox aktif: dicentang = true, tidak dicentang = false
        $data['aktif'] = $request->boolean('aktif');

        $slideDisplay->update($data);

        return redirect()
            ->route('admin.slide-display.index')
            ->with('success', 'Slide berhasil diperbarui.');
    }

    public function destroy(SlideDisplay $slideDisplay)
    {
        // Hapus file gambar dari storage
        if ($slideDisplay->gambar) {
            Storage::disk('public')->delete($slideDisplay->gambar);
        }

        // Hapus data slide dari database
        $slideDisplay->delete();

        return redirect()
            ->route('admin.slide-display.index')
            ->with('success', 'Slide berhasil dihapus.');
    }

    /*
    |--------------------------------------------------------------------------
    | DISPLAY TV
    |--------------------------------------------------------------------------
    */

    public function display()
    {
        // Data project beserta pembuat dan anggota tim
        $projects = Project::with([
            'createdBy',
            'timProjects.pegawai',
        ])
            ->orderBy('nama_project')
            ->get();

        // Gambar slide yang aktif
        $slides = SlideDisplay::where('aktif', true)
            ->orderBy('urutan')
            ->get();

        // Teks berjalan yang aktif
        $teksBerjalans = TeksBerjalan::where('aktif', true)
            ->latest()
            ->get();

        return view(
            'display.index',
            compact(
                'projects',
                'slides',
                'teksBerjalans'
            )
        );
    }
}
