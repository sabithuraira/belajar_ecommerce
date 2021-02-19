@extends('layouts.index')

@section('title')
Daftar Invoice
@endsection

@section('content')
    <div class="col-sm-12">  
        <a href="{{ url('invoice/create') }}"><button class="btn btn-success">Tambah</button></a>
    </div>
    <br/>
    
    <div class="col-sm-12">
        <table class="table table-bordered">
            <tr>
                <th>No</th>
                <th>{{ $model->attributes()['customer_id'] }}</th>
                <th>{{ $model->attributes()['kode_transaksi'] }}</th>
                <th>{{ $model->attributes()['jumlah_transaksi'] }}</th>
                <th>{{ $model->attributes()['metode_pembayaran'] }}</th>
                <th class="text-center" colspan="2">Aksi</th>
            </tr>
            @foreach($datas as $key=>$value)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $value->customer_id }}</td>
                    <td>{{ $value->kode_transaksi }}</td>
                    <td>{{ $value->jumlah_transaksi }}</td>
                    <td>{{ $value->listMetodePembayaran[$value->metode_pembayaran] }}</td>
                    <td class="text-center"><a class="btn btn-primary" href="{{ url('invoice/'.$value->id.'/edit/') }}">Update</a></td>
                    <td class="text-center">
                        <form action="{{ url('invoice/'.$value['id']) }}" method="post">
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
