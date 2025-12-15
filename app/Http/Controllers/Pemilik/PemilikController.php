<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PemilikController extends Controller
{
    // Menampilkan Jadwal Temu Dokter (Antrian)
    public function index()
    {
        $userId = Auth::id();

        // 1. Ambil ID Pemilik berdasarkan User Login
        $pemilik = DB::table('pemilik')->where('iduser', $userId)->first();

        if (!$pemilik) {
            abort(403, 'Data profil pemilik belum lengkap.');
        }

        // 2. Ambil Jadwal Temu Dokter milik hewan dari pemilik ini
        $jadwal = DB::table('temu_dokter')
            ->join('pet', 'temu_dokter.idpet', '=', 'pet.idpet')
            ->join('role_user', 'temu_dokter.idrole_user', '=', 'role_user.idrole_user') // Join ke Dokter
            ->join('user as dokter_user', 'role_user.iduser', '=', 'dokter_user.iduser')
            ->select(
                'temu_dokter.tanggal',
                'temu_dokter.no_urut',
                'temu_dokter.status',
                'temu_dokter.keluhan',
                'pet.nama as nama_pet',
                'dokter_user.nama as nama_dokter'
            )
            ->where('pet.idpemilik', $pemilik->idpemilik)
            ->orderBy('temu_dokter.tanggal', 'desc')
            ->get();

        return view('pemilik.jadwal', compact('jadwal'));
    }

    // Menampilkan Daftar Riwayat Medis (yang sudah selesai)
    public function riwayat()
    {
        $userId = Auth::id();
        $pemilik = DB::table('pemilik')->where('iduser', $userId)->first();

        if (!$pemilik) {
            abort(403, 'Data profil pemilik belum lengkap.');
        }

        $riwayat = DB::table('rekam_medis')
            ->join('temu_dokter', 'rekam_medis.idreservasi_dokter', '=', 'temu_dokter.idreservasi_dokter')
            ->join('pet', 'temu_dokter.idpet', '=', 'pet.idpet')
            ->join('role_user', 'rekam_medis.dokter_pemeriksa', '=', 'role_user.idrole_user')
            ->join('user as dokter_user', 'role_user.iduser', '=', 'dokter_user.iduser')
            ->select(
                'rekam_medis.idrekam_medis',
                'temu_dokter.tanggal',
                'pet.nama as nama_pet',
                'rekam_medis.diagnosa',
                'dokter_user.nama as nama_dokter'
            )
            ->where('pet.idpemilik', $pemilik->idpemilik)
            ->orderBy('temu_dokter.tanggal', 'desc')
            ->get();

        return view('pemilik.riwayat', compact('riwayat'));
    }

    // Menampilkan Detail Rekam Medis (Termasuk Tindakan/Terapi)
    public function detailRiwayat($id)
    {
        // Ambil Data Utama Rekam Medis
        $data = DB::table('rekam_medis')
            ->join('temu_dokter', 'rekam_medis.idreservasi_dokter', '=', 'temu_dokter.idreservasi_dokter')
            ->join('pet', 'temu_dokter.idpet', '=', 'pet.idpet')
            ->join('role_user', 'rekam_medis.dokter_pemeriksa', '=', 'role_user.idrole_user')
            ->join('user as dokter_user', 'role_user.iduser', '=', 'dokter_user.iduser')
            ->select(
                'rekam_medis.*',
                'temu_dokter.tanggal',
                'temu_dokter.keluhan',
                'pet.nama as nama_pet',
                'pet.jenis_kelamin',
                'pet.warna_tanda',
                'dokter_user.nama as nama_dokter'
            )
            ->where('rekam_medis.idrekam_medis', $id)
            ->first();

        // Ambil Detail Tindakan/Terapi
        $tindakan = DB::table('detail_rekam_medis')
            ->join('kode_tindakan_terapi', 'detail_rekam_medis.idkode_tindakan_terapi', '=', 'kode_tindakan_terapi.idkode_tindakan_terapi')
            ->where('detail_rekam_medis.idrekam_medis', $id)
            ->select('kode_tindakan_terapi.kode', 'kode_tindakan_terapi.deskripsi_tindakan_terapi')
            ->get();

        return view('pemilik.detail_riwayat', compact('data', 'tindakan'));
    }
}