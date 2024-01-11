@extends('layouts.app')

@section('title', "Edit Brand ($brand->title)")

@section('back_button', route('brand.index'))

@section('content')
    <form action="{{ route('brand.update', $brand->id) }}" method="POST" enctype="multipart/form-data" id="update">
        @csrf
        @method('PUT')
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8 mx-auto">
                        <div class="fs-5 mb-3">Edit Brand</div>
                        <div class="form-group mb-3">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title" class="form-control"
                                placeholder="Enter Category Title" value="{{ $brand->title }}">
                        </div>
                        <div class="form-group mb-3 image-container">
                            <label for="image">Brand Image (Optional)</label>
                            <input type="file" name="image" id="image" class="image form-control">
                            <button type="button" class="close-btn d-none" title="Remove Selected Img">&times;</button>
                            <div class="preview-img">
                                <img src="{{ $brand->image_url }}" class="data-image" alt="date image">
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
    {!! JsValidator::formRequest('App\Http\Requests\Admin\UpdateBrandRequest', '#update') !!}
@endsection
