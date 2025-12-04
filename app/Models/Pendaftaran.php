<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;
    
    protected $table = 'temu_dokter';
    
    
    protected $fillable = [
        'idreservasi_dokter',
        'idpet', 
        'idrole_user', 
        'no_urut', 
        'waktu_daftar', 
        'status', 
    ];

    // Relasi ke Hewan
    public function pet()
    {
        return $this->belongsTo(Pet::class, 'idpet');
    }

    // Relasi ke Dokter (User)
    public function roleUser()
    {
        return $this->belongsTo(RoleUser::class, 'idrole_user');
    }
}