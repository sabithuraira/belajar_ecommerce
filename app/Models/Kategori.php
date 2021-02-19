<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;
    //menghubungkan model dg tabel "kategori" pada database
    protected $table = "kategori";

    //setting relasi induk kategori ke tabelnya sendiri
    public function induk()
    {
        return $this->hasOne(Kategori::class, 'id', 'induk_kategori');
    }
    
    public function attributes()
    {
        return [
            'nama' => 'Nama',
            'deskripsi' => 'Deskripsi',
            'induk_kategori' => 'Induk Kategori',
            'created_at' => 'Dibuat oleh',
            'updated_at' => 'Diperbaharui oleh',
        ];
    }
}
