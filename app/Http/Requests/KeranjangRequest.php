<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KeranjangRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id_barang' => 'required',
            'jumlah_pesanan' => 'required',
            'id_customer' => 'required',
        ];
    }
}
