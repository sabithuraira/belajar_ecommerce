@extends('layouts.index')

@section('title')
Daftar Bandara
@endsection

@section('content')
    <div class="col-sm-12">  
        <a href="{{ url('bandara/create') }}"><button class="btn btn-success">Tambah</button></a>
    </div>
    <br/>
    
    <div class="col-sm-12">
        <table class="table table-bordered">
            <tr>
                <th>No</th>
                <th>{{ $model->attributes()['kode_bandara'] }}</th>
                <th>{{ $model->attributes()['nama_bandara'] }}</th>
                <th>{{ $model->attributes()['alamat_bandara'] }}</th>
                <th class="text-center" colspan="2">Aksi</th>
            </tr>
            @foreach($datas as $key=>$value)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $value->kode_bandara }}</td>
                    <td>{{ $value->nama_bandara }}</td>
                    <td>{{ $value->alamat_bandara }}</td>
                    <td class="text-center"><a class="btn btn-primary" href="{{ url('bandara/'.$value->id.'/edit/') }}">Update</a></td>
                    <td class="text-center">
                        <form action="{{ url('bandara/'.$value['id']) }}" method="post">
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
