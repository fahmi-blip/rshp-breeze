<?php

namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use App\Models\Pet;
use App\Models\User;

class TemuDokterController extends Controller
{
    public function index()
    {
        $pets = Pet::with('pemilik')->get();
        
        $dokters = User::whereHas('roles', function($q){
            $q->where('name', 'Dokter');
        })->get();

        return view('resepsionis.registrasi.temu-dokter', compact('pets', 'dokters'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pet_id' => 'required',
            'dokter_id' => 'required',
            'keluhan' => 'required|string',
        ]);

        Pendaftaran::create([
            'pet_id' => $request->pet_id,
            'dokter_id' => $request->dokter_id,
            'keluhan' => $request->keluhan,
            'status' => 'menunggu_perawat', // Status awal
        ]);

        return redirect()->back()->with('success', 'Pendaftaran berhasil! Pasien masuk antrian perawat.');
    }
}