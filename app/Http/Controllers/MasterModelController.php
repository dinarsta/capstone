<?php

namespace App\Http\Controllers;

use App\Models\MasterModel;
use Illuminate\Http\Request;

class MasterModelController extends Controller
{
    public function index()
    {
        $masters = MasterModel::latest()->get();

        return view('admin.master-model.index', compact('masters'));
    }

    public function create()
    {
        return view('admin.master-model.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'kategori' => 'required|string|max:100',
            'nama' => 'required|string|max:255',
            'aktif' => 'nullable|boolean',
        ]);

        $data['aktif'] = $request->has('aktif');

        MasterModel::create($data);

        return redirect()
            ->route('admin.master-model.index')
            ->with('success', 'Data master berhasil ditambahkan.');
    }

    public function show(MasterModel $masterModel)
    {
        return view('admin.master-model.show', compact('masterModel'));
    }

    public function edit(MasterModel $masterModel)
    {
        return view('admin.master-model.edit', compact('masterModel'));
    }

    public function update(Request $request, MasterModel $masterModel)
    {
        $data = $request->validate([
            'kategori' => 'required|string|max:100',
            'nama' => 'required|string|max:255',
            'aktif' => 'nullable|boolean',
        ]);

        $data['aktif'] = $request->has('aktif');

        $masterModel->update($data);

        return redirect()
            ->route('admin.master-model.index')
            ->with('success', 'Data master berhasil diperbarui.');
    }

    public function destroy(MasterModel $masterModel)
    {
        $masterModel->delete();

        return redirect()
            ->route('admin.master-model.index')
            ->with('success', 'Data master berhasil dihapus.');
    }
}