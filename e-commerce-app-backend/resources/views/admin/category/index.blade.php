@extends('admin.layouts.master')
@section('content')
    <div class="container">
        <div>
            <a href="{{ route('categories.create') }}" class="btn btn-success">Create New Category</a>
        </div>
        <table class="table table-striped text-center">
            <thead>
                <tr>
                    <th class="col-3">Name</th>
                    <th class="col-3">Product Amount</th>
                    <th class="text-right">Option</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $c)
                    <tr>
                        <td>{{ Str::ucfirst($c->name) }}</td>
                        <td>{{ count($c->product) }}</td>
                        <td class="d-flex justify-content-end">
                            <a href="{{ route('categories.edit', $c->id) }}" class="btn btn-primary mr-2">Edit</a>
                            <form action="{{ route('categories.destroy', $c->id) }}" method="POST"
                                onsubmit="return window.confirm('Are you sure you want to delete it')">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $categories->links() }}
    </div>
@endsection
