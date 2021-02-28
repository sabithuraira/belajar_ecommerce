@extends('layouts.index')


@section('title')
Update Barang
@endsection

@section('content')
    <div class="col-sm-12"> 
        <div class="row clearfix">
            <div class="col-md-12">
                <div class="form-group">
                    <label>{{ $model->attributes()['kode_barang'] }}:</label>    
                    <input type="text" class="form-control {{($errors->first('kode_barang') ? ' parsley-error' : '')}}" name="kode_barang" value="{{ old('kode_barang', $model->kode_barang) }}">
                    @foreach ($errors->get('kode_barang') as $msg)
                        <p class="text-danger">{{ $msg }}</p>
                    @endforeach
                </div>
                
                <div class="form-group">
                    <label>{{ $model->attributes()['nama'] }}:</label> 
                    <input type="text" class="form-control {{($errors->first('nama') ? ' parsley-error' : '')}}" name="nama" value="{{ old('nama', $model->nama) }}">
                    @foreach ($errors->get('nama') as $msg)
                        <p class="text-danger">{{ $msg }}</p>
                    @endforeach
                </div>

                <div class="form-group">
                    <label>{{ $model->attributes()['harga'] }}:</label> 
                    <input type="text" class="form-control {{($errors->first('harga') ? ' parsley-error' : '')}}" name="harga" value="{{ old('harga', $model->harga) }}">
                
                    @foreach ($errors->get('harga') as $msg)
                        <p class="text-danger">{{ $msg }}</p>
                    @endforeach</div>

                <div class="form-group">
                    <label>{{ $model->attributes()['deskripsi'] }}:</label> 
                    <input type="text" class="form-control {{($errors->first('deskripsi') ? ' parsley-error' : '')}}" name="deskripsi" value="{{ old('deskripsi', $model->deskripsi) }}">
                    @foreach ($errors->get('deskripsi') as $msg)
                        <p class="text-danger">{{ $msg }}</p>
                    @endforeach
                </div>
                
                <div class="form-group">
                    <label>{{ $model->attributes()['jumlah'] }}:</label> 
                    <input type="text" class="form-control {{($errors->first('jumlah') ? ' parsley-error' : '')}}" name="jumlah" value="{{ old('jumlah', $model->jumlah) }}">
                    @foreach ($errors->get('jumlah') as $msg)
                        <p class="text-danger">{{ $msg }}</p>
                    @endforeach
                </div> 

                <div class="form-group">
                    <label>Foto:</label>
                    @foreach($list_foto as $key=>$value)
                        <img src="{{ asset('foto/'.$value->url) }}">
                    @endforeach
                </div> 

            </div>
        </div>


    </div>
@endsection
