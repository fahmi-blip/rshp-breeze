<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use Exception; // Tambahkan ini
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class RoleController extends Controller
{
    public function index()
    {
        $role = DB::table('role')->orderBy('idrole', 'asc')->get();
        return view('admin.role.index', compact('role'));
    }

    public function create()
    {
        return view('admin.role.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_role' => 'required|string|max:255|unique:role,nama_role',
        ]);

        DB::table('role')->insert([
            'nama_role' => $this->formatNama($request->nama_role),
        ]);

        return redirect()->route('admin.role.index')->with('success', 'Role berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $role = DB::table('role')->where('idrole', $id)->first();
        return view('admin.role.edit', compact('role'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_role' => ['required', 'string', 'max:255', Rule::unique('role')->ignore($id, 'idrole')],
        ]);

        DB::table('role')->where('idrole', $id)->update([
            'nama_role' => $this->formatNama($request->nama_role),
        ]);

        return redirect()->route('admin.role.index')->with('success', 'Role berhasil diperbarui.');
    }

    public function delete($id)
    {
        DB::table('role')->where('idrole', $id)->delete();
        return redirect()->route('admin.role.index')->with('success', 'Role berhasil dihapus.');
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