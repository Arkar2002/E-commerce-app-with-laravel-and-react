@extends('layouts.app')

@section('title', "Edit Color ($color->title)")

@section('back_button', route('color.index'))

@section('content')
    <form action="{{ route('color.update', $color->id) }}" method="POST" enctype="multipart/form-data" id="update">
        @csrf
        @method('PUT')
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8 mx-auto">
                        <div class="fs-5 mb-3">Edit Color</div>
                        <div class="form-group mb-3">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title" class="form-control"
                                placeholder="Enter Color Title" value="{{ $color->title }}">
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
    {!! JsValidator::formRequest('App\Http\Requests\Admin\UpdateColorRequest', '#update') !!}
@endsection
