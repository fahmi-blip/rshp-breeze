<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pet;
use App\Models\Pemilik;
use App\Models\RasHewan;
use Exception; 
use Illuminate\Support\Facades\Auth;

class PetController extends Controller
{
    public function index()
    {
        $pet = Pet::with('pemilik.user', 'rasHewan.jenisHewan')->get();
        return view('admin.pet.index', compact('pet'));
    }

    /**
     * Menampilkan form create pet
     */
    public function create()
    {
        $pemilik = Pemilik::with('user')->get();
        $rasHewan = RasHewan::with('jenisHewan')->get();
        return view('admin.pet.create', compact('pemilik', 'rasHewan'));
    }

    /**
     * Menyimpan data pet baru
     */
    public function store(Request $request)
    {
        try {
            // 1. Validasi menggunakan helper
            $validatedData = $this->validatePet($request);
            
            // 2. Simpan menggunakan helper
            $this->createPet($validatedData);

            return redirect()->route('admin.pet.index')
                ->with('success', 'Data Pet berhasil ditambahkan.');
        } catch (Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menyimpan data: ' . $e->getMessage())
                ->withInput();
        }
    }

    protected function validatePet(Request $request, $id = null)
    {
        $rules = [
            'nama' => [
                'required',
                'string',
                'min:2',
                'max:255'
            ],
            'tanggal_lahir' => [
                'required',
                'date',
                'before_or_equal:today'
            ],
            'warna_tanda' => [
                'required',
                'string',
                'max:255'
            ],
            'jenis_kelamin' => [
                'required',
                'in:J,B' // J untuk Jantan, B untuk Betina
            ],
            'idpemilik' => [
                'required',
                'exists:pemilik,idpemilik'
            ],
            'idras_hewan' => [
                'required',
                'exists:ras_hewan,idras_hewan'
            ],
        ];

        $messages = [
            'nama.required' => 'Nama pet wajib diisi.',
            'nama.min' => 'Nama pet minimal 2 karakter.',
            'nama.max' => 'Nama pet maksimal 255 karakter.',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
            'tanggal_lahir.date' => 'Format tanggal tidak valid.',
            'tanggal_lahir.before_or_equal' => 'Tanggal lahir tidak boleh melebihi hari ini.',
            'warna_tanda.required' => 'Warna/tanda wajib diisi.',
            'warna_tanda.max' => 'Warna/tanda maksimal 255 karakter.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
            'jenis_kelamin.in' => 'Jenis kelamin harus Jantan (J) atau Betina (B).',
            'idpemilik.required' => 'Pemilik wajib dipilih.',
            'idpemilik.exists' => 'Pemilik yang dipilih tidak valid.',
            'idras_hewan.required' => 'Ras hewan wajib dipilih.',
            'idras_hewan.exists' => 'Ras hewan yang dipilih tidak valid.',
        ];

        return $request->validate($rules, $messages);
    }

    protected function createPet(array $data)
    {
        try {
            return Pet::create([
                'nama' => $this->formatNama($data['nama']),
                'tanggal_lahir' => $data['tanggal_lahir'],
                'warna_tanda' => trim($data['warna_tanda']),
                'jenis_kelamin' => $data['jenis_kelamin'], // 'J' atau 'B'
                'idpemilik' => $data['idpemilik'],
                'idras_hewan' => $data['idras_hewan'],
            ]);
        } catch (Exception $e) {
            throw new Exception('Gagal menyimpan data pet: ' . $e->getMessage());
        }
    }

    protected function formatNama($nama)
    {
        return trim(ucwords(strtolower($nama)));
    }
}