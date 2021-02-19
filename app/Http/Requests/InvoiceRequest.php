<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'jumlah_transaksi' => 'required',
            'kode_transaksi' => 'required',
            'metode_pembayaran' => 'required',
            'customer_id' => 'required',
        ];
    }
}
