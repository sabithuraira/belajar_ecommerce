@extends('layouts.index')

@section('title')
Tambah Penerbangan
@endsection

@section('content')
    <div class="col-sm-12">
        <form method="post" action="{{ url('penerbangan') }}" enctype="multipart/form-data">
        @csrf
        @include('penerbangan._form')
        </form>
    </div>
@endsection
