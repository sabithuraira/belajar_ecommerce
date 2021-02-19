@extends('layouts.index')


@section('title')
Tambah Invoice
@endsection

@section('content')
    <div class="col-sm-12">
        <form method="post" action="{{ url('invoice') }}" enctype="multipart/form-data">
        @csrf
        @include('invoice._form')
        </form>
    </div>
@endsection
