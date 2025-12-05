<?php

namespace App\Http\Controllers\Perawat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RekamMedisController extends Controller
{
    public function index()
    {
        // Mengambil daftar pasien hari ini dari tabel temu_dokter
        $antrian = DB::table('temu_dokter')
            ->join('pet', 'temu_dokter.idpet', '=', 'pet.idpet')
            ->join('pemilik', 'pet.idpemilik', '=', 'pemilik.idpemilik')
            ->join('user as u_pemilik', 'pemilik.iduser', '=', 'u_pemilik.iduser')
            ->join('role_user as ru_dokter', 'temu_dokter.idrole_user', '=', 'ru_dokter.idrole_user')
            ->join('user as u_dokter', 'ru_dokter.iduser', '=', 'u_dokter.iduser')
            // Left join ke rekam_medis untuk mengecek apakah perawat sudah isi data atau belum
            ->leftJoin('rekam_medis', 'temu_dokter.idreservasi_dokter', '=', 'rekam_medis.idreservasi_dokter')
            ->select(
                'temu_dokter.idreservasi_dokter',
                'temu_dokter.waktu_daftar',
                'temu_dokter.status',
                'temu_dokter.no_urut',
                'pet.nama as nama_pet',
                'u_pemilik.nama as nama_pemilik',
                'u_dokter.nama as nama_dokter',
                'rekam_medis.idrekam_medis', // Jika null, berarti belum diperiksa perawat
                'rekam_medis.anamnesa',
                'rekam_medis.temuan_klinis'
            )
            ->whereDate('temu_dokter.waktu_daftar', Carbon::today())
            ->orderBy('temu_dokter.no_urut', 'asc')
            ->get();

        return view('perawat.rekam-medis.index', compact('antrian'));
    }

    public function create($idreservasi)
    {
        // Ambil detail antrian untuk ditampilkan di form
        $data = DB::table('temu_dokter')
            ->join('pet', 'temu_dokter.idpet', '=', 'pet.idpet')
            ->join('pemilik', 'pet.idpemilik', '=', 'pemilik.idpemilik')
            ->join('user as u_pemilik', 'pemilik.iduser', '=', 'u_pemilik.iduser')
            ->select(
                'temu_dokter.idreservasi_dokter',
                'pet.nama as nama_pet',
                'pet.jenis_kelamin',
                'u_pemilik.nama as nama_pemilik'
            )
            ->where('temu_dokter.idreservasi_dokter', $idreservasi)
            ->first();

        // Cek jika data sudah pernah diisi sebelumnya (untuk mode edit)
        $rekamMedis = DB::table('rekam_medis')
            ->where('idreservasi_dokter', $idreservasi)
            ->first();

        return view('perawat.rekam-medis.create', compact('data', 'rekamMedis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'idreservasi_dokter' => 'required|integer',
            'anamnesa' => 'required|string',
            'temuan_klinis' => 'required|string',
        ]);

        // 1. Ambil data dokter dari tabel temu_dokter untuk mengisi kolom dokter_pemeriksa
        $temuDokter = DB::table('temu_dokter')
            ->where('idreservasi_dokter', $request->idreservasi_dokter)
            ->first();

        if (!$temuDokter) {
            return redirect()->back()->with('error', 'Data antrian tidak ditemukan.');
        }

        // 2. Gunakan updateOrInsert agar fleksibel (bisa simpan baru atau update yang ada)
        DB::table('rekam_medis')->updateOrInsert(
            ['idreservasi_dokter' => $request->idreservasi_dokter], // Kondisi kunci
            [
                'created_at' => Carbon::now(),
                'anamnesa' => $request->anamnesa,
                'temuan_klinis' => $request->temuan_klinis,
                'dokter_pemeriksa' => $temuDokter->idrole_user, // FK ke role_user (Dokter)
                // Diagnosa dibiarkan null, nanti diisi dokter
            ]
        );

        // 3. Update status antrian menjadi 'Diperiksa' agar Dokter tahu pasien siap
        DB::table('temu_dokter')
            ->where('idreservasi_dokter', $request->idreservasi_dokter)
            ->update(['status' => '2']);

        return redirect()->route('perawat.rekam-medis.index')
            ->with('success', 'Data pemeriksaan awal berhasil disimpan.');
    }
}