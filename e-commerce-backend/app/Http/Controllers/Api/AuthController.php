<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\CustomerResource;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            "email" => "required|email|exists:customers,email",
            "password" => "required"
        ], [
            "email.exists" => "Email doesn't exist in our record",
        ]);
        if (Auth::guard('customer')->attempt($credentials)) {
            $user = Customer::find(Auth::guard('customer')->user()->id)->withCount("like")->first();
            $token = $user->createToken("*")->plainTextToken;
            return response([
                "status" => "success",
                "user" => new CustomerResource($user),
                "token" => $token
            ]);
        } else {
            return response([
                "status" => "fail",
            ]);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response(["message" => "logout"], 204);
    }

    public function getUser(Request $request)
    {
        $user = Customer::find($request->user()->id)->withCount("like", "cart")->first();
        return new CustomerResource($user);
    }
}
