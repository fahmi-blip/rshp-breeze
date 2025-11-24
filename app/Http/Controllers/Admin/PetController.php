<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pet;
use App\Models\Pemilik;
use App\Models\RasHewan;
use Exception; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PetController extends Controller
{
    public function index()
    {
        $pet = DB::table('pet')
            ->join('pemilik', 'pet.idpemilik', '=', 'pemilik.idpemilik')
            ->join('user', 'pemilik.iduser', '=', 'user.iduser') // Ambil nama pemilik dari tabel user
            ->join('ras_hewan', 'pet.idras_hewan', '=', 'ras_hewan.idras_hewan')
            ->join('jenis_hewan', 'ras_hewan.idjenis_hewan', '=', 'jenis_hewan.idjenis_hewan')
            ->select('pet.*', 'user.nama as nama_pemilik', 'ras_hewan.nama_ras', 'jenis_hewan.nama_jenis_hewan')
            ->orderBy('pet.idpet', 'asc')
            ->get();
        return view('admin.pet.index', compact('pet'));
    }

    public function create()
    {
        $pemilik = DB::table('pemilik')
            ->join('user', 'pemilik.iduser', '=', 'user.iduser')
            ->select('pemilik.idpemilik', 'user.nama')
            ->get();
            
        // Ubah struktur agar view create.blade.php tetap jalan ($item->user->nama)
        // Kita map agar cocok dengan view yang mengharapkan properti nested, 
        // ATAU (lebih baik) ubah view create untuk pakai $item->nama saja. 
        // Di sini saya kirim data flat, asumsikan view create pakai $item->nama.
        foreach($pemilik as $p) {
            $p->user = (object)['nama' => $p->nama];
        }

        $rasHewan = DB::table('ras_hewan')
            ->join('jenis_hewan', 'ras_hewan.idjenis_hewan', '=', 'jenis_hewan.idjenis_hewan')
            ->select('ras_hewan.idras_hewan', 'ras_hewan.nama_ras', 'jenis_hewan.nama_jenis_hewan')
            ->get();
            
        foreach($rasHewan as $r) {
            $r->jenisHewan = (object)['nama_jenis_hewan' => $r->nama_jenis_hewan];
        }

        return view('admin.pet.create', compact('pemilik', 'rasHewan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'idpemilik' => 'required|exists:pemilik,idpemilik',
            'idras_hewan' => 'required|exists:ras_hewan,idras_hewan',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:J,B,1,0',
            'warna_tanda' => 'required|string',
        ]);

        DB::table('pet')->insert([
            'nama' => $request->nama,
            'idpemilik' => $request->idpemilik,
            'idras_hewan' => $request->idras_hewan,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'warna_tanda' => $request->warna_tanda,
        ]);

        return redirect()->route('admin.pet.index')->with('success', 'Data Pet berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $pet = DB::table('pet')->where('idpet', $id)->first();
        
        $pemilik = DB::table('pemilik')
            ->join('user', 'pemilik.iduser', '=', 'user.iduser')
            ->select('pemilik.idpemilik', 'user.nama')
            ->get();
        foreach($pemilik as $p) { $p->user = (object)['nama' => $p->nama]; }

        $rasHewan = DB::table('ras_hewan')
            ->join('jenis_hewan', 'ras_hewan.idjenis_hewan', '=', 'jenis_hewan.idjenis_hewan')
            ->select('ras_hewan.idras_hewan', 'ras_hewan.nama_ras', 'jenis_hewan.nama_jenis_hewan')
            ->get();
        foreach($rasHewan as $r) { $r->jenisHewan = (object)['nama_jenis_hewan' => $r->nama_jenis_hewan]; }

        return view('admin.pet.edit', compact('pet', 'pemilik', 'rasHewan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'idpemilik' => 'required|exists:pemilik,idpemilik',
            'idras_hewan' => 'required|exists:ras_hewan,idras_hewan',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:J,B,1,0',
            'warna_tanda' => 'required|string',
        ]);

        DB::table('pet')->where('idpet', $id)->update([
            'nama' => $request->nama,
            'idpemilik' => $request->idpemilik,
            'idras_hewan' => $request->idras_hewan,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'warna_tanda' => $request->warna_tanda,
        ]);

        return redirect()->route('admin.pet.index')->with('success', 'Data Pet berhasil diperbarui.');
    }

    public function delete($id)
    {
        DB::table('pet')->where('idpet', $id)->delete();
        return redirect()->route('admin.pet.index')->with('success', 'Data Pet berhasil dihapus.');
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