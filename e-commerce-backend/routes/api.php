<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Support\Facades\Route;

// Auth Api
Route::post("/login", [AuthController::class, "login"]);

// Login-User access
Route::group(["middleware" => "auth:sanctum"], function () {
    Route::get("/logout", [AuthController::class, "logout"]);
    Route::get("/user", [AuthController::class, "getUser"]);
    Route::get("/product-likes", [ProductController::class, "likes"]);
    Route::post("/product-likes", [ProductController::class, "addProductLike"]);
    Route::post("/product-unlikes", [ProductController::class, "removeProductLike"]);
    Route::post("/addToCart", [ProductController::class, "addToCart"]);
    Route::get("/carts", [ProductController::class, "getCarts"]);
});

// Guest Access
Route::get("/products", [ProductController::class, "index"]);
Route::get("/products/{productSlug}", [ProductController::class, "show"]);
Route::get("/test", [ProductController::class, "test"]);

Route::get('/categories', [HomeController::class, "categories"]);
Route::get('/brands', [HomeController::class, "brands"]);
Route::get('/newarrival', [HomeController::class, "newarrival"]);
Route::get('/recommand', [HomeController::class, "recommand"]);
