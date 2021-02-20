@extends('layouts.index')

@section('title')
Tambah Penumpang
@endsection

@section('content')
    <div class="col-sm-12">
        <form method="post" action="{{ url('penerbangan/'.$penerbangan->id.'/store_penumpang') }}" enctype="multipart/form-data">
        @csrf
        @include('penerbangan._form_penumpang')
        </form>
    </div>
@endsection
