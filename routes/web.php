<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Site\SiteController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\JenisHewanController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\KategoriKlinisController;
use App\Http\Controllers\Admin\PemilikController as AdminPemilikController;
use App\Http\Controllers\Admin\PetController as AdminPetController;
use App\Http\Controllers\Admin\RasHewanController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\RoleUserController;
use App\Http\Controllers\Admin\TindakanTerapiController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Resepsionis\DashboardController as ResepsionisController;
use App\Http\Controllers\Resepsionis\PemilikController as ResepsionisPemilikController;
use App\Http\Controllers\Resepsionis\PetController as ResepsionisPetController;
use App\Http\Controllers\Resepsionis\TemuDokterController;
use App\Http\Controllers\Dokter\DashboardController as DokterDashboardController;
use App\Http\Controllers\Dokter\DetailRekamMedisController;
use App\Http\Controllers\Perawat\DashboardController as PerawatDashboardController;
use App\Http\Controllers\Perawat\RekamMedisController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Public Routes (Site)
// Di bagian paling atas setelah use statements
Route::get('/', function () {
    return view('welcome');
})->name('welcome');
Route::get('/home', [SiteController::class, 'index'])->name('site.index');
Route::get('/visi', [SiteController::class, 'visi'])->name('site.visi');
Route::get('/struktur', [SiteController::class, 'struktur'])->name('site.struktur');
Route::get('/layanan', [SiteController::class, 'layanan'])->name('site.layanan');
Route::get('/cek-koneksi', [SiteController::class, 'cekKoneksi'])->name('site.cek-koneksi');

// Auth Routes
require __DIR__.'/auth.php';

Route::get('/logout', function() {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
})->name('logout');
// Admin Routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'check.role:Admin'])->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    
    // Jenis Hewan
    Route::resource('jenis-hewan', JenisHewanController::class);
    
    // Kategori
    Route::resource('kategori', KategoriController::class);
    
    // Kategori Klinis
    Route::resource('kategori-klinis', KategoriKlinisController::class);
    
    // Pemilik
    Route::resource('pemilik', AdminPemilikController::class);
    
    // Pet
    Route::resource('pet', AdminPetController::class);
    
    // Ras Hewan
    Route::resource('ras-hewan', RasHewanController::class);
    
    // Role
    Route::resource('role', RoleController::class);
    
    // Role User
    Route::resource('role-user', RoleUserController::class);
    
    // Tindakan Terapi
    Route::resource('tindakan-terapi', TindakanTerapiController::class);
    
    // User
    Route::resource('user', UserController::class);
});

// Resepsionis Routes
Route::prefix('resepsionis')->name('resepsionis.')->middleware(['auth', 'check.role:Resepsionis'])->group(function () {
    Route::get('/dashboard', [ResepsionisController::class, 'index'])->name('dashboard');
    
    // Registrasi
    Route::prefix('registrasi')->name('registrasi.')->group(function () {
        Route::get('/pemilik', [ResepsionisPemilikController::class, 'index'])->name('pemilik');
        Route::get('/pet', [ResepsionisPetController::class, 'index'])->name('pet');
        Route::get('/temu-dokter', [TemuDokterController::class, 'index'])->name('temudokter');
    });
});

// Dokter Routes
Route::prefix('dokter')->name('dokter.')->middleware(['auth', 'check.role:Dokter'])->group(function () {
    Route::get('/dashboard', [DokterDashboardController::class, 'index'])->name('dashboard');
    
    // Detail Rekam Medis
    Route::prefix('detail-rekam-medis')->name('detail-rekam-medis.')->group(function () {
        Route::get('/', [DetailRekamMedisController::class, 'index'])->name('index');
    });
});

// Perawat Routes
Route::prefix('perawat')->name('perawat.')->middleware(['auth', 'check.role:Perawat'])->group(function () {
    Route::get('/dashboard', [PerawatDashboardController::class, 'index'])->name('dashboard');
    
    // Rekam Medis
    Route::prefix('rekam-medis')->name('rekam-medis.')->group(function () {
        Route::get('/', [RekamMedisController::class, 'index'])->name('index');
    });
});

// Profile Routes (untuk semua authenticated user)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});