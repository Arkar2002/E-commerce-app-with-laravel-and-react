<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\helper\ImageStore;
use App\Http\Requests\Admin\UpdateProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile.index');
    }

    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function update(UpdateProfileRequest $request)
    {
        $data = $request->all();
        if ($file  = $request->file("image")) {
            $image = new ImageStore();
            if ($userOldImage = Auth::user()->image) $image->deleteImage("public", "admins", $userOldImage);
            $data = $image->storeImage("public", "admins", $file, $data);
        }
        User::find(Auth::user()->id)->update($data);
        return redirect(route('profile.index'))->with('success', "Profile has been updated");
    }
}
