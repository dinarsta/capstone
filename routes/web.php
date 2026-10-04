<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TimProjectController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\MasterModelController;
use App\Http\Controllers\SuratTugasController;
use App\Http\Controllers\SlideDisplayController;
use App\Http\Controllers\TeksBerjalanController;
use App\Http\Controllers\SettingDisplayController;
use App\Http\Controllers\PimpinanController;


/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.process');

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');


/*
|--------------------------------------------------------------------------
| REDIRECT SETELAH LOGIN
|--------------------------------------------------------------------------
*/



Route::post('/surat-tugas/{suratTugas}/ajukan', [SuratTugasController::class, 'ajukan'])
    ->name('surat-tugas.ajukan');

Route::get('/surat-tugas/{suratTugas}/cetak', [SuratTugasController::class, 'cetak'])
    ->name('surat-tugas.cetak');


    
Route::get('/', function () {
    if (!auth()->check()) {
        return redirect()->route('login');
    }

    if (auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    if (auth()->user()->role === 'pimpinan') {
        return redirect()->route('pimpinan.dashboard');
    }

    abort(403);
});


/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');


        // Agenda
        Route::resource('agenda', AgendaController::class);


        // Project
        Route::resource('project', ProjectController::class);


        // Tim Project
        Route::resource('tim-project', TimProjectController::class);


        // Master Pegawai
        Route::resource('pegawai', PegawaiController::class);


        // Master Model
        Route::resource('master-model', MasterModelController::class);


        // Surat Tugas
        Route::resource('surat-tugas', SuratTugasController::class);


        // Slide Display
        Route::resource('slide-display', SlideDisplayController::class);


        // Teks Berjalan
        Route::resource('teks-berjalan', TeksBerjalanController::class);


        // Setting Display
        Route::resource('setting-display', SettingDisplayController::class);

    });


/*


|--------------------------------------------------------------------------
| PIMPINAN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:pimpinan'])
    ->prefix('pimpinan')
    ->name('pimpinan.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [PimpinanController::class, 'index'])
            ->name('dashboard');


        // Daftar pengajuan surat tugas
        Route::get('/surat-tugas', [PimpinanController::class, 'suratTugas'])
            ->name('surat-tugas');


        // Detail surat tugas
        Route::get('/surat-tugas/{id}', [PimpinanController::class, 'detailSurat'])
            ->name('surat-tugas.detail');


        // Approve
        Route::post('/surat-tugas/{id}/approve', [PimpinanController::class, 'approve'])
            ->name('surat-tugas.approve');


        // Reject
        Route::post('/surat-tugas/{id}/reject', [PimpinanController::class, 'reject'])
            ->name('surat-tugas.reject');

    });