@extends('layouts.app')

@section('title', 'Create New Brand')

@section('back_button', route('brand.index'))

@section('content')
    <form action="{{ route('brand.store') }}" method="POST" enctype="multipart/form-data" id="create">
        @csrf
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8 mx-auto">
                        <div class="fs-5 mb-3">New Brand</div>
                        <div class="form-group mb-3">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title" class="form-control"
                                placeholder="Enter Brand Title">
                        </div>
                        <div class="form-group mb-3 image-container">
                            <label for="image">Brand Image</label>
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
    {!! JsValidator::formRequest('App\Http\Requests\Admin\StoreBrandRequest', '#create') !!}
@endsection
