<?php

namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Import Facade DB

class PetController extends Controller
{
    public function index()
    {
        $pet = DB::table('pet')
            ->join('pemilik', 'pet.idpemilik', '=', 'pemilik.idpemilik')
            ->join('user', 'pemilik.iduser', '=', 'user.iduser') // Ambil nama pemilik dari tabel user
            ->join('ras_hewan', 'pet.idras_hewan', '=', 'ras_hewan.idras_hewan')
            ->join('jenis_hewan', 'ras_hewan.idjenis_hewan', '=', 'jenis_hewan.idjenis_hewan')
            ->select('pet.*', 'user.nama as nama_pemilik', 'ras_hewan.nama_ras', 'jenis_hewan.nama_jenis_hewan')
            ->orderBy('pet.idpet', 'asc')
            ->get();
        return view('resepsionis.registrasi.index_pet', compact('pet'));
    }
    public function create()
    {
       $pemilik = DB::table('pemilik')
            ->join('user', 'pemilik.iduser', '=', 'user.iduser')
            ->select('pemilik.idpemilik', 'user.nama')
            ->get();
            
        $jenisHewan = DB::table('jenis_hewan')->get();
        foreach($pemilik as $p) {
            $p->user = (object)['nama' => $p->nama];
        }
   

        return view('resepsionis.registrasi.pet', compact('pemilik', 'jenisHewan'));
    }

    public function store(Request $request)
    {
        // Validasi input (tetap sama)
        $request->validate([
            'idpemilik' => 'required|exists:pemilik,idpemilik',
            'nama_pet' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'idras_hewan' => 'required|exists:ras_hewan,idras_hewan',
            'jenis_kelamin' => 'required|in:J,B',
            'warna_tanda' => 'nullable|string'
        ]);

        // Simpan ke database menggunakan Query Builder
        DB::table('pet')->insert([
            'idpemilik' => $request->idpemilik,
            'idras_hewan' => $request->idras_hewan,
            'nama' => $request->nama_pet,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'warna_tanda' => $request->warna_tanda,
        ]);

        return redirect()->route('resepsionis.registrasi.index_pet')
            ->with('success', 'Data Hewan Berhasil Didaftarkan!');
    }
    public function delete($id)
    {
        DB::table('pet')->where('idpet', $id)->delete();
        return redirect()->route('resepsionis.registrasi.index_pet')->with('success', 'Data Pet berhasil dihapus.');
    }

    // Method untuk AJAX menggunakan Query Builder
    public function getRasByJenis($id)
    {
        // Ambil ras hewan berdasarkan jenis_hewan_id
        $ras = DB::table('ras_hewan')
                ->where('idjenis_hewan', $id)
                ->get();
        
        return response()->json($ras);
    }
}