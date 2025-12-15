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
use App\Http\Controllers\Pemilik\PemilikDashboardController as PemilikDashboardController;
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
    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    
    // Jenis Hewan
    Route::get('jenis-hewan', [JenisHewanController::class, 'index'])->name('jenis-hewan.index');
    Route::get('jenis-hewan/create', [JenisHewanController::class, 'create'])->name('jenis-hewan.create');
    Route::post('jenis-hewan', [JenisHewanController::class, 'store'])->name('jenis-hewan.store');
    Route::get('jenis-hewan/{id}/edit', [JenisHewanController::class, 'edit'])->name('jenis-hewan.edit');
    Route::put('jenis-hewan/{id}', [JenisHewanController::class, 'update'])->name('jenis-hewan.update');
    Route::delete('jenis-hewan/{id}', [JenisHewanController::class, 'delete'])->name('jenis-hewan.delete');
    
    // Kategori
    Route::get('kategori', [KategoriController::class, 'index'])->name('kategori.index');
    Route::get('kategori/create', [KategoriController::class, 'create'])->name('kategori.create');
    Route::post('kategori', [KategoriController::class, 'store'])->name('kategori.store');
    Route::get('kategori/{id}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
    Route::put('kategori/{id}', [KategoriController::class, 'update'])->name('kategori.update');
    Route::delete('kategori/{id}', [KategoriController::class, 'delete'])->name('kategori.delete');
    
    // Kategori Klinis
    Route::get('kategori-klinis', [KategoriKlinisController::class, 'index'])->name('kategori-klinis.index');
    Route::get('kategori-klinis/create', [KategoriKlinisController::class, 'create'])->name('kategori-klinis.create');
    Route::post('kategori-klinis', [KategoriKlinisController::class, 'store'])->name('kategori-klinis.store');
    Route::get('kategori-klinis/{id}/edit', [KategoriKlinisController::class, 'edit'])->name('kategori-klinis.edit');
    Route::put('kategori-klinis/{id}', [KategoriKlinisController::class, 'update'])->name('kategori-klinis.update');
    Route::delete('kategori-klinis/{id}', [KategoriKlinisController::class, 'delete'])->name('kategori-klinis.delete');
    
    // Pemilik
    Route::get('pemilik', [AdminPemilikController::class, 'index'])->name('pemilik.index');
    Route::get('pemilik/create', [AdminPemilikController::class, 'create'])->name('pemilik.create');
    Route::post('pemilik', [AdminPemilikController::class, 'store'])->name('pemilik.store');
    Route::get('pemilik/{id}/edit', [AdminPemilikController::class, 'edit'])->name('pemilik.edit');
    Route::put('pemilik/{id}', [AdminPemilikController::class, 'update'])->name('pemilik.update');
    Route::delete('pemilik/{id}', [AdminPemilikController::class, 'delete'])->name('pemilik.delete');
    
    // Pet
    Route::get('pet', [AdminPetController::class, 'index'])->name('pet.index');
    Route::get('pet/create', [AdminPetController::class, 'create'])->name('pet.create');
    Route::post('pet', [AdminPetController::class, 'store'])->name('pet.store');
    Route::get('pet/{id}/edit', [AdminPetController::class, 'edit'])->name('pet.edit');
    Route::put('pet/{id}', [AdminPetController::class, 'update'])->name('pet.update');
    Route::delete('pet/{id}', [AdminPetController::class, 'delete'])->name('pet.delete');
    
    // Ras Hewan
    Route::get('ras-hewan', [RasHewanController::class, 'index'])->name('ras-hewan.index');
    Route::get('ras-hewan/create', [RasHewanController::class, 'create'])->name('ras-hewan.create');
    Route::post('ras-hewan', [RasHewanController::class, 'store'])->name('ras-hewan.store');
    Route::get('ras-hewan/{id}/edit', [RasHewanController::class, 'edit'])->name('ras-hewan.edit');
    Route::put('ras-hewan/{id}', [RasHewanController::class, 'update'])->name('ras-hewan.update');
    Route::delete('ras-hewan/{id}', [RasHewanController::class, 'delete'])->name('ras-hewan.delete');
    
    // Role
    Route::get('role', [RoleController::class, 'index'])->name('role.index');
    Route::get('role/create', [RoleController::class, 'create'])->name('role.create');
    Route::post('role', [RoleController::class, 'store'])->name('role.store');
    Route::get('role/{id}/edit', [RoleController::class, 'edit'])->name('role.edit');
    Route::put('role/{id}', [RoleController::class, 'update'])->name('role.update');
    Route::delete('role/{id}', [RoleController::class, 'delete'])->name('role.delete');
    
    // Role User
    Route::get('role-user', [RoleUserController::class, 'index'])->name('role-user.index');
    Route::get('role-user/create', [RoleUserController::class, 'create'])->name('role-user.create');
    Route::post('role-user', [RoleUserController::class, 'store'])->name('role-user.store');
    Route::get('role-user/{id}/edit', [RoleUserController::class, 'edit'])->name('role-user.edit');
    Route::put('role-user/{id}', [RoleUserController::class, 'update'])->name('role-user.update');
    Route::delete('role-user/{id}', [RoleUserController::class, 'delete'])->name('role-user.delete');
    
    // Tindakan Terapi
    Route::get('tindakan-terapi', [TindakanTerapiController::class, 'index'])->name('tindakan-terapi.index');
    Route::get('tindakan-terapi/create', [TindakanTerapiController::class, 'create'])->name('tindakan-terapi.create');
    Route::post('tindakan-terapi', [TindakanTerapiController::class, 'store'])->name('tindakan-terapi.store');
    Route::get('tindakan-terapi/{id}/edit', [TindakanTerapiController::class, 'edit'])->name('tindakan-terapi.edit');
    Route::put('tindakan-terapi/{id}', [TindakanTerapiController::class, 'update'])->name('tindakan-terapi.update');
    Route::delete('tindakan-terapi/{id}', [TindakanTerapiController::class, 'delete'])->name('tindakan-terapi.delete');
    
    // User
    Route::get('user', [UserController::class, 'index'])->name('user.index');
    Route::get('user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('user', [UserController::class, 'store'])->name('user.store');
    Route::get('user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('user/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('user/{id}', [UserController::class, 'delete'])->name('user.delete');
});

// Resepsionis Routes
Route::prefix('resepsionis')->name('resepsionis.')->middleware(['auth', 'check.role:Resepsionis'])->group(function () {
    Route::get('/dashboard', [ResepsionisController::class, 'index'])->name('dashboard');
    
    Route::prefix('registrasi')->name('registrasi.')->group(function () {
        Route::get('/pemilik', [ResepsionisPemilikController::class, 'index'])->name('pemilik');
        Route::post('/pemilik', [ResepsionisPemilikController::class, 'store'])->name('pemilik.store');

        Route::get('/pet', [ResepsionisPetController::class, 'index'])->name('index_pet');
        Route::get('/pet/create', [ResepsionisPetController::class, 'create'])->name('pet.create');
        Route::post('/pet', [ResepsionisPetController::class, 'store'])->name('pet.store');
        Route::delete('pet/{id}', [ResepsionisPetController::class, 'delete'])->name('pet.delete');
        Route::get('/pet/get-ras-hewan/{idjenis_hewan}', [ResepsionisPetController::class, 'getRasByJenis'])->name('pet.get-ras-hewan');
        
        // Di bagian Resepsionis Routes, update bagian temu-dokter
        Route::get('/temu-dokter', [TemuDokterController::class, 'index'])->name('temudokter');
        Route::get('/temu-dokter/create', [TemuDokterController::class, 'create'])->name('temudokter.create');
        Route::post('/temu-dokter', [TemuDokterController::class, 'store'])->name('temudokter.store');
        Route::put('/temu-dokter/{id}/status', [TemuDokterController::class, 'updateStatus'])->name('temudokter.updateStatus');
        Route::delete('/temu-dokter/{id}', [TemuDokterController::class, 'delete'])->name('temudokter.delete');
    });
});

// Dokter Routes
Route::prefix('dokter')->name('dokter.')->middleware(['auth', 'check.role:Dokter'])->group(function () {
    Route::get('/dashboard', [DokterDashboardController::class, 'index'])->name('dashboard');
    
    Route::prefix('detail-rekam-medis')->name('detail-rekam-medis.')->group(function () {
        Route::get('/', [DetailRekamMedisController::class, 'index'])->name('index');
        // Halaman pemeriksaan (Edit Rekam Medis)
        Route::get('/{idreservasi}/periksa', [DetailRekamMedisController::class, 'edit'])->name('edit');
        // Simpan Diagnosa & Tindakan
        Route::put('/{idreservasi}', [DetailRekamMedisController::class, 'update'])->name('update');
    });
});

// Perawat Routes
Route::prefix('perawat')->name('perawat.')->middleware(['auth', 'check.role:Perawat'])->group(function () {
    Route::get('/dashboard', [PerawatDashboardController::class, 'index'])->name('dashboard');
    
    Route::prefix('rekam-medis')->name('rekam-medis.')->group(function () {
        Route::get('/', [RekamMedisController::class, 'index'])->name('index');
        // Menggunakan idreservasi_dokter sebagai parameter
        Route::get('/create/{idreservasi}', [RekamMedisController::class, 'create'])->name('create');
        Route::post('/store', [RekamMedisController::class, 'store'])->name('store');
    });
});

// ... import controller lainnya di atas
use App\Http\Controllers\Pemilik\RiwayatController;

// ... kode route lainnya

// Pemilik Routes (Tambahkan blok ini)
Route::prefix('pemilik')->name('pemilik.')->middleware(['auth', 'check.role:Pemilik'])->group(function () {
    // Dashboard / Jadwal Temu (Halaman Utama Pemilik)
    Route::get('/jadwal', [App\Http\Controllers\Pemilik\PemilikController::class, 'index'])->name('jadwal');
    
    // Riwayat Rekam Medis
    Route::get('/riwayat', [App\Http\Controllers\Pemilik\PemilikController::class, 'riwayat'])->name('riwayat');
    Route::get('/riwayat/{id}/detail', [App\Http\Controllers\Pemilik\PemilikController::class, 'detailRiwayat'])->name('riwayat.detail');
});
// Pemilik Routes
// Route::prefix('pemilik')->name('pemilik.')->middleware(['auth', 'check.role:Pemilik'])->group(function () {
//     Route::get('/dashboard', [PemilikDashboardController::class, 'index'])->name('dashboard');
    
//     Route::prefix('jadwal')->name('jadwal.')->group(function () {
//         Route::get('/', [\App\Http\Controllers\Pemilik\PemilikJadwalController::class, 'index'])->name('index');
//     });
    
//     // Rekam Medis
//     Route::prefix('rekam-medis')->name('rekam-medis.')->group(function () {
//         Route::get('/', [\App\Http\Controllers\Pemilik\PemilikRekamMedisController::class, 'index'])->name('index');
//         Route::get('/{idpet}', [\App\Http\Controllers\Pemilik\PemilikRekamMedisController::class, 'show'])->name('show');
//         Route::get('/detail/{idrekam_medis}', [\App\Http\Controllers\Pemilik\PemilikRekamMedisController::class, 'detail'])->name('detail');
//     });
// });

// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'delete'])->name('profile.delete');
});