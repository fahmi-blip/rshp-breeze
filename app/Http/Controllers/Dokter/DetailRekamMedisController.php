<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DetailRekamMedisController extends Controller
{
    public function index()
    {
        // 1. Ambil ID Role User dokter yang sedang login
        $user = Auth::user();
        $dokter = DB::table('role_user')
            ->where('iduser', $user->iduser)
            ->where('idrole', 2) // 2 = Dokter
            ->first();

        if (!$dokter) {
            abort(403, 'Anda bukan Dokter');
        }

        // 2. Ambil antrian pasien khusus untuk dokter ini HARI INI
        $antrian = DB::table('temu_dokter')
            ->join('pet', 'temu_dokter.idpet', '=', 'pet.idpet')
            ->join('pemilik', 'pet.idpemilik', '=', 'pemilik.idpemilik')
            ->join('user as u_pemilik', 'pemilik.iduser', '=', 'u_pemilik.iduser')
            // Join ke rekam medis untuk cek status diagnosa
            ->leftJoin('rekam_medis', 'temu_dokter.idreservasi_dokter', '=', 'rekam_medis.idreservasi_dokter')
            ->select(
                'temu_dokter.idreservasi_dokter',
                'temu_dokter.no_urut',
                'temu_dokter.waktu_daftar',
                'temu_dokter.status',
                'pet.nama as nama_pet',
                'u_pemilik.nama as nama_pemilik',
                'rekam_medis.diagnosa',
                'rekam_medis.idrekam_medis'
            )
            ->where('temu_dokter.idrole_user', $dokter->idrole_user) // Filter by Dokter Login
            ->whereDate('temu_dokter.waktu_daftar', Carbon::today())
            ->orderBy('temu_dokter.no_urut', 'asc')
            ->get();

        return view('dokter.detail-rekam-medis.index', compact('antrian'));
    }

    public function edit($idreservasi)
    {
        // 1. Ambil Data Pasien & Data Perawat (Anamnesa, Temuan Klinis)
        $data = DB::table('temu_dokter')
            ->join('pet', 'temu_dokter.idpet', '=', 'pet.idpet')
            ->join('pemilik', 'pet.idpemilik', '=', 'pemilik.idpemilik')
            ->join('user as u_pemilik', 'pemilik.iduser', '=', 'u_pemilik.iduser')
            ->leftJoin('rekam_medis', 'temu_dokter.idreservasi_dokter', '=', 'rekam_medis.idreservasi_dokter')
            ->select(
                'temu_dokter.idreservasi_dokter',
                'pet.nama as nama_pet',
                'pet.jenis_kelamin',
                'pet.warna_tanda', // info tambahan
                'u_pemilik.nama as nama_pemilik',
                'rekam_medis.anamnesa',       // Inputan Perawat
                'rekam_medis.temuan_klinis',  // Inputan Perawat
                'rekam_medis.diagnosa',       // Akan diisi Dokter
                'rekam_medis.idrekam_medis'
            )
            ->where('temu_dokter.idreservasi_dokter', $idreservasi)
            ->first();

        if(!$data) {
            return redirect()->route('dokter.detail-rekam-medis.index')->with('error', 'Data tidak ditemukan');
        }

        // 2. Ambil Daftar Tindakan/Terapi untuk Dropdown
        // Mengelompokkan berdasarkan kategori klinis (Tindakan vs Terapi) agar rapi
        $tindakanList = DB::table('kode_tindakan_terapi')
            ->join('kategori_klinis', 'kode_tindakan_terapi.idkategori_klinis', '=', 'kategori_klinis.idkategori_klinis')
            ->select('kode_tindakan_terapi.*', 'kategori_klinis.nama_kategori_klinis')
            ->orderBy('kategori_klinis.nama_kategori_klinis')
            ->get();

        $existingTindakan = [];
        if ($data->idrekam_medis) {
            $existingTindakan = DB::table('detail_rekam_medis')
                ->where('idrekam_medis', $data->idrekam_medis)
                ->pluck('idkode_tindakan_terapi')
                ->toArray();
        }

        return view('dokter.detail-rekam-medis.edit', compact('data', 'tindakanList', 'existingTindakan'));
    }

    public function update(Request $request, $idreservasi)
    {
        $request->validate([
            'diagnosa' => 'required|string',
            'tindakan' => 'nullable|array', // Array ID tindakan
            'tindakan.*' => 'integer',
        ]);

        // 1. Update/Buat Data di Tabel Rekam Medis (Diagnosa)
        // Kita pakai updateOrInsert, tapi kita butuh ID rekam medisnya untuk tabel detail
        
        $user = Auth::user();
        $dokter = DB::table('role_user')->where('iduser', $user->iduser)->where('idrole', 2)->first();

        // Cek apakah record sudah ada (dibuat perawat)
        $rekamMedis = DB::table('rekam_medis')->where('idreservasi_dokter', $idreservasi)->first();
        
        $idRekamMedis = null;

        if ($rekamMedis) {
            // Update
            DB::table('rekam_medis')->where('idreservasi_dokter', $idreservasi)->update([
                'diagnosa' => $request->diagnosa,
                // Pastikan dokter pemeriksa terekam
                'dokter_pemeriksa' => $dokter->idrole_user, 
                // 'created_at' tidak diubah agar tahu kapan perawat input, atau bisa tambah updated_at
            ]);
            $idRekamMedis = $rekamMedis->idrekam_medis;
        } else {
            // Insert Baru (jika perawat lupa input)
            $idRekamMedis = DB::table('rekam_medis')->insertGetId([
                'idreservasi_dokter' => $idreservasi,
                'anamnesa' => '-', // Default karena perawat skip
                'temuan_klinis' => '-',
                'diagnosa' => $request->diagnosa,
                'dokter_pemeriksa' => $dokter->idrole_user,
                'created_at' => now()
            ]);
        }

        // 2. Simpan Tindakan/Terapi ke tabel detail_rekam_medis
        // Hapus dulu yang lama (reset) agar tidak duplikat saat edit
        DB::table('detail_rekam_medis')->where('idrekam_medis', $idRekamMedis)->delete();

        if ($request->has('tindakan')) {
            $insertData = [];
            foreach ($request->tindakan as $idTindakan) {
                $insertData[] = [
                    'idrekam_medis' => $idRekamMedis,
                    'idkode_tindakan_terapi' => $idTindakan,
                    'detail' => null // Bisa diisi catatan tambahan jika form menyediakan
                ];
            }
            DB::table('detail_rekam_medis')->insert($insertData);
        }

        // 3. Update Status Antrian jadi 'Selesai'
        DB::table('temu_dokter')->where('idreservasi_dokter', $idreservasi)->update([
            'status' => '3'
        ]);

        return redirect()->route('dokter.detail-rekam-medis.index')->with('success', 'Pemeriksaan selesai. Data berhasil disimpan.');
    }
}