<?php

namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TemuDokterController extends Controller
{
    public function index()
    {
        // Ambil data antrian hari ini
        $temuDokter = DB::table('temu_dokter')
            ->join('pet', 'temu_dokter.idpet', '=', 'pet.idpet')
            ->join('pemilik', 'pet.idpemilik', '=', 'pemilik.idpemilik')
            ->join('user as pemilik_user', 'pemilik.iduser', '=', 'pemilik_user.iduser')
            ->join('role_user', 'temu_dokter.idrole_user', '=', 'role_user.idrole_user')
            ->join('user as dokter_user', 'role_user.iduser', '=', 'dokter_user.iduser')
            ->whereDate('temu_dokter.waktu_daftar', date('Y-m-d'))
            ->select(
                'temu_dokter.*',
                'pet.nama as nama_pet',
                'pemilik_user.nama as nama_pemilik',
                'dokter_user.nama as nama_dokter'
            )
            ->orderBy('temu_dokter.idreservasi_dokter', 'asc')
            ->get();

        return view('resepsionis.registrasi.temu-dokter', compact('temuDokter'));
    }

    public function create()
    {
        // Ambil data pet beserta pemiliknya
        $pets = DB::table('pet')
            ->join('pemilik', 'pet.idpemilik', '=', 'pemilik.idpemilik')
            ->join('user', 'pemilik.iduser', '=', 'user.iduser')
            ->select(
                'pet.idpet',
                'pet.nama as nama_pet',
                'user.nama as nama_pemilik'
            )
            ->get();

        // Ambil data dokter (role_user dengan idrole = 2 untuk Dokter)
        $dokters = DB::table('role_user')
            ->join('user', 'role_user.iduser', '=', 'user.iduser')
            ->join('role', 'role_user.idrole', '=', 'role.idrole')
            ->where('role_user.idrole', 2) // ID role Dokter
            ->where('role_user.status', 1) // Status aktif
            ->select(
                'role_user.idrole_user',
                'user.nama as nama_dokter'
            )
            ->get();

        return view('resepsionis.registrasi.create_temu', compact('pets', 'dokters'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'idpet' => 'required|exists:pet,idpet',
            'idrole_user' => 'required|exists:role_user,idrole_user',
        ], [
            'idpet.required' => 'Pet wajib dipilih.',
            'idpet.exists' => 'Pet yang dipilih tidak valid.',
            'idrole_user.required' => 'Dokter wajib dipilih.',
            'idrole_user.exists' => 'Dokter yang dipilih tidak valid.',
        ]);

    $idreservasi_dokter = DB::table('temu_dokter')->insertGetId([
        'no_urut' => 0,
        'idpet' => $request->idpet,
        'idrole_user' => $request->idrole_user,
        'waktu_daftar' => date('Y-m-d h-i-s'),
        'status' => '1' // Status: 1=Menunggu
    ]);
    DB::table('temu_dokter')
        ->where('idreservasi_dokter', $idreservasi_dokter) // Gunakan Primary Key tabel temu_dokter
        ->update([
            'no_urut' => $idreservasi_dokter
        ]);

        return redirect()
            ->route('resepsionis.registrasi.temudokter')
            ->with('success', 'Data temu dokter berhasil ditambahkan ke antrian.');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:1,2,3',
        ]);

        DB::table('temu_dokter')
            ->where('idreservasi_dokter', $id)
            ->update([
                'status' => $request->status
            ]);

        return redirect()
            ->route('resepsionis.registrasi.temudokter')
            ->with('success', 'Status antrian berhasil diperbarui.');
    }

    public function delete($id)
    {
        DB::table('temu_dokter')
            ->where('idreservasi_dokter', $id)
            ->delete();

        return redirect()
            ->route('resepsionis.registrasi.temudokter')
            ->with('success', 'Data temu dokter berhasil dihapus.');
    }
}