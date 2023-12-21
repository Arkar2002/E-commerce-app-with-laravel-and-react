@extends('admin.auth.master')

@section('content')
    <div class="col-lg-6 mx-auto">
        <div class="p-5">
            <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Register</h1>
            </div>
            <form class="user">
                <div class="form-group">
                    <input type="email" name="email" class="form-control form-control-user" id="exampleInputEmail"
                        aria-describedby="emailHelp" placeholder="Enter Email Address...">
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword"
                        placeholder="Password">
                </div>

                <a href="" class="btn btn-primary btn-user btn-block">
                    Login
                </a>

            </form>
            <hr>

            <div class="text-center">
                Already user? <a class="small" href="{{ route('admin.loginPage') }}">login!</a>
            </div>
        </div>
    </div>
@endsection
