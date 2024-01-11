@extends('layouts.app')

@section('title', 'Create Employee')

@section('back_button', route('employee.index'))

@section('content')
    <div class="row">
        <div class="col-8 mx-auto">
            <div class="card">
                <div class="card-header">
                    <div>New Employee</div>
                </div>
                <div class="card-body">
                    <form action="{{ route('employee.store') }}" method="POST" id="create" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name" class="form-control"
                                placeholder="Enter Name">
                        </div>
                        <div class="form-group mb-3">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control"
                                placeholder="Enter Email">
                        </div>
                        <div class="form-group mb-3">
                            <label for="phone">Phone Number</label>
                            <input type="number" id="phone" name="phone" class="form-control" placeholder="09xxxxx">
                        </div>
                        <div class="form-group mb-3 image-container">
                            <label for="image">Employee Profile Image</label>
                            <input type="file" name="image" id="image" class="image form-control">
                            <button type="button" class="close-btn d-none" title="Remove Selected Img">&times;</button>
                            <div class="preview-img"></div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="password">Password (min 6)</label>
                            <input type="password" id="password" name="password" class="form-control"
                                placeholder="Enter Password">
                        </div>
                        <div class="form-group mb-3">
                            <label for="password_confirmation">Confirm Password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                class="form-control" placeholder="Confirm Password">
                        </div>
                        <div class="form-group mb-3">
                            <label for="role">Role</label>
                            <select name="roles" id="role" class="form-control">
                                <option selected disabled>Choose Role</option>
                                @foreach ($roles as $r)
                                    <option value="{{ $r->name }}">{{ $r->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="gender">Gender</label>
                            <select name="gender" id="gender" class="form-control">
                                <option selected disabled>Choose Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="address">Address</label>
                            <textarea name="address" id="address" class="form-control" placeholder="Enter Address"></textarea>
                        </div>
                        <div class="d-grid">
                            <button class="btn btn-primary">Create new employee</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    {!! JsValidator::formRequest('App\Http\Requests\Admin\StoreEmployeeRequest', '#create') !!}
@endsection
