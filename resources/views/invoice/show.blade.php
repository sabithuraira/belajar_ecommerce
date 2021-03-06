@extends('layouts.index')

@section('title')
Detail Invoice
@endsection

@section('content')
<div class="row clearfix">
    
    <div class="col-sm-12">  
        <a href="{{ url('invoice/'.$model->id.'/print_pdf') }}" class="btn btn-success">Print PDF</a> 
        <a href="{{ url('invoice/print_pdf') }}" class="btn btn-success">Pembayaran</a> 
    </div>
    <br/>
    <div class="col-md-12">
        <div class="form-group">
            <label>{{ $model->attributes()['jumlah_transaksi'] }}:</label>    
            <input type="text" class="form-control {{($errors->first('jumlah_transaksi') ? ' parsley-error' : '')}}" name="jumlah_transaksi" disabled value="{{ old('jumlah_transaksi', $model->jumlah_transaksi) }}">
        </div>
        
        <div class="form-group">
            <label>{{ $model->attributes()['kode_transaksi'] }}:</label> 
            <input type="text" class="form-control {{($errors->first('kode_transaksi') ? ' parsley-error' : '')}}" name="kode_transaksi" disabled value="{{ old('kode_transaksi', $model->kode_transaksi) }}">
            
        </div>
    </div>

    
    
    <div class="col-sm-12">
        <p>Daftar Pesanan</p>
        <table class="table table-bordered">
            <tr>
                <th>No</th>
                <th>{{ $model_invoice->attributes()['id_barang'] }}</th>
                <th>{{ $model_invoice->attributes()['jumlah_barang'] }}</th>
                <th>{{ $model_invoice->attributes()['jumlah_harga'] }}</th>
                <th>{{ $model_invoice->attributes()['id_customer'] }}</th>
            </tr>
            @foreach($list_barang as $key=>$value)
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
</div>
@endsection
