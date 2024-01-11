@extends('layouts.app')

@section('title', 'Profile (' . Auth::user()->name . ')')

@section('content')
    <div class="col-10 mx-auto">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 d-flex flex-column justify-content-center align-items-center mb-4">
                        <div class="mb-2">
                            @if (Auth::user()->image)
                                <img src="{{ Auth::user()->image_url }}" alt="user" class="profile-img">
                            @else
                                @if (Auth::user()->gender == 'male')
                                    <img src="{{ asset('storage/admins/default_male.png') }}" alt="user"
                                        class="profile-img" />
                                @else
                                    <img src="{{ asset('storage/admins/default_female.png') }}" alt="user"
                                        class="profile-img" />
                                @endif
                            @endif
                        </div>
                        <p class="text-muted mb-0">{{ Auth::user()->name }}</p>
                        <p class="text-muted mb-0">{{ Auth::user()->email }}</p>
                        <p class="text-muted mb-0">{{ Auth::user()->phone }}</p>
                        <span class="badge badge-pill bg-success">{{ Auth::user()->roles[0]['name'] }}</span>
                    </div>
                    <div class="col-md-6">
                        <p class="text-muted mb-0">
                            <strong>Address </strong>:
                            <span>{{ Auth::user()->address }}</span>
                        </p>
                        <p class="text-muted mb-0">
                            <strong>Gender </strong>:
                            <span>{{ Str::ucfirst(Auth::user()->gender) }}</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="float-end mt-4">
            <a href="{{ route('profile.edit') }}" class="btn btn-main">Edit Profile</a>
        </div>
    </div>
@endsection
