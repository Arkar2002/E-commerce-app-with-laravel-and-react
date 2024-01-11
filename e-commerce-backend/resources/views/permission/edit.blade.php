@extends('layouts.app')

@section('title', "Edit Permission ($permission->name)")

@section('back_button', route('permission.index'))

@section('content')
    <form action="{{ route('permission.update', $permission->id) }}" method="POST" id="update">
        @csrf
        @method('PUT')
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8 mx-auto">
                        <div class="fs-5 mb-3">Edit Permission</div>
                        <div class="form-group mb-3">
                            <label for="name">Permission Name</label>
                            <input type="text" name="name" id="name" class="form-control"
                                placeholder="Enter Permission" value="{{ $permission->name }}">
                        </div>
                        <div class="d-grid">
                            <button class="btn btn-primary">Update Permission</button>
                        </div>
                    </div>
                </div>
            </div>
    </form>
@endsection

@section('script')
    {!! JsValidator::formRequest('App\Http\Requests\Admin\UpdatePermissionRequest', '#update') !!}
@endsection
