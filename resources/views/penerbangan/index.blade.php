@extends('layouts.index')

@section('title')
Daftar Penerbangan
@endsection

@section('content')
    <div class="col-sm-12">  
        <a href="{{ url('penerbangan/create') }}"><button class="btn btn-success">Tambah</button></a>
    </div>
    <br/>
    
    <div class="col-sm-12">
        <table class="table table-bordered">
            <tr>
                <th>No</th>
                <th>{{ $model->attributes()['pesawat'] }}</th>
                <th>Asal- Tujuan</th>
                <th>{{ $model->attributes()['waktu_penerbangan'] }}</th>
                <th>{{ $model->attributes()['status_penerbangan'] }}</th>
                <th class="text-center" colspan="3">Aksi</th>
            </tr>
            @foreach($datas as $key=>$value)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $value->pesawat }}</td>
                    <td>
                        {{ $value->bandaraDari->nama_bandara }} 
                        - 
                        {{ $value->bandaraTujuan->nama_bandara }} 
                    </td>
                    <td>{{ date('d M Y G:i', strtotime($value->waktu_penerbangan)) }}</td>
                    <td>{{ $value->listStatus[$value->status_penerbangan] }}</td>
                    <td class="text-center"><a class="btn btn-primary" href="{{ url('penerbangan/'.$value->id.'/tambah_penumpang/') }}">Tambah Penumpang</a></td>
                    <td class="text-center"><a class="btn btn-primary" href="{{ url('penerbangan/'.$value->id.'/edit/') }}">Update</a></td>
                    <td class="text-center">
                        <form action="{{ url('penerbangan/'.$value['id']) }}" method="post">
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
