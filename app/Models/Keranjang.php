<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    use HasFactory;
    //menghubungkan model dg tabel "keranjang" pada database
    protected $table = "keranjang";

    //bertugas sebagai fungsi relasi
    //pada kasus ini akan mengarah ke relasi pada field 'id_barang'
    public function barang()
    {
        //akan mengembalikan sebuah class dari "Barang"
        //yang artinya, relasinya akan mengarah ke tabel "Barang"
        //dan field yang direlasikan adalah field 'id' dari tabel Barang
        //dan field 'id_barang' dari tabel ini (Keranjang)
        return $this->hasOne(Barang::class, 'id', 'id_barang');
    }
    
    //Merinci atribute suatu tabel
    //digunakan agar selanjutnya, programmer tidak repot ketika ada 
    //perubahan label pada suatu field
    //misal : nama label "id_barang" akan dirubah dari "Barang" menjadi "Barang Dipesan"
    //dalam kasus ini hanya perlu merubah attributes ini saja, tidak 
    //di berbagai macam view.
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
