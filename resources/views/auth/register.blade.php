@extends('layouts.blank')

@section('content')
<div class="card">
    <div class="card-body register-card-body">
        <p class="login-box-msg">Register</p>

        <form action="{{ route('register') }}" method="post">
            @csrf
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Nama" name="name" :value="old('name')" required autofocus >
                <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-user"></span>
                </div>
                </div>
            </div>
            <div class="input-group mb-3">
                <input type="email" class="form-control" placeholder="Email" name="email" :value="old('email')" required >
                <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
                </div>
            </div>
            <div class="input-group mb-3">
                <input type="password" class="form-control" placeholder="Password"  name="password" required >
                <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
                </div>
            </div>
            <div class="input-group mb-3">
                <input type="password" class="form-control" placeholder="Retype password" name="password_confirmation" required >
                <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
                </div>
            </div>
            <div class="row">
                <div class="col-8">
                    <a href="{{ route('login') }}" class="text-center">Sudah punya akun?</a>
                </div>
                <!-- /.col -->
                <div class="col-4">
                <button type="submit" class="btn btn-primary btn-block">Register</button>
                </div>
                <!-- /.col -->
            </div>
        </form>

    </div>
</div><!-- /.card -->
@endsection