<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RasHewan;
use App\Models\JenisHewan;
use Illuminate\Support\Facades\DB;
use Exception; // Tambahkan ini

class RasHewanController extends Controller
{
    public function index()
    {
        $rasHewan = DB::table('ras_hewan')
            ->join('jenis_hewan', 'ras_hewan.idjenis_hewan', '=', 'jenis_hewan.idjenis_hewan')
            ->select('ras_hewan.*', 'jenis_hewan.nama_jenis_hewan')
            ->orderBy('ras_hewan.idras_hewan', 'asc')
            ->get();

        return view('admin.ras-hewan.index', compact('rasHewan'));
    }

    // 1. Method untuk menampilkan form create
    public function create()
    {
        $jenisHewan = JenisHewan::all();
        return view('admin.ras-hewan.create', compact('jenisHewan'));
    }

    // 2. Method untuk menyimpan data [cite: 1661-1668]
    public function store(Request $request)
    {
        $request->validate([
            'nama_ras' => 'required|string|max:255',
            'idjenis_hewan' => 'required|exists:jenis_hewan,idjenis_hewan',
        ]);

        DB::table('ras_hewan')->insert([
            'nama_ras' => $this->formatNama($request->nama_ras),
            'idjenis_hewan' => $request->idjenis_hewan,
        ]);

        return redirect()->route('admin.ras-hewan.index')->with('success', 'Ras Hewan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $rasHewan = DB::table('ras_hewan')->where('idras_hewan', $id)->first();
        $jenisHewan = DB::table('jenis_hewan')->get();
        return view('admin.ras-hewan.edit', compact('rasHewan', 'jenisHewan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_ras' => 'required|string|max:255',
            'idjenis_hewan' => 'required|exists:jenis_hewan,idjenis_hewan',
        ]);

        DB::table('ras_hewan')->where('idras_hewan', $id)->update([
            'nama_ras' => $this->formatNama($request->nama_ras),
            'idjenis_hewan' => $request->idjenis_hewan,
        ]);

        return redirect()->route('admin.ras-hewan.index')->with('success', 'Ras Hewan berhasil diperbarui.');
    }

    public function delete($id)
    {
        DB::table('ras_hewan')->where('idras_hewan', $id)->delete();
        return redirect()->route('admin.ras-hewan.index')->with('success', 'Ras Hewan berhasil dihapus.');
    }

    // 3. Helper Validasi [cite: 1683-1701]
    protected function validateRasHewan(Request $request, $id = null)
    {
        $uniqueRule = $id ? 'unique:ras_hewan,nama_ras,' . $id . ',idras' : 'unique:ras_hewan,nama_ras';

        $rules = [
            'nama_ras' => ['required', 'string', 'max:255', 'min:3', $uniqueRule],
            'idjenis_hewan' => 'required|exists:jenis_hewan,idjenis_hewan',
        ];

        $messages = [
            'nama_ras.required' => 'Nama ras wajib diisi.',
            'nama_ras.min' => 'Nama ras minimal 3 karakter.',
            'nama_ras.unique' => 'Nama ras hewan sudah ada.',
            'idjenis_hewan.required' => 'Jenis hewan wajib dipilih.',
        ];

        return $request->validate($rules, $messages);
    }

    // 4. Helper Create Data [cite: 1707-1716]
    protected function createRasHewan(array $data)
    {
        try {
            return RasHewan::create([
                'nama_ras' => $this->formatNama($data['nama_ras']), // Menggunakan helper format [cite: 1712]
                'idjenis_hewan' => $data['idjenis_hewan'],
            ]);
        } catch (Exception $e) {
            throw new Exception('Gagal menyimpan data ras hewan: ' . $e->getMessage());
        }
    }

    // 5. Helper Format Nama (seperti di Modul 11) [cite: 1717-1721]
    protected function formatNama($nama)
    {
        return trim(ucwords(strtolower($nama)));
    }
}