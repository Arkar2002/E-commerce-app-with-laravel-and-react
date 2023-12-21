<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    // show login page
    public function loginPage()
    {
        return view('admin.auth.login');
    }

    // show register page
    public function registerPage()
    {
        return view('admin.auth.register');
    }

    // login
    public function login(Request $request)
    {
        $request->validate(['email' => "email|exists:admins,email", "password" => "required|min:6"], ["email.exists" => "Not user found with provided email"]);
        $credential = $request->only("email", "password");
        if (Auth::guard("admin")->attempt($credential)) {
            $admin = Auth::guard("admin")->user();
            return redirect(route("categories.index"))->with("success", "Welcome $admin->name");
        } else {
            return back()->with('error', "Provided email or password is incorrect");
        }
    }

    // edit
    public function edit()
    {
        $user = Admin::find(Auth::guard("admin")->user()->id);
        return view("admin.user.edit", compact("user"));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            "name" => "required",
            "gender" => ["required", Rule::in(["male", "female"])],
            "image" => "file|mimes:jpg,jpeg,png,webp|max:2048",
        ]);

        if ($file = $request->file("image")) {
            $filename = uniqid() . $file->getClientOriginalName();
            $file->storeAs("/public/adminImages", $filename);
            $data["image"] = $filename;
        }

        Admin::find(Auth::guard("admin")->user()->id)->update($data);
        return back()->with("success", "Profile changed successfully");
    }

    public function updatePasswordPage()
    {
        return view("admin.user.update-password");
    }

    public function updatePassword(Request $request)
    {
        $data = $request->validate([
            "currentPassword" => "required|min:6",
            "password" => "required|min:6|confirmed|different:currentPassword",
        ]);
        $currentPassword = $data["currentPassword"];
        $newPassword = $data["password"];
        $user = Auth::guard("admin")->user();
        if (Hash::check($currentPassword, $user->password)) {
            Admin::find($user->id)->update(["password" => Hash::make($newPassword)]);
            return back()->with("success", "Password changed");
        } else {
            return back()->with("error", "Password incorrect. Try again!!!");
        }
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect("/");
    }
}
