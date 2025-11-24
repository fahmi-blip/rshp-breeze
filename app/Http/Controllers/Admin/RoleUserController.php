<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RoleUser;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Exception; // Pastikan use Exception ada

class RoleUserController extends Controller
{
    public function index()
    {
        $roleUser = DB::table('role_user')
            ->join('user', 'role_user.iduser', '=', 'user.iduser')
            ->join('role', 'role_user.idrole', '=', 'role.idrole')
            ->select('role_user.*', 'user.nama as nama_user', 'user.email', 'role.nama_role')
            ->get();

        // Mapping object manual untuk kompabilitas view ($item->user->nama)
        foreach($roleUser as $ru) {
            $ru->user = (object)['nama' => $ru->nama_user, 'email' => $ru->email];
            $ru->role = (object)['nama_role' => $ru->nama_role];
        }

        return view('admin.role-user.index', compact('roleUser'));
    }

    public function create()
    {
        $role = DB::table('role')->get();
        // Ambil user yang belum punya role (optional logic, sesuai permintaan awal)
        $existingUserIds = DB::table('role_user')->pluck('iduser')->toArray();
        $user = DB::table('user')->whereNotIn('iduser', $existingUserIds)->get();

        return view('admin.role-user.create', compact('role', 'user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'iduser' => 'required|exists:user,iduser|unique:role_user,iduser',
            'idrole' => 'required|exists:role,idrole',
            'status' => 'required|in:1,0',
        ]);

        DB::table('role_user')->insert([
            'iduser' => $request->iduser,
            'idrole' => $request->idrole,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.role-user.index')->with('success', 'Role User berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $roleUser = DB::table('role_user')->where('idrole_user', $id)->first();
        $user = DB::table('user')->get(); // Saat edit, mungkin ingin ganti user juga
        $role = DB::table('role')->get();
        return view('admin.role-user.edit', compact('roleUser', 'user', 'role'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'iduser' => ['required', 'exists:user,iduser', Rule::unique('role_user')->ignore($id, 'idrole_user')],
            'idrole' => 'required|exists:role,idrole',
            'status' => 'required|in:1,0',
        ]);

        DB::table('role_user')->where('idrole_user', $id)->update([
            'iduser' => $request->iduser,
            'idrole' => $request->idrole,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.role-user.index')->with('success', 'Role User berhasil diperbarui.');
    }

    public function delete($id)
    {
        DB::table('role_user')->where('idrole_user', $id)->delete();
        return redirect()->route('admin.role-user.index')->with('success', 'Role User berhasil dihapus.');
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