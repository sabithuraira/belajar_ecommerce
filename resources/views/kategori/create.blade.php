@extends('layouts.index')


@section('title')
Tambah Kategori
@endsection

@section('content')
    <div class="col-sm-12">
        <form method="post" action="{{ url('kategori') }}" enctype="multipart/form-data">
        @csrf
        @include('kategori._form')
        </form>
    </div>
@endsection
