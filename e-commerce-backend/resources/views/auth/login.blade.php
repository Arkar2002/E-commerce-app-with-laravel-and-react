@extends('auth.layout.app')

@section('title', 'Login')

@section('content')
    <div class="col-6 mx-auto mt-5">
        <div class="card p-4">
            <h4 class="text-center">Login</h4>
            <hr>
            <div class="card-body">
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="form-group mb-4">
                        <label for="email">Email</label>
                        <input type="text" class="form-control @error('email') is-invalid @enderror" id="email"
                            name="email" placeholder="Enter Email" value="{{ old('email') }}">
                        @error('email')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-4">
                        <label for="password">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror"" id="password"
                            name="password" placeholder="Enter Password">
                        @error('password')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-check mb-4">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                            {{ old('remember') ? 'checked' : '' }}>

                        <label class="form-check-label" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>

                    <button class="btn btn-primary">Login</button>
                </form>
            </div>
        </div>
    </div>
@endsection
