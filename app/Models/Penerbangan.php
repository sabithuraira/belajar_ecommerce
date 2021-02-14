<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penerbangan extends Model
{
    use HasFactory;
    protected $table = "penerbangan";

    public function attributes()
    {
        return [
            'pesawat' => 'Pesawat',
            'bandara_dari' => 'Bandara Asal',
            'bandara_tujuan' => 'Bandara Tujuan',
            'waktu_penerbangan' => 'Waktu Terbang',
            'status_penerbangan' => 'Status',
            'created_at' => 'Dibuat oleh',
            'updated_at' => 'Diperbaharui oleh',
        ];
    }

    public function bandaraDari()
    {
        return $this->hasOne(Bandara::class, 'id', 'bandara_dari');
    }
    
    public function bandaraTujuan()
    {
        return $this->hasOne(Bandara::class, 'id', 'bandara_tujuan');
    }

    public function getListStatusAttribute(){
        return [
            1 => 'Belum Terbang',
            2 => 'Menunggu Terbang',
            3 => 'Sudah Terbang',
            4 => 'Sudah Sampai',
        ];
    }
}
