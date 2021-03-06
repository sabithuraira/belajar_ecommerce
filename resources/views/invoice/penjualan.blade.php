@extends('layouts.index')

@section('title')
Daftar Penjualan
@endsection

@section('content')
    <div class="col-sm-12" id="app_vue">
        <table class="table table-bordered">
            <tr>
                <th>No</th>
                <th>{{ $model_invoice->attributes()['id_barang'] }}</th>
                <th>{{ $model_invoice->attributes()['jumlah_barang'] }}</th>
                <th>{{ $model_invoice->attributes()['jumlah_harga'] }}</th>
                <th>{{ $model_invoice->attributes()['id_customer'] }}</th>
                <th>{{ $model_invoice->attributes()['status'] }}</th>
                <th>Aksi</th>
            </tr>
            @foreach($datas as $key=>$value)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $value->barang->kode_barang }} - {{ $value->barang->nama }}</td>
                    <td>{{ $value->jumlah_barang }}</td>
                    <td>{{ $value->jumlah_harga }}</td>
                    <td>{{ $value->customer->name }}</td>
                    <td>{{ $value->listStatus[$value->status] }}</td>
                    <td><a href="#" data-id="{{ $value->id }}" v-on:click="setStatus"  id="add-utama">Ubah Status</a></td>
                </tr>
            @endforeach()
        </table>
        
        @include('invoice.modal_status')
    </div>
@endsection


@section('script')
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    <script>
       var vm = new Vue({  
           el: "#app_vue",
           data:{
                //digunakan untuk menyimpan id_barang yang dipilih oleh pengguna
                id_barang_saat_ini : 0,
            }, 
            methods: {
                setStatus: function(event){
                    var self = this;
                    if(event){
                        let id_barang = event.currentTarget.getAttribute('data-id');
                        // alert(id_barang);
                        self.id_barang_saat_ini = id_barang;
                        $('#form_keranjang').modal('show');
                    }
                },

            }
        });
    </script>
@endsection