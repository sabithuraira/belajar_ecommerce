@extends('layouts.index')

@section('title')
Tambah Bandara
@endsection

@section('content')
    <div class="col-sm-12">
        <form method="post" action="{{ url('bandara') }}" enctype="multipart/form-data">
        @csrf
        @include('bandara._form')
        </form>
    </div>
@endsection
