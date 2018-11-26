@extends('admin.layouts.guest')

@section('title', 'Reset Password')

@section('content')
<div class="card-body">
    <h1>Reset Password</h1>

    <p class="text-muted">Please specify new credentials</p>

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <form method="post" action="{{ route('admin.reset_password') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">

        <div class="input-group mb-3 has-feedback">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fa fa-envelope-o"></i>
                </span>
            </div>

            <input type="email" name="email"
                class="form-control"
                value="{{ $email ?? old('email') }}"
                placeholder="Email address"
                required
                autofocus
            >
        </div>

        <div class="input-group mb-4">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fa fa-lock"></i>
                </span>
            </div>

            <input type="password" name="password"
                class="form-control"
                placeholder="Password"
                required
            >
        </div>

        <div class="input-group mb-4">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fa fa-asterisk"></i>
                </span>
            </div>

            <input type="password" name="password_confirmation"
                class="form-control"
                placeholder="Confirm Password"
                required
            >
        </div>

        <div class="row">
            <div class="col-6">
                <button type="submit" class="btn btn-primary px-4">
                Reset Password
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
