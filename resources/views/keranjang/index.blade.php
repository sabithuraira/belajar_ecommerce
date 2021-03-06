@extends('layouts.index')

@section('title')
Daftar Keranjang
@endsection

@section('content')
    <form method="post" action="{{ url('keranjang/beli_sebagian') }}" enctype="multipart/form-data">
        @csrf
        <div class="col-sm-12">  
            <!-- Ketika pengguna memilih tombol ini semua barang yang ada di keranjang, akan langsung masuk ke invoice -->
            <a href="{{ url('keranjang/beli_semua') }}" class="btn btn-success">Beli Semua</a>
            
            <!-- Ketika pengguna memilih tombol ini semua barang yang ada di keranjang, akan langsung masuk ke invoice -->
            <buttton type="submit" class="btn btn-success">Beli yang dipilih</buttton>
        </div>
        <br/>
        
        <div class="col-sm-12">
            <table class="table table-bordered">
                <tr>
                    <th>No</th>
                    <th></th>
                    <th>{{ $model->attributes()['id_barang'] }}</th>
                    <th>{{ $model->attributes()['jumlah_pesanan'] }}</th>
                    <th>{{ $model->attributes()['jumlah_harga'] }}</th>
                    <th>{{ $model->attributes()['id_customer'] }}</th>
                    <th class="text-center" colspan="2">Aksi</th>
                </tr>
                @foreach($datas as $key=>$value)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td><input type="checkbox" name="keranjang" value="{{ $value->id }}"></td>
                        <!---  
                            pada kode berikut, kita menampilkan field dari relasi barang
                            - sebelumnya telah dibuat fungsi barang(), sebagai relasi ke tabel barang
                            - melalui field "barang_id"
                            - dalam kasus ini, kita dapat memanggil fungsi barang seperti contoh di bawah
                            - fungsi barang merupakan model barang, sehingga dari fungsi tersebut
                            - kita juga bisa memanggil field dari tabel barang, 
                            - pada contoh kita memanggil field "nama" yang terdapat pada tabel "barang"
                        -->
                        <td>{{ $value->barang->kode_barang }} - {{ $value->barang->nama }}</td>
                        <td>{{ $value->jumlah_pesanan }}</td>
                        <td>{{ $value->jumlah_harga }}</td>
                        <td>{{ $value->customer->name }}</td>
                        <!-- <td class="text-center">
                            <a class="btn btn-success" href="{{ url('keranjang/'.$value->id.'/pindah_ke_invoice') }}">Jadikan Pembelian</a>
                        </td> -->
                        
                        <td class="text-center"><a class="btn btn-primary" href="{{ url('keranjang/'.$value->id.'/edit/') }}">Update</a></td>
                        <td class="text-center">
                            <form action="{{ url('keranjang/'.$value['id']) }}" method="post">
                                @csrf
                                <input name="_method" type="hidden" value="DELETE">
                                <button type="submit" class='btn btn-danger'>Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach()
            </table>
        </div>
    </form>
@endsection
