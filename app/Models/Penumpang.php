<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penumpang extends Model
{
    use HasFactory;
    protected $table = "penumpang";

    public function attributes()
    {
        return [
            'penerbangan_id' => 'Penerbangan',
            'nama' => 'Nama',
            'no_ktp' => 'Nomor KTP',
            'alamat' => 'Alamat',
            'created_at' => 'Dibuat oleh',
            'updated_at' => 'Diperbaharui oleh',
        ];
    }
}
