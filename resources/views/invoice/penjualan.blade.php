@extends('layouts.index')

@section('title')
Daftar Penjualan
@endsection

@section('content')
    <div class="col-sm-12">
        <table class="table table-bordered">
            <tr>
                <th>No</th>
                <th>{{ $model_invoice->attributes()['id_barang'] }}</th>
                <th>{{ $model_invoice->attributes()['jumlah_barang'] }}</th>
                <th>{{ $model_invoice->attributes()['jumlah_harga'] }}</th>
                <th>{{ $model_invoice->attributes()['id_customer'] }}</th>
            </tr>
            @foreach($datas as $key=>$value)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $value->barang->kode_barang }} - {{ $value->barang->nama }}</td>
                    <td>{{ $value->jumlah_barang }}</td>
                    <td>{{ $value->jumlah_harga }}</td>
                    <td>{{ $value->customer->name }}</td>
                </tr>
            @endforeach()
        </table>
    </div>
@endsection
