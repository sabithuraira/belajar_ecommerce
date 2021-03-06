@extends('layouts.index')

@section('title')
Daftar Keranjang
@endsection

@section('content')
    <form method="POST" action="{{ url('keranjang/beli_sebagian') }}" enctype="multipart/form-data">
        @csrf
        <div class="col-sm-12">  
            @if($apakahAdaKosong!=1)
                <!-- Ketika pengguna memilih tombol ini semua barang yang ada di keranjang, akan langsung masuk ke invoice -->
                <a href="{{ url('keranjang/beli_semua') }}" class="btn btn-success">Beli Semua</a>
            @else 
                <!-- Ketika pengguna memilih tombol ini semua barang yang ada di keranjang, akan langsung masuk ke invoice -->
                <a href="{{ url('keranjang/beli_semua') }}" class="btn btn-success disabled" >Beli Semua</a>
            @endif
            <!-- Ketika pengguna memilih tombol ini semua barang yang ada di keranjang, akan langsung masuk ke invoice -->
            <button type="submit" class="btn btn-success">Beli yang dipilih</button>
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
                    <th>Penjual</th>
                    <th class="text-center" colspan="2">Aksi</th>
                </tr>
                @foreach($datas as $key=>$value)
                    <tr>
                        
                        @php 
                            $barang = $modelBarang->find($value->id_barang);
                            $isKosong = 0;
                            if($barang->jumlah==0) $isKosong = 1;
                        @endphp
                        <td>{{ $key+1 }}</td>
                        <!-- Jika barang kosong, maka tampilan terlihat disable -->
                        @if($isKosong==1)
                            <td><input type="checkbox" name="keranjang[]" value="{{ $value->id }}" disabled></td>
                            <td class="text-muted">{{ $value->barang->kode_barang }} - {{ $value->barang->nama }}</td>
                            <td class="text-muted">{{ $value->jumlah_pesanan }}</td>
                            <td class="text-muted">{{ $value->jumlah_harga }}</td>
                            <td class="text-muted">{{ $value->customer->name }}</td>
                            <td class="text-muted">{{ $value->penjual }}</td>
                            <!-- <td class="text-center">
                                <a class="btn btn-success" href="{{ url('keranjang/'.$value->id.'/pindah_ke_invoice') }}">Jadikan Pembelian</a>
                            </td> -->
                            
                            <td class="text-center"></td>
                            <td class="text-center">
                                <!-- <form action="{{ url('keranjang/'.$value['id']) }}" method="post">
                                    @csrf
                                    <input name="_method" type="hidden" value="DELETE">
                                    <button type="submit" class='btn btn-danger'>Delete</button>
                                </form> -->
                            </td>
                        @else
                            <td><input type="checkbox" name="keranjang[]" value="{{ $value->id }}"></td>
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
                            <td>{{ $value->penjual }}</td>
                            <!-- <td class="text-center">
                                <a class="btn btn-success" href="{{ url('keranjang/'.$value->id.'/pindah_ke_invoice') }}">Jadikan Pembelian</a>
                            </td> -->
                            
                            <td class="text-center"><a class="btn btn-primary" href="{{ url('keranjang/'.$value->id.'/edit/') }}">Update</a></td>
                            <td class="text-center">
                                <!-- <form action="{{ url('keranjang/'.$value['id']) }}" method="post">
                                    @csrf
                                    <input name="_method" type="hidden" value="DELETE">
                                    <button type="submit" class='btn btn-danger'>Delete</button>
                                </form> -->
                            </td>
                        @endif
                        
                    </tr>
                @endforeach()
            </table>
        </div>
    </form>
@endsection
