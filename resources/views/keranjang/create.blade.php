@extends('layouts.index')


@section('title')
Tambah Keranjang
@endsection

@section('content')
    <div class="col-sm-12">
        <form method="post" action="{{ url('keranjang') }}" enctype="multipart/form-data">
        @csrf
        @include('keranjang._form')
        </form>
    </div>
@endsection
