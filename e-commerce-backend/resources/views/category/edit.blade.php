@extends('layouts.app')

@section('title', "Edit Category ($category->title)")

@section('back_button', route('category.index'))

@section('content')
    <form action="{{ route('category.update', $category->id) }}" method="POST" enctype="multipart/form-data" id="update">
        @csrf
        @method('PUT')
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8 mx-auto">
                        <div class="fs-5 mb-3">Edit Category</div>
                        <div class="form-group mb-3">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title" class="form-control"
                                placeholder="Enter Category Title" value="{{ $category->title }}">
                        </div>
                        <div class="form-group mb-3 image-container">
                            <label for="image">Category Image (Optional)</label>
                            <input type="file" name="image" id="image" class="image form-control">
                            <button type="button" class="close-btn d-none" title="Remove Selected Img">&times;</button>
                            <div class="preview-img">
                                <img src="{{ $category->image_url }}" class="data-image" alt="date image">
                            </div>
                        </div>

                        <div class="d-grid">
                            <button class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </div>
            </div>
    </form>
@endsection

@section('script')
    {!! JsValidator::formRequest('App\Http\Requests\Admin\UpdateCategoryRequest', '#update') !!}
@endsection
