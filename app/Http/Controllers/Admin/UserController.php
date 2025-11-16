<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash; // Tambahkan ini
use Exception; // Tambahkan ini

class UserController extends Controller
{
    public function index()
    {
        $user = User::all();
        return view('admin.user.index', compact('user'));
    }

    // 1. Method untuk menampilkan form create
    public function create()
    {
        return view('admin.user.create');
    }

    // 2. Method untuk menyimpan data [cite: 1661-1668]
    public function store(Request $request)
    {
        try {
            $validatedData = $this->validateUser($request);
            $this->createUser($validatedData);

            return redirect()->route('admin.user.index')
                ->with('success', 'Data User berhasil ditambahkan.');
        } catch (Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
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