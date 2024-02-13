<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\BrandResource;
use App\Http\Resources\Api\CategoryResource;
use App\Http\Resources\Api\ProductForPreviewResource;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function categories()
    {
        return CategoryResource::collection(Category::latest()->get());
    }

    public function brands()
    {
        return BrandResource::collection(Brand::latest()->get());
    }

    public function newarrival()
    {
        return ProductForPreviewResource::collection(Product::orderby("created_at", "DESC")->limit(4)->get());
    }

    public function recommand()
    {
        return ProductForPreviewResource::collection(Product::select("name", "slug", "sale_price", "image", "discount_price", "rating")->orderBy("created_at", "DESC")->limit(20)->get()->random(6));
    }
}
