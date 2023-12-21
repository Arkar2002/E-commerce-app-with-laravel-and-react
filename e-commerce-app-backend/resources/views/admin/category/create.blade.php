@extends('admin.layouts.master')

@section('content')
    <div class="col-6 mx-auto">
        <div>
            <a href="{{ route('categories.index') }}" class="btn btn-warning">All Category</a>
        </div>

        <hr>

        <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Category Name</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                    placeholder="Category Name">
                @error('name')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="mm_name">Category Name (MM)</label>
                <input type="text" name="mm_name" class="form-control @error('mm_name') is-invalid @enderror"
                    placeholder="ခေါင်းစဉ်">
                @error('mm_name')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <button class="btn btn-primary">Create</button>
        </form>
    </div>
@endsection
