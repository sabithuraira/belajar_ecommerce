@extends('layouts.index')

@section('title')
Daftar Pembelian Barang
@endsection

@section('content')
    <div class="col-sm-12">
        <table class="table table-bordered">
            <tr>
                <th>No</th>
                <th>{{ $model->attributes()['id_barang'] }}</th>
                <th>{{ $model->attributes()['jumlah_barang'] }}</th>
                <th>{{ $model->attributes()['jumlah_harga'] }}</th>
                <th>{{ $model->attributes()['id_customer'] }}</th>
                <th class="text-center" colspan="2">Aksi</th>
            </tr>
            @foreach($datas as $key=>$value)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $value->barang->kode_barang }} - {{ $value->barang->nama }}</td>
                    <td>{{ $value->jumlah_barang }}</td>
                    <td>{{ $value->jumlah_harga }}</td>
                    <td>{{ $value->customer->name }}</td>
                    
                    <td class="text-center"><a class="btn btn-primary" href="{{ url('invoice_barang/'.$value->id.'/edit/') }}">Update</a></td>
                    <td class="text-center">
                        <form action="{{ url('invoice_barang/'.$value['id']) }}" method="post">
                            @csrf
                            <input name="_method" type="hidden" value="DELETE">
                            <button type="submit" class='btn btn-danger'>Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach()
        </table>
    </div>
@endsection
