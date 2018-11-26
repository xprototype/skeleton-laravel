@extends('admin.layouts.guest')

@section('title', 'Login')

@section('content')
<div class="card-body">
    <h1>Login</h1>

    <p class="text-muted">Sign in to start your session</p>

    <form method="post">
        @csrf

        <div class="input-group mb-3 has-feedback">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fa fa-user"></i>
                </span>
            </div>

            <input type="text" name="username" class="form-control" placeholder="Username">
        </div>

        <div class="input-group mb-4">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fa fa-lock"></i>
                </span>
            </div>

            <input type="password" name="password" class="form-control" placeholder="Password">
        </div>

        <div class="form-group">
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="remember"> Remember Me
                </label>
            </div>
        </div>

        <div class="row">
            <div class="col-6">
                <button type="submit" class="btn btn-primary px-4">
                    Sign In
                </button>
            </div>

            <div class="col-6 text-right">
                <a href="{{ route('admin.forgot_password') }}" class="btn btn-link px-0">
                    Forgot password?
                </a>
            </div>
        </div>
    </form>
</div>
@endsection
