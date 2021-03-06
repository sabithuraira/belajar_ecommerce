@extends('layouts.index')

@section('title')
Pembayaran Invoice
@endsection

@section('content')
<div class="row clearfix">
    <div class="col-md-6">
        <div class="form-group">
            <label>{{ $model->attributes()['jumlah_transaksi'] }}:</label>    
            <input type="text" class="form-control {{($errors->first('jumlah_transaksi') ? ' parsley-error' : '')}}" name="jumlah_transaksi" disabled value="{{ old('jumlah_transaksi', $model->jumlah_transaksi) }}">
        </div>
        
        <div class="form-group">
            <label>{{ $model->attributes()['kode_transaksi'] }}:</label> 
            <input type="text" class="form-control {{($errors->first('kode_transaksi') ? ' parsley-error' : '')}}" name="kode_transaksi" disabled value="{{ old('kode_transaksi', $model->kode_transaksi) }}">
            
        </div>
    </div>
    
    <div class="col-md-6">
        <form method="post" action="{{ url('invoice/'.$model->id.'/pembayaran') }}" enctype="multipart/form-data">
        @csrf
            <div class="form-group">
                <label>{{ $model->attributes()['metode_pembayaran'] }}:</label>    
                <input type="text" class="form-control {{($errors->first('metode_pembayaran') ? ' parsley-error' : '')}}" name="metode_pembayaran" value="{{ old('metode_pembayaran', $model->metode_pembayaran) }}">
            </div>
            
            <div class="form-group">
                <label>{{ $model->attributes()['ongkir'] }}:</label>    
                <input type="text" class="form-control {{($errors->first('ongkir') ? ' parsley-error' : '')}}" name="ongkir" value="{{ old('ongkir', $model->ongkir) }}">
            </div>
            
            <div class="form-group">
                <label>{{ $model->attributes()['kurir'] }}:</label>    
                <input type="text" class="form-control {{($errors->first('kurir') ? ' parsley-error' : '')}}" name="kurir" value="{{ old('kurir', $model->kurir) }}">
            </div>

            <button type="submit">Simpan</button>
        </form>
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
