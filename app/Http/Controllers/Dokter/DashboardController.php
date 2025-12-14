<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // 1. Ambil Data Dokter (idrole_user) dari user yang login
        $dokter = DB::table('role_user')
            ->where('iduser', $user->iduser)
            ->where('idrole', 2) // Role ID 2 = Dokter
            ->first();

        // Validasi jika bukan dokter (safety check)
        if (!$dokter) {
            abort(403, 'Akses ditolak. Anda bukan Dokter.');
        }

        // 2. Hitung Pasien HARI INI (Semua Status)
        $pasienHariIni = DB::table('temu_dokter')
            ->where('idrole_user', $dokter->idrole_user) // Filter hanya pasien dokter ini
            ->whereDate('waktu_daftar', Carbon::today())     // Filter tanggal hari ini
            ->count();

        // 3. Hitung Pasien Menunggu (Belum Diperiksa)
        $pasienMenunggu = DB::table('temu_dokter')
            ->where('idrole_user', $dokter->idrole_user)
            ->whereDate('waktu_daftar', Carbon::today())
            ->where('status', '1')
            ->count();

        // 4. Hitung Pasien Selesai (Sudah Diperiksa)
        $pasienSelesai = DB::table('temu_dokter')
            ->where('idrole_user', $dokter->idrole_user)
            ->whereDate('waktu_daftar', Carbon::today())
            ->where('status', '3')
            ->count();

        // 5. Hitung Total Pasien (Seumur Hidup / All Time)
        $totalPasien = DB::table('temu_dokter')
            ->where('idrole_user', $dokter->idrole_user)
            ->count();

        return view('dokter.dashboard', compact(
            'pasienHariIni', 
            'pasienMenunggu', 
            'pasienSelesai', 
            'totalPasien'
        ));
    }
}