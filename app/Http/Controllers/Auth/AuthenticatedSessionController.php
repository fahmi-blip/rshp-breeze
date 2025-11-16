<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        // Ambil user yang login
        $user = Auth::user();

        // Cek role user dari database
        $roleUser = DB::table('role_user')
            ->join('role', 'role_user.idrole', '=', 'role.idrole')
            ->where('role_user.iduser', $user->iduser)
            ->where('role_user.status', 1)
            ->first();

        // Jika user tidak punya role atau role tidak aktif
        if (!$roleUser) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            
            return redirect()->route('login')
                ->withErrors(['email' => 'Akun Anda tidak memiliki role yang valid.']);
        }

        // Simpan informasi role ke session
        session([
            'user_role_name' => $roleUser->nama_role,
            'user_role_id' => $roleUser->idrole
        ]);

        // Redirect berdasarkan role
        return $this->redirectBasedOnRole($roleUser->nama_role);
    }

    /**
     * Redirect user based on their role
     */
    protected function redirectBasedOnRole(string $roleName): RedirectResponse
    {
        $roleName = strtolower($roleName);

        return match($roleName) {
            'administrator', 'admin' => redirect()->route('admin.dashboard'),
            'resepsionis' => redirect()->route('resepsionis.dashboard'),
            'dokter' => redirect()->route('dokter.dashboard'),
            'perawat' => redirect()->route('perawat.dashboard'),
            default => redirect()->route('login')
                ->withErrors(['email' => 'Role tidak dikenali: ' . $roleName])
        };
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}