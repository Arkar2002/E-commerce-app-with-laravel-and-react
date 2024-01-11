@extends('layouts.app')

@section('title', 'Create New Category')

@section('back_button', route('category.index'))

@section('content')
    <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data" id="create">
        @csrf
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8 mx-auto">
                        <div class="fs-5 mb-3">New Category</div>
                        <div class="form-group mb-3">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title" class="form-control"
                                placeholder="Enter Category Title">
                        </div>
                        <div class="form-group mb-3 image-container">
                            <label for="image">Category Image</label>
                            <input type="file" name="image" id="image" class="image form-control">
                            <button type="button" class="close-btn d-none" title="Remove Selected Img">&times;</button>
                            <div class="preview-img"></div>
                        </div>

                        <div class="d-grid">
                            <button class="btn btn-primary">Create</button>
                        </div>
                    </div>
                </div>
            </div>
    </form>
@endsection

@section('script')
    {!! JsValidator::formRequest('App\Http\Requests\Admin\StoreCategoryRequest', '#create') !!}
@endsection
