@extends('layouts.index')


@section('title')
Update Mesage
@endsection

@section('content')
    <div class="col-sm-12">
        <form method="post" action="{{ url('message/'.$model->id) }}" enctype="multipart/form-data">
        @csrf
        <input name="_method" type="hidden" value="PATCH">
        @include('message._form')
        </form>
    </div>
@endsection
