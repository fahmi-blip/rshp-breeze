<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class SiteController extends Controller
{
    public function index()
    {
        return view('site.home');
    }
    public function visi()
    {
        return view('site.visi');
    }
    public function struktur()
    {
        return view('site.struktur');
    }
    public function layanan()
    {
        return view('site.layanan');

    }
    public function cekKoneksi()
    {
        try {
            DB::connection()->getPdo();
            return 'Koneksi Berhasil';
        } catch (\Exception $e) {
            return 'Koneksi Gagal: ' . $e->getMessage();
        }
    }
}