<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kategori;
use Illuminate\Validation\Rule;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::all();
        return view('admin.kategori.index', compact('kategori'));
    }
    public function create()
    {
        return view('admin.kategori.create');
    }
   public function store(Request $request)
    {
        // 1. Validasi data langsung menggunakan request
        $validateData = $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        // 2. Simpan data ke database menggunakan Model
        Kategori::create($validateData);
        
        return redirect()->route('admin.kategori.index')
                    ->with('success', 'Jenis Hewan berhasil ditambahkan.');
    }
    protected function validateKategori(Request $request, $id = null)
    {
        // Gunakan primary key dari model Kategori
        $primaryKey = (new Kategori)->getKeyName(); // 'idkategori'
        
        $uniqueRule = Rule::unique('kategori', 'nama_kategori');
        if ($id) {
            $uniqueRule->ignore($id, $primaryKey);
        }

        return $request->validate([
            'nama_kategori' => [
                'required',
                'string',
                'max:255',
                'min:3',
                $uniqueRule
            ],
        ], [
            'nama_kategori.required' => 'Nama kategori wajib diisi.',
            'nama_kategori.string' => 'Nama kategori harus berupa teks.',
            'nama_kategori.max' => 'Nama kategori maksimal 255 karakter.',
            'nama_kategori.min' => 'Nama kategori minimal 3 karakter.',
            'nama_kategori.unique' => 'Nama kategori sudah ada.',
        ]);
    }

    /**
     * Helper untuk membuat data baru
     */
    protected function createKategori(array $data)
    {
        try {
            return Kategori::create([
                'nama_kategori' => $this->formatNama($data['nama_kategori']),
            ]);
        } catch (\Exception $e) {
            throw new \Exception('Gagal menyimpan data kategori: ' . $e->getMessage());
        }
    }
}

