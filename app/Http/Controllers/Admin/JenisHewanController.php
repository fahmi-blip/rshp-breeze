<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JenisHewan;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;


class JenisHewanController extends Controller
{
    public function index()
    {
        // $jenisHewan = JenisHewan::all();
        $jenisHewan = Db::table('jenis_hewan')
        ->select('idjenis_hewan', 'nama_jenis_hewan')
        ->get();

        return view('admin.jenis-hewan.index', compact('jenisHewan'));
    }
    public function create()
    {
        return view('admin.jenis-hewan.create');
    }
   public function store(Request $request)
    {
        // 1. Validasi data langsung menggunakan request
        $validateData = $request->validate([
            'nama_jenis_hewan' => 'required|string|max:255',
        ]);

        // 2. Simpan data ke database menggunakan Model
        JenisHewan::create($validateData);
        
        return redirect()->route('admin.jenis-hewan.index')
                    ->with('success', 'Jenis Hewan berhasil ditambahkan.');
    }
    public function edit($id)
    {
        $jenisHewan = DB::table('jenis_hewan')->where('idjenis_hewan', $id)->first();
        return view('admin.jenis-hewan.edit', compact('jenisHewan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_jenis_hewan' => ['required', 'string', 'max:255', Rule::unique('jenis_hewan')->ignore($id, 'idjenis_hewan')],
        ]);

        DB::table('jenis_hewan')->where('idjenis_hewan', $id)->update([
            'nama_jenis_hewan' => $this->formatNamaJenisHewan($request->nama_jenis_hewan),
        ]);

        return redirect()->route('admin.jenis-hewan.index')->with('success', 'Jenis Hewan berhasil diperbarui.');
    }

    public function delete($id)
    {
        DB::table('jenis_hewan')->where('idjenis_hewan', $id)->delete();
        return redirect()->route('admin.jenis-hewan.index')->with('success', 'Jenis Hewan berhasil dihapus.');
    }
    protected function validateJenisHewan(Request $request, $id = null)
    {
        $uniqueRule = Rule::unique('jenis_hewan', 'nama_jenis_hewan');
        if ($id) {
            $uniqueRule->ignore($id, 'idjenis_hewan');
        }

        return $request->validate([
            'nama_jenis_hewan' => [
                'required',
                'string',
                'max:255',
                'min:3',
                $uniqueRule
            ],
        ], [
            'nama_jenis_hewan.required' => 'Nama jenis hewan wajib diisi.',
            'nama_jenis_hewan.string' => 'Nama jenis hewan harus berupa teks.',
            'nama_jenis_hewan.max' => 'Nama jenis hewan maksimal 255 karakter.',
            'nama_jenis_hewan.min' => 'Nama jenis hewan minimal 3 karakter.',
            'nama_jenis_hewan.unique' => 'Nama jenis hewan sudah ada.',
        ]);
    }
    protected function createJenisHewan(array $data)
    {
        try {
            $jenisHewan = DB::table('jenis_hewan')->insert([
                'nama_jenis_hewan' => $this->formatNamaJenisHewan($data['nama_jenis_hewan']),  
        ]);
        return $jenisHewan;
        } catch (\Exception $e) {
            throw new \Exception('Gagal menyimpan data jenis hewan: ' . $e->getMessage());
        }
    }

    // Helper untuk format nama menjadi Title Case
     
    protected function formatNamaJenisHewan($nama)
    {
        return trim(ucwords(strtolower($nama)));
    }
}
