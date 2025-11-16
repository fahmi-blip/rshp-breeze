<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Site\SiteController;


Route::get('/', function () {
    return view('welcome');
});

route::get('/home', [SiteController::class, 'index'])->name('home');
route::get('/visi', [SiteController::class, 'visi'])->name('visi');
route::get('/struktur', [SiteController::class, 'struktur'])->name('struktur');
route::get('/layanan', [SiteController::class, 'layanan'])->name('layanan');


Route::get('admin/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

    // Route::get('/jenis-hewan', [App\Http\Controllers\Admin\JenisHewanController::class, 'index'])->name('jenis-hewan.index');
    // Route::get('/jenis-hewan/create', [App\Http\Controllers\Admin\JenisHewanController::class, 'create'])->name('jenis-hewan.create');
    // Route::post('/jenis-hewan/store', [App\Http\Controllers\Admin\JenisHewanController::class, 'store'])->name('jenis-hewan.store');
    
    Route::get('/pemilik', [App\Http\Controllers\Admin\PemilikController::class, 'index'])->name('pemilik.index');
    // Route::get('/pemilik/create', [App\Http\Controllers\Admin\PemilikController::class, 'create'])->name('pemilik.create');
    // Route::post('/pemilik/store', [App\Http\Controllers\Admin\PemilikController::class, 'store'])->name('pemilik.store');
    
    // Route::get('/ras-hewan', [App\Http\Controllers\Admin\RasHewanController::class, 'index'])->name('ras-hewan.index');
    // Route::get('/ras-hewan/create', [App\Http\Controllers\Admin\RasHewanController::class, 'create'])->name('ras-hewan.create');
    // Route::post('/ras-hewan/store', [App\Http\Controllers\Admin\RasHewanController::class, 'store'])->name('ras-hewan.store');
    
    // Route::get('/kategori', [App\Http\Controllers\Admin\KategoriController::class, 'index'])->name('kategori.index');
    // Route::get('/kategori/create', [App\Http\Controllers\Admin\KategoriController::class, 'create'])->name('kategori.create');
    // Route::post('/kategori/store', [App\Http\Controllers\Admin\KategoriController::class, 'store'])->name('kategori.store');
    
    // Route::get('/kategori-klinis', [App\Http\Controllers\Admin\KategoriKlinisController::class, 'index'])->name('kategori-klinis.index');
    // Route::get('/kategori-klinis/create', [App\Http\Controllers\Admin\KategoriKlinisController::class, 'create'])->name('kategori-klinis.create');
    // Route::post('/kategori-klinis/store', [App\Http\Controllers\Admin\KategoriKlinisController::class, 'store'])->name('kategori-klinis.store');
    
    // Route::get('/tindakan-terapi', [App\Http\Controllers\Admin\TindakanTerapiController::class, 'index'])->name('tindakan-terapi.index');
    // Route::get('/tindakan-terapi/create', [App\Http\Controllers\Admin\TindakanTerapiController::class, 'create'])->name('tindakan-terapi.create');
    // Route::post('/tindakan-terapi/store', [App\Http\Controllers\Admin\TindakanTerapiController::class, 'store'])->name('tindakan-terapi.store');
    
    // Route::get('/user', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('user.index');
    // Route::get('/user/create', [App\Http\Controllers\Admin\UserController::class, 'create'])->name('user.create');
    // Route::post('/user/store', [App\Http\Controllers\Admin\UserController::class, 'store'])->name('user.store');
    
    // Route::get('/role', [App\Http\Controllers\Admin\RoleController::class, 'index'])->name('role.index');
    // Route::get('/role/create', [App\Http\Controllers\Admin\RoleController::class, 'create'])->name('role.create');
    // Route::post('/role/store', [App\Http\Controllers\Admin\RoleController::class, 'store'])->name('role.store');
    
    // Route::get('/pet', [App\Http\Controllers\Admin\PetController::class, 'index'])->name('pet.index');
    // Route::get('/pet/create', [App\Http\Controllers\Admin\PetController::class, 'create'])->name('pet.create');
    // Route::post('/pet/store', [App\Http\Controllers\Admin\PetController::class, 'store'])->name('pet.store');
    
    // Route::get('/role-user', [App\Http\Controllers\Admin\RoleUserController::class, 'index'])->name('role-user.index');
    // Route::get('/role-user/create', [App\Http\Controllers\Admin\RoleUserController::class, 'create'])->name('role-user.create');
    // Route::post('/role-user/store', [App\Http\Controllers\Admin\RoleUserController::class, 'store'])->name('role-user.store');