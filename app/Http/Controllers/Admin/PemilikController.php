<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pemilik;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Exception;

class PemilikController extends Controller
{
    /**
     * Menampilkan daftar pemilik
     */
    public function index()
    {
        $pemilik = DB::table('pemilik')
            ->join('user','pemilik.iduser','=','user.iduser')
            ->select('pemilik.*','user.nama','user.email')
            ->get();
        return view('admin.pemilik.index', compact('pemilik'));
    }
    public function create()
    {
        $existingIds = DB::table('pemilik')->pluck('iduser');
        $users = DB::table('user')->whereNotIn('iduser', $existingIds)->get();
        
        return view('admin.pemilik.create', compact('users'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'iduser' => 'required|exists:user,iduser|unique:pemilik,iduser',
            'no_wa' => 'required|string|max:20|unique:pemilik,no_wa',
            'alamat' => 'required|string',
        ]);

        DB::table('pemilik')->insert([
            'iduser' => $request->iduser,
            'no_wa' => $request->no_wa,
            'alamat' => ucfirst($request->alamat),
        ]);

        return redirect()->route('admin.pemilik.index')->with('success', 'Pemilik berhasil ditambahkan.');
    }
    public function edit($id)
{
    // jika model primary key bernama idpemilik, pakai findOrFail dengan primaryKey di model
    $pemilik = Pemilik::find($id);
    if (!$pemilik) {
        return redirect()->route('admin.pemilik.index')->with('error', 'Pemilik tidak ditemukan.');
    }
    $users = User::all();
    return view('admin.pemilik.edit', compact('pemilik','users'));
}


    public function update(Request $request, $id)
    {
        $request->validate([
            'iduser' => ['required', 'exists:user,iduser', Rule::unique('pemilik')->ignore($id, 'idpemilik')],
            'no_wa' => ['required', 'string', 'max:20', Rule::unique('pemilik')->ignore($id, 'idpemilik')],
            'alamat' => 'required|string',
        ]);

        DB::table('pemilik')->where('idpemilik', $id)->update([
            'iduser' => $request->iduser,
            'no_wa' => $request->no_wa,
            'alamat' => ucfirst($request->alamat),
        ]);

        return redirect()->route('admin.pemilik.index')->with('success', 'Data pemilik berhasil diperbarui.');
    }

    public function delete($id)
    {
        DB::table('pemilik')->where('idpemilik', $id)->delete();
        return redirect()->route('admin.pemilik.index')->with('success', 'Data pemilik berhasil dihapus.');
    }
    
    
    protected function validatePemilik(Request $request, $id = null)
    {
        $primaryKey = (new Pemilik)->getKeyName(); 
        
        $uniqueIdUserRule = Rule::unique('pemilik', 'iduser');
        
        $uniqueNoWaRule = Rule::unique('pemilik', 'no_wa');

        if ($id) {
            $uniqueIdUserRule->ignore($id, $primaryKey);
            $uniqueNoWaRule->ignore($id, $primaryKey);
        }

        return $request->validate([
            'iduser' => [
                'required',
                'integer',
                'exists:user,iduser',  
                $uniqueIdUserRule
            ],
            'no_wa' => [
                'required',
                'string',
                'min:10',
                'max:20',
                'regex:/^[0-9]+$/',  
                $uniqueNoWaRule
            ],
            'alamat' => [
                'required',
                'string',
                'min:5',
                'max:500'
            ],
        ], [
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

    
     
    protected function formatAlamat($alamat)
    {
        // Capitalize first letter of each sentence
        return trim(ucfirst($alamat));
    }
}