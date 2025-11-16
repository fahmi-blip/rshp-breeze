<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use Exception; // Tambahkan ini

class RoleController extends Controller
{
    public function index()
    {
        $role = Role::all();
        return view('admin.role.index', compact('role'));
    }

    // 1. Method untuk menampilkan form create
    public function create()
    {
        return view('admin.role.create');
    }

    // 2. Method untuk menyimpan data [cite: 1661-1668]
    public function store(Request $request)
    {
        try {
            $validatedData = $this->validateRole($request);
            $this->createRole($validatedData);

            return redirect()->route('admin.role.index')
                ->with('success', 'Data Role berhasil ditambahkan.');
        } catch (Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    // 3. Helper Validasi [cite: 1683-1701]
    protected function validateRole(Request $request, $id = null)
    {
        $uniqueRule = $id ? 'unique:role,nama_role,' . $id . ',idrole' : 'unique:role,nama_role';

        $rules = [
            'nama_role' => ['required', 'string', 'max:255', 'min:3', $uniqueRule],
        ];

        $messages = [
            'nama_role.required' => 'Nama role wajib diisi.',
            'nama_role.min' => 'Nama role minimal 3 karakter.',
            'nama_role.unique' => 'Nama role sudah ada.',
        ];

        return $request->validate($rules, $messages);
    }

    // 4. Helper Create Data [cite: 1707-1716]
    protected function createRole(array $data)
    {
        try {
            return Role::create([
                'nama_role' => $this->formatNama($data['nama_role']), // Menggunakan helper format [cite: 1712]
            ]);
        } catch (Exception $e) {
            throw new Exception('Gagal menyimpan data role: ' . $e->getMessage());
        }
    }

    // 5. Helper Format Nama [cite: 1717-1721]
    protected function formatNama($nama)
    {
        return trim(ucwords(strtolower($nama)));
    }
}