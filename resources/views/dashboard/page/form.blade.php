@extends('layouts.app', ['domain' => $domain])

@section('content')

    <div class="card-header">
        <div class="row">
            <div class="col-12 pt-2 h5">
                <i class="fa fa-{{ $icon }}"></i>
                {{ $title }}
            </div>
        </div>
    </div>

    <div class="card-body m-2">
        @yield('section')
    </div>

@endsection
