<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $table = "barang";

    public function attributes()
    {
        return [
            'kode_barang' => 'Kode',
            'nama' => 'Nama Barang',
            'harga' => 'Harga',
            'deskripsi' => 'Deskripsi',
            'jumlah' => 'Jumlah',
            'created_by' => 'Dibuat oleh',
            'updated_by' => 'Diperbaharui oleh',
        ];
    }

    //relasi yang menghubungkan dengan user yang melakukan input
    public function createdBy()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }
}
