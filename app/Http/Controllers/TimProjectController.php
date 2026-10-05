<?php

namespace App\Http\Controllers;

use App\Models\TimProject;
use App\Models\Project;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class TimProjectController extends Controller
{
    public function index()
    {
        $timProjects = TimProject::with([
            'project',
            'pegawai'
        ])->latest()->get();

        $projects = Project::orderBy('nama_project')->get();

        $pegawais = Pegawai::orderBy('nama')->get();

        return view('admin.tim-project.index', compact(
            'timProjects',
            'projects',
            'pegawais'
        ));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'pegawai_id' => 'required|exists:pegawais,id',
            'peran' => 'nullable|string|max:255',
        ]);

        TimProject::create($data);

        return redirect()
            ->route('admin.tim-project.index')
            ->with('success', 'Anggota tim berhasil ditambahkan.');
    }

    public function update(Request $request, TimProject $timProject)
    {
        $data = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'pegawai_id' => 'required|exists:pegawais,id',
            'peran' => 'nullable|string|max:255',
        ]);

        $timProject->update($data);

        return redirect()
            ->route('admin.tim-project.index')
            ->with('success', 'Anggota tim berhasil diperbarui.');
    }

    public function destroy(TimProject $timProject)
    {
        $timProject->delete();

        return redirect()
            ->route('admin.tim-project.index')
            ->with('success', 'Anggota tim berhasil dihapus.');
    }
}