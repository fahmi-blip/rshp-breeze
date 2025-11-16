<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TindakanTerapi;
use App\Models\Kategori;
use App\Models\KategoriKlinis;
use Exception; // Tambahkan ini

class TindakanTerapiController extends Controller
{
    public function index()
    {
        $tindakanTerapi = TindakanTerapi::with('kategori', 'kategoriKlinis')->get();
        return view('admin.tindakan-terapi.index', compact('tindakanTerapi'));
    }

    // 1. Method untuk menampilkan form create
    public function create()
    {
        $kategori = Kategori::all();
        $kategoriKlinis = KategoriKlinis::all();
        return view('admin.tindakan-terapi.create', compact('kategori', 'kategoriKlinis'));
    }

    // 2. Method untuk menyimpan data [cite: 1661-1668]
    public function store(Request $request)
    {
        try {
            $validatedData = $this->validateTindakanTerapi($request);
            $this->createTindakanTerapi($validatedData);

            return redirect()->route('admin.tindakan-terapi.index')
                ->with('success', 'Data Tindakan & Terapi berhasil ditambahkan.');
        } catch (Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    // 3. Helper Validasi [cite: 1683-1701]
    protected function validateTindakanTerapi(Request $request, $id = null)
    {
        $uniqueRule = $id ? 'unique:kode_tindakan_terapi,kode,' . $id . ',idtindakan' : 'unique:kode_tindakan_terapi,kode';

        $rules = [
            'kode' => ['required', 'string', 'max:50', $uniqueRule],
            'deskripsi_tindakan_terapi' => 'required|string',
            'idkategori' => 'required|exists:kategori,idkategori',
            'idkategori_klinis' => 'required|exists:kategori_klinis,idkategori_klinis',
        ];

        $messages = [
            'kode.required' => 'Kode wajib diisi.',
            'kode.unique' => 'Kode sudah digunakan.',
            'idkategori.required' => 'Kategori wajib dipilih.',
            'idkategori_klinis.required' => 'Kategori Klinis wajib dipilih.',
        ];

        return $request->validate($rules, $messages);
    }

    // 4. Helper Create Data [cite: 1707-1716]
    protected function createTindakanTerapi(array $data)
    {
        try {
            return TindakanTerapi::create([
                'kode' => $data['kode'],
                'deskripsi_tindakan_terapi' => $data['deskripsi_tindakan_terapi'],
                'idkategori' => $data['idkategori'],
                'idkategori_klinis' => $data['idkategori_klinis'],
            ]);
        } catch (Exception $e) {
            throw new Exception('Gagal menyimpan data pet: ' . $e->getMessage());
        }
    }
}