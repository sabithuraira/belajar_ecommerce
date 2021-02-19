@extends('layouts.index')


@section('title')
Update Kategori
@endsection

@section('content')
    <div class="col-sm-12">
        <form method="post" action="{{ url('kategori/'.$model->id) }}" enctype="multipart/form-data">
        @csrf
        <input name="_method" type="hidden" value="PATCH">
        @include('kategori._form')
        </form>
    </div>
@endsection
