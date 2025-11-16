<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori';
    protected $primaryKey = 'idkategori';
    protected $fillable = [
        'nama_kategori',
    ];
    public function tindakanTerapi(){
        return $this->hasMany(TindakanTerapi::class,'idkategori','idkategori');
    }
    public $timestamps = false;
}
