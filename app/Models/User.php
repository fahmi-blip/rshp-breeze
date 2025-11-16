<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'user';
    protected $primaryKey = 'iduser';
    
    protected $fillable = [
        'nama',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public $timestamps = false;
    public $rememberTokenName = null; // Disable remember_token karena tidak ada di database

    // Relasi ke RoleUser
    public function roleUser()
    {
        return $this->hasOne(RoleUser::class, 'iduser', 'iduser');
    }

    // Relasi ke Pemilik
    public function pemilik()
    {
        return $this->hasOne(Pemilik::class, 'iduser', 'iduser');
    }

    // Helper method untuk cek role
    public function hasRole($roleName)
    {
        $roleUser = $this->roleUser()->with('role')->first();
        return $roleUser && $roleUser->status == 1 && 
               strtolower($roleUser->role->nama_role) === strtolower($roleName);
    }

    // Helper method untuk get role name
    public function getRoleName()
    {
        $roleUser = $this->roleUser()->with('role')->first();
        return $roleUser && $roleUser->status == 1 ? $roleUser->role->nama_role : null;
    }
}