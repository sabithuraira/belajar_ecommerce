@extends('layouts.index')


@section('title')
Tambah Barang
@endsection

@section('content')
    <div class="col-sm-12">
        <form method="post" action="{{ url('barang') }}" enctype="multipart/form-data">
        @csrf
        @include('barang._form')
        </form>
    </div>
@endsection
