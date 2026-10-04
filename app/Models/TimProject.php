<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Pegawai;
use App\Models\TimProject;
use Illuminate\Http\Request;

class TimProjectController extends Controller
{
    public function index()
    {
        $timProjects = TimProject::with([
            'project',
            'pegawai'
        ])->latest()->get();

        return view('admin.tim-project.index', compact('timProjects'));
    }

    public function create()
    {
        $projects = Project::orderBy('nama_project')->get();
        $pegawais = Pegawai::orderBy('nama')->get();

        return view('admin.tim-project.create', compact(
            'projects',
            'pegawais'
        ));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'project_id' => 'required|integer',
            'pegawai_id' => 'required|integer',
            'peran' => 'nullable|string|max:255',
        ]);

        TimProject::create($data);

        return redirect()
            ->route('admin.tim-project.index')
            ->with('success', 'Anggota tim berhasil ditambahkan.');
    }

    public function show(TimProject $timProject)
    {
        $timProject->load([
            'project',
            'pegawai'
        ]);

        return view('admin.tim-project.show', compact('timProject'));
    }

    public function edit(TimProject $timProject)
    {
        $projects = Project::orderBy('nama_project')->get();
        $pegawais = Pegawai::orderBy('nama')->get();

        return view('admin.tim-project.edit', compact(
            'timProject',
            'projects',
            'pegawais'
        ));
    }

    public function update(Request $request, TimProject $timProject)
    {
        $data = $request->validate([
            'project_id' => 'required|integer',
            'pegawai_id' => 'required|integer',
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