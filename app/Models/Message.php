<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $table = "message";

    public function attributes()
    {
        return [
            'id_customer' => 'Customer',
            'isi_pesan' => 'Pesan',
            //isian tanggal_waktu, otomatis dari tanggal saat ini
            'tanggal_waktu' => 'Waktu',
            'id_chat_previous' => 'Chat Sebelumnya',
            'chat_status' => 'Status',
            'created_at' => 'Dibuat oleh',
            'updated_at' => 'Diperbaharui oleh',
        ];
    }

    public function getListChatStatusAttribute(){
        return [
            1 => 'Belum Terkirim',
            2 => 'Belum Dibaca',
            3 => 'Sudah Dibaca',
        ];
    }
}
