@extends('layouts.index')

@section('title')
Detail Penerbangan 
                        {{ $model->bandaraDari->nama_bandara }} 
                        - 
                        {{ $model->bandaraTujuan->nama_bandara }} 
@endsection

@section('content')
    <div class="col-sm-12">
            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>{{ $model->attributes()['pesawat'] }}:</label>    
                        {{ $model->pesawat }}
                    </div>
                    
                    <div class="form-group">
                        <label>{{ $model->attributes()['bandara_dari'] }}:</label>
                        {{ $model->bandaraDari->nama_bandara }}
                    </div>

                    <div class="form-group">
                        <label>{{ $model->attributes()['bandara_tujuan'] }}:</label> 
                        {{ $model->bandaraTujuan->nama_bandara }}
                    </div>

                    
                    <div class="form-group">
                        <label>{{ $model->attributes()['waktu_penerbangan'] }}:</label> 
                        {{ date('d M Y G:i', strtotime($model->waktu_penerbangan)) }}
                    </div>

                    
                    <div class="form-group">
                        <label>{{ $model->attributes()['status_penerbangan'] }}:</label> 
                        {{ $model->listStatus[$model->status_penerbangan] }}
                    </div>
                </div>
            </div>
            
            <b>Daftar Penumpang</b> -
            <table class="table table-bordered">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>No KTP</th>
                    <th>Alamat</th>
                </tr>
                @foreach($list_penumpang as $key=>$value)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $value->nama }}</td>
                        <td>{{ $value->no_ktp }}</td>
                        <td>{{ $value->alamat }}</td>
                   </tr>
                @endforeach 
            </table>
    </div>
@endsection


