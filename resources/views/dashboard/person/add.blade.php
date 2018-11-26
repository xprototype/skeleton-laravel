@extends('dashboard.page.form', ['domain' => $domain, 'title' => $title])

@section('section')
    @include('component.form', ['fields' => $fields, 'actions' => $actions])
    @include('dashboard.person.script.common')
@endsection
