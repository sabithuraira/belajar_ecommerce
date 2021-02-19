<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    use HasFactory;
    protected $table = "keranjang";

    public function barang()
    {
        return $this->hasOne(Barang::class, 'id', 'id_barang');
    }
    
    public function attributes()
    {
        return [
            'id_barang' => 'Barang',
            'jumlah_pesanan' => 'Jumlah Pesanan',
            'jumlah_harga' => 'Jumlah Harga',
            'id_customer' => 'Customer',
            'created_at' => 'Dibuat oleh',
            'updated_at' => 'Diperbaharui oleh',
        ];
    }
}
