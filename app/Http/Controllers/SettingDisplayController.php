<?php

namespace App\Http\Controllers;

use App\Models\SettingDisplay;
use Illuminate\Http\Request;

class SettingDisplayController extends Controller
{
    public function index()
    {
        $settings = SettingDisplay::latest()->get();

        return view('admin.setting-display.index', compact('settings'));
    }

    public function create()
    {
        return view('admin.setting-display.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_setting' => 'required|string|max:255',
            'nilai' => 'nullable|string',
        ]);

        SettingDisplay::create($data);

        return redirect()
            ->route('admin.setting-display.index')
            ->with('success', 'Setting berhasil ditambahkan.');
    }

    public function show(SettingDisplay $settingDisplay)
    {
        return view('admin.setting-display.show', compact('settingDisplay'));
    }

    public function edit(SettingDisplay $settingDisplay)
    {
        return view('admin.setting-display.edit', compact('settingDisplay'));
    }

    public function update(Request $request, SettingDisplay $settingDisplay)
    {
        $data = $request->validate([
            'nama_setting' => 'required|string|max:255',
            'nilai' => 'nullable|string',
        ]);

        $settingDisplay->update($data);

        return redirect()
            ->route('admin.setting-display.index')
            ->with('success', 'Setting berhasil diperbarui.');
    }

    public function destroy(SettingDisplay $settingDisplay)
    {
        $settingDisplay->delete();

        return redirect()
            ->route('admin.setting-display.index')
            ->with('success', 'Setting berhasil dihapus.');
    }
}