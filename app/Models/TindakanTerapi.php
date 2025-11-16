<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TindakanTerapi extends Model
{
    // PERBAIKAN: Pastikan nama tabel sesuai dengan database
    protected $table = 'kode_tindakan_terapi';
    protected $primaryKey = 'idkode_tindakan_terapi';
    
    // PERBAIKAN: Tambahkan semua field yang diperlukan
    protected $fillable = [
        'kode',
        'deskripsi_tindakan_terapi',
        'idkategori',
        'idkategori_klinis',
    ];
    
    public $timestamps = false;
    
    public function kategori(){
        return $this->belongsTo(Kategori::class, 'idkategori', 'idkategori');
    }
    
    public function kategoriKlinis(){
        return $this->belongsTo(KategoriKlinis::class, 'idkategori_klinis', 'idkategori_klinis');
    }
}