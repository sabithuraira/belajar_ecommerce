@extends('layouts.index')


@section('title')
Update Barang
@endsection

@section('content')
    <div class="col-sm-12">
        <form method="post" action="{{ url('barang/'.$model->id) }}" enctype="multipart/form-data">
        @csrf
        <input name="_method" type="hidden" value="PATCH">
        @include('barang._form')
        </form>
    </div>
@endsection
