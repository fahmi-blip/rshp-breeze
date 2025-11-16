<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RasHewan;
use App\Models\JenisHewan;
use Exception; // Tambahkan ini

class RasHewanController extends Controller
{
    public function index()
    {
        $rasHewan = RasHewan::with('jenisHewan')->get();
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
        try {
            $validatedData = $this->validateRasHewan($request);
            $this->createRasHewan($validatedData);

            return redirect()->route('admin.ras-hewan.index')
                ->with('success', 'Data Ras Hewan berhasil ditambahkan.');
        } catch (Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
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