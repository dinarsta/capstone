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

Route::get('/register', [AuthController::class, 'showRegister'])
    ->name('register');

Route::post('/register', [AuthController::class, 'register'])
    ->name('register.process');

Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.process');

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');


/*
|--------------------------------------------------------------------------
| DISPLAY TV
|--------------------------------------------------------------------------
*/

Route::get('/display', [SlideDisplayController::class, 'display'])
    ->name('display');


/*
|--------------------------------------------------------------------------
| ROOT
|--------------------------------------------------------------------------
*/

Route::get('/', function () {

    if (!auth()->check()) {
        return redirect()->route('login');
    }

    if (auth()->user()->role === 'admin') {
        return redirect()->route('admin.agenda.index');
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

        /*
        |--------------------------------------------------------------------------
        | AGENDA
        |--------------------------------------------------------------------------
        */

        Route::resource('agenda', AgendaController::class);


        /*
        |--------------------------------------------------------------------------
        | PROJECT
        |--------------------------------------------------------------------------
        */

        Route::resource('project', ProjectController::class);


        /*
        |--------------------------------------------------------------------------
        | TIM PROJECT
        |--------------------------------------------------------------------------
        */

        Route::resource('tim-project', TimProjectController::class);


        /*
        |--------------------------------------------------------------------------
        | PEGAWAI
        |--------------------------------------------------------------------------
        */

        Route::resource('pegawai', PegawaiController::class);


        /*
        |--------------------------------------------------------------------------
        | MASTER MODEL
        |--------------------------------------------------------------------------
        */

        Route::resource('master-model', MasterModelController::class);


        /*
        |--------------------------------------------------------------------------
        | SURAT TUGAS
        |--------------------------------------------------------------------------
        */

        Route::post(
            '/surat-tugas/{suratTugas}/ajukan',
            [SuratTugasController::class, 'ajukan']
        )->name('surat-tugas.ajukan');

        Route::get(
            '/surat-tugas/{suratTugas}/cetak',
            [SuratTugasController::class, 'cetak']
        )->name('surat-tugas.cetak');

        Route::resource(
            'surat-tugas',
            SuratTugasController::class
        );


        /*
        |--------------------------------------------------------------------------
        | SLIDE DISPLAY
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'slide-display',
            SlideDisplayController::class
        );


        /*
        |--------------------------------------------------------------------------
        | TEKS BERJALAN
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'teks-berjalan',
            TeksBerjalanController::class
        );


        /*
        |--------------------------------------------------------------------------
        | SETTING DISPLAY
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'setting-display',
            SettingDisplayController::class
        );

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

        /*
        |--------------------------------------------------------------------------
        | DASHBOARD
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/dashboard',
            [PimpinanController::class, 'index']
        )->name('dashboard');


        /*
        |--------------------------------------------------------------------------
        | SURAT TUGAS
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/surat-tugas',
            [PimpinanController::class, 'suratTugas']
        )->name('surat-tugas');


        /*
        |--------------------------------------------------------------------------
        | DETAIL SURAT TUGAS
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/surat-tugas/{id}',
            [PimpinanController::class, 'detailSurat']
        )->name('surat-tugas.detail');


        /*
        |--------------------------------------------------------------------------
        | APPROVE
        |--------------------------------------------------------------------------
        */

        Route::post(
            '/surat-tugas/{id}/approve',
            [PimpinanController::class, 'approve']
        )->name('surat-tugas.approve');


        /*
        |--------------------------------------------------------------------------
        | REJECT
        |--------------------------------------------------------------------------
        */

        Route::post(
            '/surat-tugas/{id}/reject',
            [PimpinanController::class, 'reject']
        )->name('surat-tugas.reject');

    });