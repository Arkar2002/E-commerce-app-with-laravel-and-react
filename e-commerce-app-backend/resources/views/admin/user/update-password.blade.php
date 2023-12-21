@extends('admin.layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Change Password</h4>
                </div>
                <form action="{{ route('admin.user.updatePassword') }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="row mt-2">
                        <div class="col-md-10 form-group">
                            <label class="labels">Current Password</label>
                            <input type="password" class="form-control @error('currentPassword') is-invalid @enderror"
                                placeholder="Current Password" name="currentPassword">
                            @error('currentPassword')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-10 form-group">
                            <label class="labels">New Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                placeholder="New Password" name="password">
                            @error('password')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-10 form-group">
                            <label class="labels">Confirm Password</label>
                            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                                placeholder="Confirm Password" name="password_confirmation">
                            @error('password_confirmation')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="pl-2 mt-3">
                            <button class="btn btn-primary">
                                Change Password
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
