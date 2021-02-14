@extends('layouts.index')

@section('title')
Perbaharui Penerbangan
@endsection

@section('content')
    <div class="col-sm-12">
        <form method="post" action="{{ url('penerbangan/'.$model->id) }}" enctype="multipart/form-data">
        @csrf
        <input name="_method" type="hidden" value="PATCH">
        @include('penerbangan._form')
        </form>
    </div>
@endsection
