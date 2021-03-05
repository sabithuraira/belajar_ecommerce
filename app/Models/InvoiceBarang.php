<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceBarang extends Model
{
    use HasFactory;
    protected $table = "invoice_barang";

    public function barang()
    {
        return $this->hasOne(Barang::class, 'id', 'id_barang');
    }

    public function customer()
    {
        return $this->hasOne(User::class, 'id', 'id_customer');
    }

    public function attributes()
    {
        return [
            'id_barang' => 'Barang',
            'jumlah_barang' => 'Jumlah Barang',
            'jumlah_harga' => 'Jumlah Harga',
            'id_customer' => 'Customer',
            'created_at' => 'Dibuat oleh',
            'updated_at' => 'Diperbaharui oleh',
        ];
    }
}
