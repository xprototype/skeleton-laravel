@extends('layouts.app', ['domain' => $domain])

@section('title', 'Products')

@section('content')
<div class="card-header">
    <div class="row">
        <div class="col-6 pt-2 h5">
            <i class="fa fa-tint"></i>
            Products
        </div>

        <div class="col-6 text-right">
            <a class="btn btn-md btn-square btn-secondary"
                href="{{ route('dashboard.person.create') }}"
            >
                Add New
            </a>
        </div>
    </div>
</div>

<div class="card-body m-2">
    <table class="table table-responsive-sm">
        <thead>
            <tr>
                <th>#</th>
                <th>Age</th>
                <th>Email</th>
                <th>Type</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($people as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->age }}</td>
                    <td>{{ $product->email }}</td>
                    <td>{{ $product->getType() }}</td>
                    <td>
                        <a class="btn btn-pill btn-sm btn-warning"
                            href="{{ route('dashboard.person.edit', ['product' => $product->id]) }}"
                        >
                            <i class="fa fa-pencil-square-o"></i>
                        </a>

                        <form action="{{ route('dashboard.person.destroy', ['product' => $product->id]) }}"
                            method="POST"
                            class="inline pointer"
                        >
                            @csrf
                            @method('DELETE')

                            <a class="btn btn-pill btn-sm btn-danger"
                                onclick="if (confirm('Are you sure?')) { this.parentNode.submit() }"
                            >
                                <i class="fa fa-trash-o"></i>
                            </a>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No records found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    {{--{{ $people->links() }}--}}
</div>
@endsection
