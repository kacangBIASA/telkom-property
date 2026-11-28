<?php

use App\Http\Controllers\{AsetController, AuthController, DashboardController, KatalogController, BerandaController, PrioritasController, KriteriaController, PenilaianController, PerhitunganController, PeringkatController, ProfilController, WilayahController};
use Illuminate\Support\Facades\Route;

Route::get('/', [BerandaController::class, 'index'])->name('beranda');
Route::get('/katalog', [KatalogController::class, 'index'])->name('katalog');
Route::get('/katalog/export-pdf', [KatalogController::class, 'pdfSemua'])->name('katalog.pdf');
Route::get('/katalog/{aset}', [KatalogController::class, 'show'])->name('katalog.show');
Route::get('/katalog/{aset}/pdf', [KatalogController::class, 'pdfAset'])->name('katalog.pdf.aset');
Route::get('/prioritas', [PrioritasController::class, 'index'])->name('prioritas');
Route::get('/prioritas/pdf', [PrioritasController::class, 'pdf'])->name('prioritas.pdf');

Route::get('/login', [AuthController::class, 'form'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('wilayah', WilayahController::class)->only(['index', 'store', 'update', 'destroy']);
    Route::resource('aset', AsetController::class);
    Route::get('/kriteria', [KriteriaController::class, 'index'])->name('kriteria.index');
    Route::put('/kriteria/{kriteria}', [KriteriaController::class, 'update'])->name('kriteria.update');
    Route::get('/penilaian', [PenilaianController::class, 'index'])->name('penilaian');
    Route::resource('perhitungan', PerhitunganController::class)->only(['index', 'store', 'show', 'destroy']);
    Route::get('/perhitungan/{perhitungan}/pdf', [PerhitunganController::class, 'pdf'])->name('perhitungan.pdf');
    Route::get('/peringkat', [PeringkatController::class, 'index'])->name('peringkat');
    Route::get('/profil', [ProfilController::class, 'edit'])->name('profil');
    Route::put('/profil', [ProfilController::class, 'update'])->name('profil.update');
    Route::put('/profil/password', [ProfilController::class, 'password'])->name('profil.password');
});
