@extends('layouts.app')

@section('title', "Edit Role ($role->name)")

@section('back_button', route('role.index'))

@section('content')
    <form action="{{ route('role.update', $role->id) }}" method="POST" id="update">
        @csrf
        @method('PUT')
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8 mx-auto">
                        <div class="fs-5 mb-3">Edit Role</div>
                        <div class="form-group mb-3">
                            <label for="name">Role</label>
                            <input type="text" name="name" id="name" class="form-control"
                                placeholder="Enter Role" value="{{ $role->name }}">
                        </div>

                        <div>Permissions</div>
                        <div class="row mb-4 permissions">
                            @foreach ($permissions as $p)
                                <div class="col-md-3 mx-auto col-6 form-checkbox">
                                    <input type="checkbox" value="{{ $p->name }}" name="permissions[]"
                                        id="{{ $p->id }}" @if (in_array($p->id, $oldPermissions)) checked @endif>
                                    <label for="{{ $p->id }}">{{ $p->name }}</label>
                                </div>
                            @endforeach
                        </div>
                        <div class="d-grid">
                            <button class="btn btn-primary">Create Role</button>
                        </div>
                    </div>
                </div>
            </div>
    </form>
@endsection

@section('script')
    {!! JsValidator::formRequest('App\Http\Requests\Admin\UpdateRoleRequest', '#update') !!}
@endsection
