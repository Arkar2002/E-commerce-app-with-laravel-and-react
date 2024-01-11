<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EmployeController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductTransactionsController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\ColorController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes(["register" => false]);

Route::group(["middleware" => "auth"], function () {
    Route::get('/', [DashboardController::class, "index"]);

    Route::resource("product", ProductController::class);
    Route::get("product-add-transaction/{product}", [ProductController::class, "createTransaction"])->name("product.add");
    Route::post("product-add-transaction/{product}", [ProductController::class, "storeTransaction"])->name("product.addStore");
    Route::get("product-remove-transaction/{product}", [ProductController::class, "removeTransaction"])->name("product.remove");
    Route::post("product-remove-transaction/{product}", [ProductController::class, "removeStoreTransaction"])->name("product.removeStore");
    Route::get("/products/datables", [ProductController::class, "ssd"])->name("datatables.products");
    Route::get("/product-transactions", [ProductTransactionsController::class, "index"])->name("product-transations");
    Route::get("/product-transactions/datatables", [ProductTransactionsController::class, "ssd"])->name("datatable.product-transations");

    Route::resource("category", CategoryController::class);
    Route::get("/categories/datables", [CategoryController::class, "ssd"])->name("datatables.categories");

    Route::resource("brand", BrandController::class);
    Route::get("/brands/datables", [BrandController::class, "ssd"])->name("datatables.brands");

    Route::resource("color", ColorController::class);
    Route::get("/colors/datables", [ColorController::class, "ssd"])->name("datatables.colors");

    Route::get("/profile", [ProfileController::class, "index"])->name("profile.index");
    Route::get("/profile/edit", [ProfileController::class, "edit"])->name("profile.edit");
    Route::patch("/profile/update", [ProfileController::class, "update"])->name("profile.update");

    Route::resource("employee", EmployeController::class);
    Route::get("/employees/datables", [EmployeController::class, "ssd"])->name("datatables.employees");

    Route::resource("permission", PermissionController::class);
    Route::get("/permissions/datables", [PermissionController::class, "ssd"])->name("datatables.permissions");

    Route::resource("role", RoleController::class)->except(["show"]);
    Route::get("/roles/datables", [RoleController::class, "ssd"])->name("datatables.roles");
});
