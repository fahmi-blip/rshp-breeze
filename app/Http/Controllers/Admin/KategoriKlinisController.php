<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KategoriKlinis;
use Illuminate\Validation\Rule;

class KategoriKlinisController extends Controller
{
    public function index()
    {
        $kategoriKlinis = KategoriKlinis::all();
        return view('admin.kategori-klinis.index', compact('kategoriKlinis'));
    }
    public function create()
    {
        return view('admin.kategori-klinis.create');
    }
   public function store(Request $request)
    {
        // 1. Validasi data langsung menggunakan request
        $validateData = $request->validate([
            'nama_kategori_klinis' => 'required|string|max:255',
        ]);

        // 2. Simpan data ke database menggunakan Model
        KategoriKlinis::create($validateData);
        
        return redirect()->route('admin.kategori-klinis.index')
                    ->with('success', 'Jenis Hewan berhasil ditambahkan.');
    }
    protected function validateKategoriKlinis(Request $request, $id = null)
    {
        // Gunakan primary key dari model KategoriKlinis
        $primaryKey = (new KategoriKlinis)->getKeyName(); // 'idkategori_klinis'

        $uniqueRule = Rule::unique('kategori_klinis', 'nama_kategori_klinis');
        if ($id) {
            $uniqueRule->ignore($id, $primaryKey);
        }

        return $request->validate([
            'nama_kategori_klinis' => [
                'required',
                'string',
                'max:255',
                'min:3',
                $uniqueRule
            ],
        ], [
            'nama_kategori_klinis.required' => 'Nama kategori klinis wajib diisi.',
            'nama_kategori_klinis.string' => 'Nama kategori klinis harus berupa teks.',
            'nama_kategori_klinis.max' => 'Nama kategori klinis maksimal 255 karakter.',
            'nama_kategori_klinis.min' => 'Nama kategori klinis minimal 3 karakter.',
            'nama_kategori_klinis.unique' => 'Nama kategori klinis sudah ada.',
        ]);
    }

    /**
     * Helper untuk membuat data baru
     */
    protected function createKategoriKlinis(array $data)
    {
        try {
            return KategoriKlinis::create([
                'nama_kategori_klinis' => $this->formatNama($data['nama_kategori_klinis']),
            ]);
        } catch (\Exception $e) {
            throw new \Exception('Gagal menyimpan data kategori klinis: ' . $e->getMessage());
        }
    }

    /**
     * Helper untuk format nama menjadi Title Case
     */
    protected function formatNama($nama)
    {
        return trim(ucwords(strtolower($nama)));
    }
}
