@extends('layouts.app')

@section('title', 'Create New Color')

@section('back_button', route('color.index'))

@section('content')
    <form action="{{ route('color.store') }}" method="POST" enctype="multipart/form-data" id="create">
        @csrf
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8 mx-auto">
                        <div class="fs-5 mb-3">New Color</div>
                        <div class="form-group mb-3">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title" class="form-control"
                                placeholder="Enter Color Title">
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
    {!! JsValidator::formRequest('App\Http\Requests\Admin\StoreColorRequest', '#create') !!}
@endsection
