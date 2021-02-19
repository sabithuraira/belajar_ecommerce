@extends('layouts.index')

@section('title')
Daftar Kategori
@endsection

@section('content')
    <div class="col-sm-12">  
        <a href="{{ url('kategori/create') }}"><button class="btn btn-success">Tambah</button></a>
    </div>
    <br/>
    
    <div class="col-sm-12">
        <table class="table table-bordered">
            <tr>
                <th>No</th>
                <th>{{ $model->attributes()['nama'] }}</th>
                <th>{{ $model->attributes()['deskripsi'] }}</th>
                <th>{{ $model->attributes()['induk_kategori'] }}</th>
                <th class="text-center" colspan="2">Aksi</th>
            </tr>
            @foreach($datas as $key=>$value)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $value->nama }}</td>
                    @php 

                    @endphp 
                    <td>{{ $value->deskripsi }}</td>
                    <td>
                        <!-- 
                            = Melakukan pengecekan apakah isian induk_kategori ada
                            = Jika ada, maka tampilkan nama kategorinya 
                            = melalui relasi "induk" yang sudah di definisikan pada model "Kategori"
                         -->
                        @if($value->induk_kategori!=null || strlen($value->induk_kategori)>0)
                            {{ $value->induk->nama }}
                        @endif
                    </td>
                    <td class="text-center"><a class="btn btn-primary" href="{{ url('kategori/'.$value->id.'/edit/') }}">Update</a></td>
                    <td class="text-center">
                        <form action="{{ url('kategori/'.$value['id']) }}" method="post">
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
