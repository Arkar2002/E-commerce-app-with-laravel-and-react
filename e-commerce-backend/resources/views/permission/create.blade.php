@extends('layouts.app')

@section('title', 'Create New Permission')

@section('back_button', route('permission.index'))

@section('content')
    <form action="{{ route('permission.store') }}" method="POST" id="create">
        @csrf
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8 mx-auto">
                        <div class="fs-5 mb-3">New Permission</div>
                        <div class="form-group mb-3">
                            <label for="name">Permission Name</label>
                            <input type="text" name="name" id="name" class="form-control"
                                placeholder="Enter Permission">
                        </div>
                        <div class="d-grid">
                            <button class="btn btn-primary">Create Permission</button>
                        </div>
                    </div>
                </div>
            </div>
    </form>
@endsection

@section('script')
    {!! JsValidator::formRequest('App\Http\Requests\Admin\StorePermissionRequest', '#create') !!}
@endsection
