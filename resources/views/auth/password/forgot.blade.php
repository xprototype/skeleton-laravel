@extends('admin.layouts.guest')

@section('title', 'Forgot Password')

@section('content')
<div class="card-body">
    <h1>Forgot Password</h1>

    <p class="text-muted">Please specify your email address</p>

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <form method="post">
        @csrf

        <div class="input-group mb-3 has-feedback">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fa fa-envelope-o"></i>
                </span>
            </div>

            <input type="email" name="email"
                class="form-control"
                placeholder="Email address"
                required
                autofocus
            >
        </div>

        <div class="row">
            <div class="col-6">
                <button type="submit" class="btn btn-primary px-4">
                    Send Password Reset Link
                </button>
            </div>

            <div class="col-6 text-right">
                <a href="{{ route('admin.login') }}" class="btn btn-link px-0">
                    Login
                </a>
            </div>
        </div>
    </form>
</div>
@endsection
