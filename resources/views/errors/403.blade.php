@extends('layouts.blank')

@section('content')
 <div class="error-page">
    <h2 class="headline text-warning"> 403</h2>

    <div class="error-content">
        <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! Anda belum melakukan autentikasi.</h3>
        <p> 
        Silahkan lakukan <a href="{{ url('login') }}">login</a> untuk mengakses halaman ini.
        </p>
    </div>
<!-- /.error-content -->
</div>
@endsection