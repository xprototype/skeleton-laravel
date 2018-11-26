@extends('layouts.app', ['domain' => ''])

@section('title', 'Profile')

@section('content')
<div class="card-header">
    <div class="row">
        <div class="col-6 pt-2 h5">
            <i class="fa fa-tint"></i>
            Update Profile
        </div>
    </div>
</div>

<div class="card-body m-2">
    <form method="post">
        @csrf

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text"
                name="name"
                class="form-control"
                id="name"
                placeholder="Name"
                value="{{ old('name', $admin->name) }}"
            >
        </div>

        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email"
                name="email"
                class="form-control"
                id="email"
                placeholder="Email address"
                value="{{ old('email', $admin->email) }}"
            >
        </div>

        <div class="form-group">
            <label for="username">Username</label>
            <input type="text"
                name="username"
                class="form-control"
                id="username"
                placeholder="Username"
                value="{{ old('username', $admin->username) }}"
            >
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-sm btn-primary">
                Update Profile
            </button>
        </div>
    </form>
</div>

{{-- Password update --}}
<div class="card-header">
    <div class="row">
        <div class="col-6 pt-2 h5">
            <i class="fa fa-tint"></i>
            Change Password
        </div>
    </div>
</div>

<div class="card-body m-2">
    <form method="post" action="{{ route('dashboard.password_update') }}">
        @csrf

        <div class="form-group">
            <label for="current-password">Current Password</label>
            <input type="password"
                name="current_password"
                class="form-control"
                id="current-password"
                placeholder="Current Password"
                pattern=".{6,}"
                title="6 characters minimum"
            >
        </div>

        <div class="form-group">
            <label for="password">New Password</label>
            <input type="password"
                name="password"
                class="form-control"
                id="password"
                placeholder="New Password"
                pattern=".{6,}"
                title="6 characters minimum"
            >
        </div>

        <div class="form-group">
            <label for="confirm-password">Confirm Password</label>
            <input type="password"
                name="password_confirmation"
                class="form-control"
                id="confirm-password"
                placeholder="Confirm Password"
                pattern=".{6,}"
                title="6 characters minimum"
            >
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-sm btn-primary">
                Change Password
            </button>
        </div>
    </form>
</div>
@endsection