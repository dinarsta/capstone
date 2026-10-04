<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::latest()->get();

        return view('admin.project.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.project.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_project' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tanggal_mulai' => 'nullable|date',
            'tanggal_selesai' => 'nullable|date',
            'progress' => 'required|integer|min:0|max:100',
            'status' => 'required|string',
        ]);

        $data['created_by'] = auth()->id();

        Project::create($data);

        return redirect()
            ->route('admin.project.index')
            ->with('success', 'Project berhasil ditambahkan.');
    }

    public function show(Project $project)
    {
        $project->load('timProject.pegawai');

        return view('admin.project.show', compact('project'));
    }

    public function edit(Project $project)
    {
        return view('admin.project.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $data = $request->validate([
            'nama_project' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tanggal_mulai' => 'nullable|date',
            'tanggal_selesai' => 'nullable|date',
            'progress' => 'required|integer|min:0|max:100',
            'status' => 'required|string',
        ]);

        $project->update($data);

        return redirect()
            ->route('admin.project.index')
            ->with('success', 'Project berhasil diperbarui.');
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()
            ->route('admin.project.index')
            ->with('success', 'Project berhasil dihapus.');
    }
}