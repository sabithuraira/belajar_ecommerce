@extends('layouts.index')

@section('title')
Daftar Barang
@endsection

@section('content')
    <div class="col-sm-12">  
        <a href="{{ url('barang/create') }}"><button class="btn btn-success">Tambah</button></a>
    </div>
    <br/>
    <form action="{{url('barang')}}" method="get">
        <div class="input-group mb-3">
            @csrf
            <input type="text" class="form-control" name="search" id="search" value="{{ $keyword }}" placeholder="Search..">

            <div class="input-group-append">
                <button class="btn btn-info" type="submit"><i class="fa fa-search"></i></button>
            </div>
        </div>
        </form>
    <div class="col-sm-12">
        <table class="table table-bordered">
            <tr>
                <th>No</th>
                <th>{{ $model->attributes()['kode_barang'] }}</th>
                <th>{{ $model->attributes()['nama'] }}</th>
                <th>{{ $model->attributes()['harga'] }}</th>
                <th>{{ $model->attributes()['jumlah'] }}</th>
                <th class="text-center" colspan="2">Aksi</th>
            </tr>
            @foreach($datas as $key=>$value)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $value->kode_barang }}</td>
                    <td>{{ $value->nama }}</td>
                    <td>{{ $value->harga }}</td>
                    <td>{{ $value->jumlah }}</td>
                    <td class="text-center"><a class="btn btn-primary" href="{{ url('barang/'.$value->id.'/edit/') }}">Update</a></td>
                    <td class="text-center">
                        <form action="{{ url('barang/'.$value['id']) }}" method="post">
                            @csrf
                            <input name="_method" type="hidden" value="DELETE">
                            <button type="submit" class='btn btn-danger'>Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach()
        </table>
        <br/>
        <!-- 
            fungsi yang disediakan laravel, untuk menampilkan halaman
            fungsi ini dapat digunakan jika menggunakan 'paginate' pada pemanggilan data
            -->
        {{ $datas->links() }} 
    </div>
@endsection
