<?php

namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Pemilik;
use App\Models\RoleUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PemilikController extends Controller
{
    public function index()
    {
        return view('resepsionis.registrasi.pemilik');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:user,email',
            'password' => 'required|min:8',
            'no_wa' => 'required|string|max:20|unique:pemilik,no_wa',
            'alamat' => 'required|string|min:5',
        ]);

        DB::beginTransaction();

        try {

            // 1 — Buat user
            $user = User::create([
                'nama' => $request->nama,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            // 2 — Assign role "pemilik"
            // Pastikan ID-ROLE sesuai di tabel role
            RoleUser::create([
                'iduser' => $user->iduser,
                'idrole' => 5, // misalnya role pemilik = ID 3
                'status' => 1,
            ]);

            // 3 — Buat data pemilik
            Pemilik::create([
                'iduser' => $user->iduser,
                'no_wa' => $request->no_wa,
                'alamat' => ucfirst($request->alamat),
            ]);

            DB::commit();

            return redirect()
                ->route('resepsionis.registrasi.pemilik')
                ->with('success', 'Pemilik berhasil ditambahkan.');

        } catch (\Exception $e) {

            DB::rollBack();
            return back()->withErrors([
                'error' => 'Gagal menambahkan pemilik: ' . $e->getMessage()
            ]);
        }
    }
}
