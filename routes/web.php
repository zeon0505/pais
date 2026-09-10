<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\SlideController;
use App\Http\Controllers\Admin\DosenController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\BeritaController;
use App\Http\Controllers\Admin\PosterController;

// ═══════════════════════════════════════════
//  PUBLIC ROUTES
// ═══════════════════════════════════════════
Route::get('/', [PageController::class, 'home'])->name('home');
// Profil
Route::get('/sejarah',    [PageController::class, 'sejarah'])->name('pages.sejarah');
Route::get('/visi-misi',  [PageController::class, 'visiMisi'])->name('pages.visi-misi');
Route::get('/struktur-organisasi', [PageController::class, 'strukturOrganisasi'])->name('pages.struktur-organisasi');
Route::get('/dosen',      [PageController::class, 'dosen'])->name('pages.dosen');
Route::get('/dosen/{slug}', [PageController::class, 'dosenShow'])->name('pages.dosen.show');
Route::get('/akreditasi', [PageController::class, 'akreditasi'])->name('pages.akreditasi');

// Akademik
Route::get('/kurikulum',  [PageController::class, 'kurikulum'])->name('pages.kurikulum');
Route::get('/rps',        [PageController::class, 'rps'])->name('pages.rps');
Route::get('/kalender-akademik', [PageController::class, 'kalenderAkademik'])->name('pages.kalender-akademik');
Route::get('/panduan-tugas-akhir', [PageController::class, 'panduanTa'])->name('pages.panduan-ta');
Route::get('/pedoman-ppl',[PageController::class, 'pedomanPpl'])->name('pages.pedoman-ppl');
Route::get('/lab-microteaching', [PageController::class, 'labMicroteaching'])->name('pages.lab-microteaching');

// PMB & Kemahasiswaan
Route::get('/info-pendaftaran', [PageController::class, 'infoPmb'])->name('pages.info-pmb');
Route::get('/kegiatan-prestasi', [PageController::class, 'kegiatanPrestasi'])->name('pages.kegiatan-prestasi');

// Tridharma
Route::get('/penelitian', [PageController::class, 'penelitian'])->name('pages.penelitian');
Route::get('/pengabdian', [PageController::class, 'pengabdian'])->name('pages.pengabdian');
Route::get('/kerjasama',  [PageController::class, 'kerjasama'])->name('pages.kerjasama');
Route::get('/jurnal',     [PageController::class, 'jurnal'])->name('pages.jurnal');

// Dokumen Akreditasi
Route::get('/dokumen-akreditasi', [PageController::class, 'dokumenAkreditasi'])->name('pages.dokumen-akreditasi');

// Berita & Pengumuman
Route::get('/berita',     [PageController::class, 'berita'])->name('pages.berita');
Route::get('/berita/{slug}', [PageController::class, 'beritaShow'])->name('pages.berita.show');
Route::get('/pengumuman', [PageController::class, 'pengumuman'])->name('pages.pengumuman');
Route::get('/pengumuman/{key}', [PageController::class, 'pengumumanShow'])->name('pages.pengumuman.show');

// ═══════════════════════════════════════════
//  ADMIN ROUTES (tersembunyi dari publik)
// ═══════════════════════════════════════════
Route::prefix('admin')->name('admin.')->group(function () {
    // Login (tanpa auth)
    Route::get('/login',  [AdminController::class, 'loginForm'])->name('login');
    Route::post('/login', [AdminController::class, 'login'])->name('login.post');

    // Route terproteksi
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::post('/logout', [AdminController::class, 'logout'])->name('logout');
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        Route::resource('slides',   SlideController::class)->except(['show']);
        Route::resource('dosens',   DosenController::class)->except(['show']);
        Route::resource('kategoris', KategoriController::class)->except(['show']);
        Route::resource('beritas',  BeritaController::class)->except(['show']);
        Route::post('/beritas/scrape',      [BeritaController::class, 'scrapeUrl'])->name('beritas.scrape');
        Route::post('/beritas/store-bulk',  [BeritaController::class, 'storeBulk'])->name('beritas.store-bulk');
        Route::resource('posters',  PosterController::class)->except(['show']);
    });
});