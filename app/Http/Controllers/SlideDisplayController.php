<?php

namespace App\Http\Controllers;

use App\Models\SlideDisplay;
use App\Models\Project;
use App\Models\TeksBerjalan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SlideDisplayController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | HELPER - PENYIMPANAN GAMBAR PUBLIC
    |--------------------------------------------------------------------------
    */

    private function uploadGambar(Request $request): string
    {
        $directory = public_path('slide-display');

        if (!File::isDirectory($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        $file = $request->file('gambar');
        $namaFile = Str::uuid() . '.' . $file->extension();

        $file->move($directory, $namaFile);

        return 'slide-display/' . $namaFile;
    }

    private function hapusGambar(?string $path): void
    {
        if (!$path) {
            return;
        }

        // Hanya hapus file di folder slide-display.
        if (str_starts_with($path, 'slide-display/')) {
            $filePublic = public_path($path);

            if (File::exists($filePublic)) {
                File::delete($filePublic);
            }
        }

        // Bersihkan file lama dari storage Laravel jika masih ada.
        if (str_starts_with($path, 'slide-display/')) {
            Storage::disk('public')->delete($path);
        }
    }

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

        $data['gambar'] = $this->uploadGambar($request);
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
            // Simpan gambar baru terlebih dahulu.
            $gambarBaru = $this->uploadGambar($request);

            $gambarLama = $slideDisplay->gambar;

            $data['gambar'] = $gambarBaru;

            $slideDisplay->update([
                ...$data,
                'urutan' => $data['urutan'] ?? $slideDisplay->urutan,
                'aktif'  => $request->boolean('aktif'),
            ]);

            // Hapus gambar lama setelah data berhasil diperbarui.
            if ($gambarLama !== $gambarBaru) {
                $this->hapusGambar($gambarLama);
            }
        } else {
            $data['urutan'] = $data['urutan'] ?? $slideDisplay->urutan;
            $data['aktif'] = $request->boolean('aktif');

            $slideDisplay->update($data);
        }

        return redirect()
            ->route('admin.slide-display.index')
            ->with('success', 'Slide berhasil diperbarui.');
    }

    public function destroy(SlideDisplay $slideDisplay)
    {
        $gambar = $slideDisplay->gambar;

        $slideDisplay->delete();

        $this->hapusGambar($gambar);

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
