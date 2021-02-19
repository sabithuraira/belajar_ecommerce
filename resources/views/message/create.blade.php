@extends('layouts.index')


@section('title')
Tambah Message
@endsection

@section('content')
    <div class="col-sm-12">
        <form method="post" action="{{ url('message') }}" enctype="multipart/form-data">
        @csrf
        @include('message._form')
        </form>
    </div>
@endsection
