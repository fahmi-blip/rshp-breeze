<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        
        // Ambil role user dari tabel role_user
        $userRole = DB::table('role_user')
            ->join('role', 'role_user.idrole', '=', 'role.idrole')
            ->where('role_user.iduser', $user->iduser)
            ->where('role_user.status', 1) // hanya role yang aktif
            ->first();

        if (!$userRole) {
            Auth::logout();
            return redirect()->route('login')->with('error', 'Anda tidak memiliki role yang valid.');
        }

        // Simpan role ke session
        session(['user_role_name' => $userRole->nama_role]);
        session(['user_role_id' => $userRole->idrole]);

        // Mapping role dari database ke role yang dibutuhkan
        $roleMapping = [
            'administrator' => 'admin',
            'admin' => 'admin',
            'dokter' => 'dokter',
            'perawat' => 'perawat',
            'resepsionis' => 'resepsionis'
        ];
        
        $dbRoleName = strtolower($userRole->nama_role);
        $mappedRole = $roleMapping[$dbRoleName] ?? $dbRoleName;
        
        // Cek apakah role user sesuai dengan yang diizinkan
        if (!in_array($mappedRole, array_map('strtolower', $roles))) {
            abort(403, 'Akses ditolak. Anda tidak memiliki hak akses ke halaman ini.');
        }

        return $next($request);
    }
}