<?php

namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TemuDokterController extends Controller
{
    public function index()
    {
        return view('resepsionis.registrasi.temu-dokter');
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
   

        return view('resepsionis.registrasi.create_temu', compact('pemilik', 'jenisHewan'));
    }
}
