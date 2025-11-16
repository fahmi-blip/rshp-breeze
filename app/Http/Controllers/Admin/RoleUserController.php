<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RoleUser;
use App\Models\Role;
use App\Models\User;
use Exception; // Pastikan use Exception ada

class RoleUserController extends Controller
{
    public function index()
    {
        $roleUser = RoleUser::with('role', 'user')->get();
        return view('admin.role-user.index', compact('roleUser'));
    }

    /**
     * TAMPILKAN FORM CREATE
     * (DIUBAH: Hanya mengambil user yang BELUM memiliki role)
     */
    public function create()
    {
        $role = Role::all();

        // 1. Ambil semua ID user yang SUDAH terdaftar di tabel role_user
        $existingUserIds = RoleUser::pluck('iduser')->all();

        // 2. Ambil user yang ID-nya TIDAK ADA di daftar $existingUserIds
        $user = User::whereNotIn('iduser', $existingUserIds)->get();

        return view('admin.role-user.create', compact('role', 'user'));
    }

    /**
     * SIMPAN DATA BARU
     * (DIUBAH: Menambahkan ->withInput() pada catch block)
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $this->validateRoleUser($request);
            $this->createRoleUser($validatedData);

            return redirect()->route('admin.role-user.index')
                ->with('success', 'Data Role User berhasil ditambahkan.');
        } catch (Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menyimpan data: ' . $e->getMessage())
                ->withInput(); // <-- Tambahan penting
        }
    }


    protected function validateRoleUser(Request $request, $id = null)
    {
        $uniqueRule = $id ? 'unique:role_user,iduser,' . $id . ',idrole_user' : 'unique:role_user,iduser';

        $rules = [
            'iduser' => ['required', 'exists:user,iduser', $uniqueRule],
            'idrole' => 'required|exists:role,idrole',
            'status' => 'required','in:1,0'
        ];

        $messages = [
            'iduser.required' => 'User wajib dipilih.',
            'iduser.unique' => 'User ini sudah memiliki role.',
            'idrole.required' => 'Role wajib dipilih.',
        ];

        return $request->validate($rules, $messages);
    }

    protected function createRoleUser(array $data)
    {
        try {
            return RoleUser::create([
                'iduser' => $data['iduser'],
                'idrole' => $data['idrole'],
                'status' => $data['status'],
            ]);
        } catch (Exception $e) {
            throw new Exception('Gagal menyimpan data pet: ' . $e->getMessage());
        }
    }
}