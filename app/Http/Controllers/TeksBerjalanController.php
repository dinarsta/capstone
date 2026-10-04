<?php

namespace App\Http\Controllers;

use App\Models\TeksBerjalan;
use Illuminate\Http\Request;

class TeksBerjalanController extends Controller
{
    public function index()
    {
        $teks = TeksBerjalan::latest()->get();

        return view('admin.teks-berjalan.index', compact('teks'));
    }

    public function create()
    {
        return view('admin.teks-berjalan.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'teks' => 'required|string',
        ]);

        $data['aktif'] = true;

        TeksBerjalan::create($data);

        return redirect()
            ->route('admin.teks-berjalan.index')
            ->with('success', 'Teks berjalan berhasil ditambahkan.');
    }

    public function show(TeksBerjalan $teksBerjalan)
    {
        return view('admin.teks-berjalan.show', compact('teksBerjalan'));
    }

    public function edit(TeksBerjalan $teksBerjalan)
    {
        return view('admin.teks-berjalan.edit', compact('teksBerjalan'));
    }

    public function update(Request $request, TeksBerjalan $teksBerjalan)
    {
        $data = $request->validate([
            'teks' => 'required|string',
            'aktif' => 'nullable|boolean',
        ]);

        $data['aktif'] = $request->has('aktif');

        $teksBerjalan->update($data);

        return redirect()
            ->route('admin.teks-berjalan.index')
            ->with('success', 'Teks berjalan berhasil diperbarui.');
    }

    public function destroy(TeksBerjalan $teksBerjalan)
    {
        $teksBerjalan->delete();

        return redirect()
            ->route('admin.teks-berjalan.index')
            ->with('success', 'Teks berjalan berhasil dihapus.');
    }
}