<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pemilik;
use Illuminate\Validation\Rule;
use Exception;

class PemilikController extends Controller
{
    /**
     * Menampilkan daftar pemilik
     */
    public function index()
    {
        $pemilik = Pemilik::with('user')->get();
        return view('admin.pemilik.index', compact('pemilik'));
    }
    
    /**
     * Menampilkan form create pemilik
     */
    public function create()
    {   
        // Ambil users yang belum menjadi pemilik
        $users = User::whereDoesntHave('pemilik')->get();
        return view('admin.pemilik.create', compact('users'));
    }
    
    /**
     * Menyimpan data pemilik baru
     */
    public function store(Request $request)
    {
        try {
            // 1. Validasi data menggunakan helper
            $validatedData = $this->validatePemilik($request);
            
            // 2. Simpan data menggunakan helper
            $this->createPemilik($validatedData);
            
            return redirect()->route('admin.pemilik.index')
                        ->with('success', 'Data Pemilik berhasil ditambahkan.');
        } catch (Exception $e) {
            return redirect()->back()
                        ->with('error', 'Gagal menyimpan data: ' . $e->getMessage())
                        ->withInput();
        }
    }
    
    /**
     * Helper Validasi Pemilik
     * Sesuai Modul 11
     */
    protected function validatePemilik(Request $request, $id = null)
    {
        $primaryKey = (new Pemilik)->getKeyName(); // 'idpemilik'
        
        // Rule unique untuk iduser (1 user hanya bisa jadi 1 pemilik)
        $uniqueIdUserRule = Rule::unique('pemilik', 'iduser');
        
        // Rule unique untuk no_wa
        $uniqueNoWaRule = Rule::unique('pemilik', 'no_wa');

        if ($id) {
            $uniqueIdUserRule->ignore($id, $primaryKey);
            $uniqueNoWaRule->ignore($id, $primaryKey);
        }

        return $request->validate([
            'iduser' => [
                'required',
                'integer',
                'exists:user,iduser',  // Sesuaikan dengan nama tabel
                $uniqueIdUserRule
            ],
            'no_wa' => [
                'required',
                'string',
                'min:10',
                'max:20',
                'regex:/^[0-9]+$/',  // Hanya angka
                $uniqueNoWaRule
            ],
            'alamat' => [
                'required',
                'string',
                'min:5',
                'max:500'
            ],
        ], [
            // Custom messages
            'iduser.required' => 'User pemilik wajib dipilih.',
            'iduser.exists' => 'User yang dipilih tidak valid.',
            'iduser.unique' => 'User ini sudah terdaftar sebagai pemilik.',
            'no_wa.required' => 'Nomor WA wajib diisi.',
            'no_wa.min' => 'Nomor WA minimal 10 karakter.',
            'no_wa.max' => 'Nomor WA maksimal 20 karakter.',
            'no_wa.regex' => 'Nomor WA hanya boleh berisi angka.',
            'no_wa.unique' => 'Nomor WA ini sudah terdaftar.',
            'alamat.required' => 'Alamat wajib diisi.',
            'alamat.min' => 'Alamat minimal 5 karakter.',
            'alamat.max' => 'Alamat maksimal 500 karakter.',
        ]);
    }

    /**
     * Helper untuk membuat data pemilik baru
     * Sesuai Modul 11
     */
    protected function createPemilik(array $data)
    {
        try {
            return Pemilik::create([
                'iduser' => $data['iduser'],
                'no_wa' => trim($data['no_wa']),
                'alamat' => $this->formatAlamat($data['alamat']),
            ]);
        } catch (Exception $e) {
            throw new Exception('Gagal menyimpan data pemilik: ' . $e->getMessage());
        }
    }

    /**
     * Helper untuk format alamat
     * Sesuai Modul 11
     */
    protected function formatAlamat($alamat)
    {
        // Capitalize first letter of each sentence
        return trim(ucfirst($alamat));
    }
}