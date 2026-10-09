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
        $slides = SlideDisplay::with('project')
            ->orderBy('urutan')
            ->orderBy('id')
            ->get();

        $projects = Project::orderBy('nama_project')->get();

        return view(
            'admin.slide-display.index',
            compact('slides', 'projects')
        );
    }

    public function create()
    {
        $projects = Project::orderBy('nama_project')->get();

        return view(
            'admin.slide-display.create',
            compact('projects')
        );
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'judul'      => 'nullable|string|max:255',
            'gambar'     => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
            'urutan'     => 'nullable|integer|min:0',
            'aktif'      => 'nullable|boolean',
        ]);

     
        $data['gambar'] = $request->file('gambar')
            ->store('slide-display', 'public');

        $data['urutan'] = $data['urutan'] ?? 0;
        $data['aktif'] = $request->boolean('aktif');

       
        SlideDisplay::create($data);

        return redirect()
            ->route('admin.slide-display.index')
            ->with('success', 'Slide berhasil ditambahkan.');
    }

    public function show(SlideDisplay $slideDisplay)
    {
        $slideDisplay->load('project');

        return view(
            'admin.slide-display.show',
            compact('slideDisplay')
        );
    }

    public function edit(SlideDisplay $slideDisplay)
    {
        $projects = Project::orderBy('nama_project')->get();

        return view(
            'admin.slide-display.edit',
            compact('slideDisplay', 'projects')
        );
    }

    public function update(
        Request $request,
        SlideDisplay $slideDisplay
    ) {
        $data = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'judul'      => 'nullable|string|max:255',
            'gambar'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'urutan'     => 'nullable|integer|min:0',
            'aktif'      => 'nullable|boolean',
        ]);

       
        if ($request->hasFile('gambar')) {
            $gambarBaru = $request->file('gambar')
                ->store('slide-display', 'public');

            
            if ($slideDisplay->gambar) {
                Storage::disk('public')->delete(
                    $slideDisplay->gambar
                );
            }

            $data['gambar'] = $gambarBaru;
        }

        // Pertahankan urutan lama jika tidak dikirim.
        $data['urutan'] = $data['urutan'] ?? $slideDisplay->urutan;

        // Checkbox tidak dicentang berarti nonaktif.
        $data['aktif'] = $request->boolean('aktif');

        $slideDisplay->update($data);

        return redirect()
            ->route('admin.slide-display.index')
            ->with('success', 'Slide berhasil diperbarui.');
    }

    public function destroy(SlideDisplay $slideDisplay)
    {
        // Hapus file gambar dari storage.
        if ($slideDisplay->gambar) {
            Storage::disk('public')->delete(
                $slideDisplay->gambar
            );
        }

    
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
       
        $projects = Project::with([
            'createdBy',
            'timProjects.pegawai',
            'slides' => function ($query) {
                $query->where('aktif', true)
                    ->whereNotNull('gambar')
                    ->orderBy('urutan')
                    ->orderBy('id');
            },
        ])
            ->orderBy('nama_project')
            ->get();

        
        $teksBerjalans = TeksBerjalan::where('aktif', true)
            ->latest()
            ->get();

        return view(
            'display.index',
            compact('projects', 'teksBerjalans')
        );
    }
}