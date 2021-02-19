@extends('layouts.index')


@section('title')
Update Keranjang
@endsection

@section('content')
    <div class="col-sm-12">
        <form method="post" action="{{ url('keranjang/'.$model->id) }}" enctype="multipart/form-data">
        @csrf
        <input name="_method" type="hidden" value="PATCH">
        @include('keranjang._form')
        </form>
    </div>
@endsection
