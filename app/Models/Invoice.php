<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $table = "invoice";

    
    //relasi untuk ke tabel User melalui field id_customer
    public function customer()
    {
        return $this->hasOne(User::class, 'id', 'customer_id');
    }

    public function attributes()
    {
        return [
            'jumlah_transaksi' => 'Jumlah Transaksi',
            'kode_transaksi' => 'Kode Transaksi',
            'metode_pembayaran' => 'Metode Pembayaran',
            'kurir' => 'Kurir',
            'ongkir' => 'Ongkir',
            'no_resi' => 'Nomor Resi',
            'id_keranjang' => 'Keranjang',
            'waktu_sampai' => 'Waktu Sampai',
            'customer_id' => 'Customer',
            'created_at' => 'Dibuat oleh',
            'updated_at' => 'Diperbaharui oleh',
        ];
    }

    public function getListMetodePembayaranAttribute(){
        return [
            ''=> '', //karena metode pembayaran bisa kosong, maka isian ini akan mengakomodir tampilan jika isinya kosong.
            1 => 'COD',
            2 => 'Virtual Account',
            3 => 'Transfer Bank',
            4 => 'dll',
        ];
    }
}
