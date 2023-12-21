@extends('admin.layouts.master')

@section('content')
    <form action="{{ route('admin.user.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="row">
            <div class="col-md-3 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                    @if ($user->image)
                        <img src="{{ $user->image_url }}" width="150">
                    @else
                        @if ($user->gender == 'male')
                            <img src="{{ asset('images/default_user_male.png') }}" width="150" alt="default_user">
                        @else
                            <img src="{{ asset('images/default_user_female.png') }}" width="150" alt="default_user">
                        @endif
                    @endif
                    <span class="text-black-50">{{ $user->name }}</span>
                    <span class="text-black-50 mb-5">{{ $user->email }}</span>
                    <div class="form-group">
                        <label for="image" class="form-label">User Profile
                            Image</label>
                        <input type="file" id="image" name="image"
                            class="form-control @error('image') is-invalid @enderror">
                        @error('image')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <img id="preshowImage" width="200">
                    <span class="text-danger" id="preshowError"></span>
                </div>
            </div>
            <div class="col-md-6 border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Profile Settings</h4>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-10 form-group">
                            <label class="labels">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                placeholder="Name" name="name" value="{{ old('name', $user->name) }}">
                            @error('name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-10 form-group">
                            <label class="labels">Gender</label>
                            <select name="gender" class="form-control  @error('email') is-invalid @enderror">
                                <option value="male" @if ($user->gender === 'male') selected @endif>Male</option>
                                <option value="female" @if ($user->gender === 'female') selected @endif>Female</option>
                            </select>
                            @error('gender')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <hr>
                        <div class="mt-5">
                            <button class="btn btn-primary profile-button">
                                Save Profile
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $("#image").change(function() {
                const formData = new FormData();
                formData.append("preShowImage", this.files[0]);
                $.ajax({
                    method: "POST",
                    processData: false,
                    contentType: false,
                    data: formData,
                    url: "/api/image-preview",
                    success: (data) => {
                        $("#preshowError").text("");
                        $("#preshowImage").attr("src", data);
                    },
                    error: (error) => {
                        $(this).val("");
                        $("#preshowImage").attr("src", "");
                        const {
                            message
                        } = JSON.parse(error.responseText);
                        $("#preshowError").text(message);
                    }
                });

            })
        })
    </script>
@endsection
