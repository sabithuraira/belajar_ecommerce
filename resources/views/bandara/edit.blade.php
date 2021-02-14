@extends('layouts.index')

@section('title')
Perbaharui Bandara
@endsection

@section('content')
    <div class="col-sm-12">
        <form method="post" action="{{ url('bandara/'.$model->id) }}" enctype="multipart/form-data">
        @csrf
        <input name="_method" type="hidden" value="PATCH">
        @include('bandara._form')
        </form>
    </div>
@endsection
