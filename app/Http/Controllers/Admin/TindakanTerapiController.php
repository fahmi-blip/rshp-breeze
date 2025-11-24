<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Models\TindakanTerapi;
use App\Models\Kategori;
use App\Models\KategoriKlinis;
use Exception; // Tambahkan ini

class TindakanTerapiController extends Controller
{
    public function index()
    {
        $tindakanTerapi = DB::table('kode_tindakan_terapi')
            ->join('kategori', 'kode_tindakan_terapi.idkategori', '=', 'kategori.idkategori')
            ->join('kategori_klinis', 'kode_tindakan_terapi.idkategori_klinis', '=', 'kategori_klinis.idkategori_klinis')
            ->select('kode_tindakan_terapi.*', 'kategori.nama_kategori', 'kategori_klinis.nama_kategori_klinis')
            ->get();

        // Mapping object agar view tidak error saat akses properti relasi
        foreach($tindakanTerapi as $t) {
            $t->kategori = (object)['nama_kategori' => $t->nama_kategori];
            $t->kategoriKlinis = (object)['nama_kategori_klinis' => $t->nama_kategori_klinis];
        }

        return view('admin.tindakan-terapi.index', compact('tindakanTerapi'));
    }

    public function create()
    {
        $kategori = DB::table('kategori')->get();
        $kategoriKlinis = DB::table('kategori_klinis')->get();
        return view('admin.tindakan-terapi.create', compact('kategori', 'kategoriKlinis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|string|unique:kode_tindakan_terapi,kode',
            'deskripsi_tindakan_terapi' => 'required|string',
            'idkategori' => 'required|exists:kategori,idkategori',
            'idkategori_klinis' => 'required|exists:kategori_klinis,idkategori_klinis',
        ]);

        DB::table('kode_tindakan_terapi')->insert([
            'kode' => $request->kode,
            'deskripsi_tindakan_terapi' => $request->deskripsi_tindakan_terapi,
            'idkategori' => $request->idkategori,
            'idkategori_klinis' => $request->idkategori_klinis,
        ]);

        return redirect()->route('admin.tindakan-terapi.index')->with('success', 'Tindakan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $tindakanTerapi = DB::table('kode_tindakan_terapi')->where('idkode_tindakan_terapi', $id)->first();
        $kategori = DB::table('kategori')->get();
        $kategoriKlinis = DB::table('kategori_klinis')->get();
        return view('admin.tindakan-terapi.edit', compact('tindakanTerapi', 'kategori', 'kategoriKlinis'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode' => ['required', Rule::unique('kode_tindakan_terapi')->ignore($id, 'idkode_tindakan_terapi')],
            'deskripsi_tindakan_terapi' => 'required|string',
            'idkategori' => 'required|exists:kategori,idkategori',
            'idkategori_klinis' => 'required|exists:kategori_klinis,idkategori_klinis',
        ]);

        DB::table('kode_tindakan_terapi')->where('idkode_tindakan_terapi', $id)->update([
            'kode' => $request->kode,
            'deskripsi_tindakan_terapi' => $request->deskripsi_tindakan_terapi,
            'idkategori' => $request->idkategori,
            'idkategori_klinis' => $request->idkategori_klinis,
        ]);

        return redirect()->route('admin.tindakan-terapi.index')->with('success', 'Tindakan berhasil diperbarui.');
    }

    public function delete($id)
    {
        DB::table('kode_tindakan_terapi')->where('idkode_tindakan_terapi', $id)->delete();
        return redirect()->route('admin.tindakan-terapi.index')->with('success', 'Tindakan berhasil dihapus.');
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