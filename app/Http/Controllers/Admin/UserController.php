<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash; // Tambahkan ini
use Exception; // Tambahkan ini
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $user = DB::table('user')->orderBy('iduser', 'asc')->get();
        return view('admin.user.index', compact('user'));
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:user,email',
            'password' => 'required|min:8',
        ]);

        DB::table('user')->insert([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.user.index')->with('success', 'User berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $user = DB::table('user')->where('iduser', $id)->first();
        return view('admin.user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('user')->ignore($id, 'iduser')],
            'password' => 'nullable|min:8',
        ]);

        $data = [
            'nama' => $request->nama,
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        DB::table('user')->where('iduser', $id)->update($data);

        return redirect()->route('admin.user.index')->with('success', 'User berhasil diperbarui.');
    }

    // 3. Helper Validasi [cite: 1683-1701]
    protected function validateUser(Request $request, $id = null)
    {
        $uniqueRule = $id ? 'unique:user,email,' . $id . ',iduser' : 'unique:user,email';

        $rules = [
            'nama' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', $uniqueRule],
            'password' => 'required|string|min:8',
        ];

        $messages = [
            'nama.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
        ];

        return $request->validate($rules, $messages);
    }

    // 4. Helper Create Data [cite: 1707-1716]
    protected function createUser(array $data)
    {
        try {
            return User::create([
                'nama' => $data['nama'],
                'email' =>$data['email'],
                'password' => Hash::make($data['password']),
            ]);
        } catch (Exception $e) {
            throw new Exception('Gagal menyimpan data user: ' . $e->getMessage());
        }
    }
}