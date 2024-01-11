@extends('layouts.app')

@section('title', 'Edit Profile (' . $user->name . ')')

@section('back_button', route('profile.index'))

@section('content')
    <div class="card">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" id="update">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="col-md-6 d-flex flex-column justify-content-center align-items-center mb-4">
                            <div class="mb-2">
                                @if ($user->image)
                                    <img src="{{ $user->image_url }}" alt="user" class="profile-img">
                                @else
                                    @if ($user->gender == 'male')
                                        <img src="{{ asset('storage/admins/default_male.png') }}" alt="user"
                                            class="profile-img" />
                                    @else
                                        <img src="{{ asset('storage/admins/default_female.png') }}" alt="user"
                                            class="profile-img" />
                                    @endif
                                @endif
                            </div>
                            <p class="text-muted mb-0">{{ $user->name }}</p>
                            <p class="text-muted mb-0">{{ $user->email }}</p>
                            <p class="text-muted mb-0">{{ $user->phone }}</p>
                            <div class="form-group my-3 image-container">
                                <label for="image">Profile Image</label>
                                <input type="file" name="image" id="image" class="image form-control">
                                <button type="button" class="close-btn d-none" title="Remove Selected Img">&times;</button>
                                <div class="preview-img"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-10 mx-auto">
                                    <div class="form-group mb-3">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" id="name" class="form-control"
                                            placeholder="Enter Name" value="{{ $user->name }}">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="phone">Phone</label>
                                        <input type="number" name="phone" id="phone" class="form-control"
                                            placeholder="Enter Phone" value="{{ $user->phone }}">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="gender">Gender</label>
                                        <select name="gender" id="gender" class="form-control">
                                            <option value="male" @if ($user->gender == 'male') selected @endif>
                                                Male
                                            </option>
                                            <option value="female" @if ($user->gender == 'female') selected @endif>
                                                Female
                                            </option>
                                        </select>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="address">Address</label>
                                        <textarea name="address" id="address" class="form-control" placeholder="Enter Address">{{ $user->address }}</textarea>
                                    </div>
                                    <div class="d-grid">
                                        <button class="btn btn-main">Update Profile</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    {!! JsValidator::formRequest('App\Http\Requests\Admin\UpdateProfileRequest', '#update') !!}
@endsection
