<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductAddTransactionController;
use App\Http\Controllers\Admin\ProductRemoveTransactionController;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('admin.loginPage');
});

Route::get("/test", function () {
    return Carbon::parse("Now");
});

Route::group(['prefix' => 'admin', "middleware" => "redirectIfNotAuth"], function () {

    // dashboard
    Route::get('/dashboard', [DashboardController::class, "index"])->name('dashboard.index');

    // categories
    Route::resource('categories', CategoryController::class);

    // product
    Route::resource('products', ProductController::class);
    Route::get('product-add-transaction', [ProductAddTransactionController::class, "index"])->name("product-add-transaction.index");
    Route::get('product-add-transaction/{product}', [ProductAddTransactionController::class, "create"])->name("product-add-transaction.create");
    Route::post('product-add-transaction/{product}', [ProductAddTransactionController::class, "store"])->name("product-add-transaction.store");
    Route::get('product-remove-transaction/{product}', [ProductRemoveTransactionController::class, "create"])->name("product-remove-transaction.create");
    Route::post('product-remove-transaction/{product}', [ProductRemoveTransactionController::class, "store"])->name("product-remove-transaction.store");

    // user account management
    Route::get("/user/edit", [AuthController::class, "edit"])->name("admin.user.edit");
    Route::patch("/user/edit", [AuthController::class, "update"])->name("admin.user.update");
    Route::get("/user/update-password", [AuthController::class, "updatePasswordPage"])->name("admin.user.updatePassword");
    Route::patch("/user/update-password", [AuthController::class, "updatePassword"])->name("admin.user.updatePassword");
    Route::get('/logout', [AuthController::class, "logout"])->name('admin.logout');
});

Route::group(['prefix' => 'admin', "middleware" => "redirectIfAuth"], function () {
    Route::get('/login', [AuthController::class, "loginPage"])->name('admin.loginPage');
    Route::get('/register', [AuthController::class, "registerPage"])->name('admin.registerPage');
    Route::post('/login', [AuthController::class, "login"])->name('admin.login');
    Route::post('/register', [AuthController::class, "register"])->name('admin.register');
});
