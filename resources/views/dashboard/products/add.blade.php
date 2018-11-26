@extends('layouts.app', ['page' => 'product'])

@section('title', 'Add New Product')

@section('content')
<div class="card-header">
    <div class="row">
        <div class="col-6 pt-2 h5">
            <i class="fa fa-tint"></i>
            Add New Product
        </div>
    </div>
</div>

<div class="card-body m-2">
    <form role="form" method="POST" action="{{ route('dashboard.products.store') }}">
        @csrf

        <div class="form-group">
            <label for="age">Age</label>
            <input type="number"
                class="form-control"
                name="age"
                required
                placeholder="Age"
                value="{{ old('age') }}"
                step="any"
                id="age"
            >
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email"
                class="form-control"
                name="email"
                required
                placeholder="Email"
                value="{{ old('email') }}"
                id="email"
            >
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control"
                name="description"
                id="description"
                required
                placeholder="Description"
            >{{ old('description') }}</textarea>
        </div>

        <div class="form-group">
            <label for="address">Address</label>
            <textarea class="form-control"
                name="address"
                id="address"
                required
                placeholder="Address"
            >{{ old('address') }}</textarea>
        </div>

        <div class="form-group">
            <label for="type">Type</label>
            <select class="form-control"
                name="type"
                required
                id="type"
            >
                @foreach ($typeOptions as $key => $value)
                    <option value="{{ $key }}"
                        {{ old('type') == $key ? 'selected' : '' }}
                    >
                        {{ $value }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-sm btn-primary">
                Submit
            </button>

            <a class="btn btn-sm btn-danger"
                href="{{ route('dashboard.products.index') }}"
            >
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
