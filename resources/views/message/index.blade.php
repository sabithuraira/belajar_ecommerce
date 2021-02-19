@extends('layouts.index')

@section('title')
Daftar Message
@endsection

@section('content')
    <div class="col-sm-12">  
        <a href="{{ url('message/create') }}"><button class="btn btn-success">Tambah</button></a>
    </div>
    <br/>
    
    <div class="col-sm-12">
        <table class="table table-bordered">
            <tr>
                <th>No</th>
                <th>{{ $model->attributes()['id_customer'] }}</th>
                <th>{{ $model->attributes()['isi_pesan'] }}</th>
                <th>{{ $model->attributes()['tanggal_waktu'] }}</th>
                <th>{{ $model->attributes()['chat_status'] }}</th>
                <th class="text-center" colspan="2">Aksi</th>
            </tr>
            @foreach($datas as $key=>$value)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $value->id_customer}}</td>
                    <td>{{ $value->isi_pesan }}</td>
                    <td>{{ date('d M Y', strtotime($value->tanggal_waktu)) }}</td>
                    <!-- 
                        = isian ini mengambil dari model "Message" 
                        = fungsi getListChatStatusAtrribute
                        = dan yang ditampilkan sesuai dg variabel dari 'chat_status'
                    -->
                    <td>{{ $value->listChatStatus[$value->chat_status] }}</td>
                    <td class="text-center"><a class="btn btn-primary" href="{{ url('message/'.$value->id.'/edit/') }}">Update</a></td>
                    <td class="text-center">
                        <form action="{{ url('message/'.$value['id']) }}" method="post">
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
