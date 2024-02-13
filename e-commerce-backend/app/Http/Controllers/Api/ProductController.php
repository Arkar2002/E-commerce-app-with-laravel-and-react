<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ProductForPreviewResource;
use App\Http\Resources\Api\ProductResource;
use App\Models\Brand;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function test()
    {
        return Customer::find(1)->withCount("cart")->first();
    }

    public function index(Request $request)
    {
        try {
            $sortBy = $request->sortBy ?? ["created_at" => "desc"];

            $products = Product::select("id", "name", "slug", "image", "sale_price", "discount_price", "rating");

            if (isset($request->categories)) {
                $categoryValue = $this->filteredData($request->categories);

                foreach ($categoryValue as $value) {
                    $categoryId = Category::where("title", $value)->value("id");
                    $products = $products->orWhere("category_id", $categoryId);
                }
            }

            if (isset($request->brands)) {
                $brandValue = $this->filteredData($request->brands);

                $data = [];

                foreach ($brandValue as $value) {
                    $brandId = Brand::where("title", $value)->value("id");
                    $data[] = ["brand_id", $brandId];
                }

                $products = $products->orWhere($data);
            }

            foreach ($sortBy as $key => $value) {
                $products = $products->orderBy($key, $value);
            }

            $products = $products->paginate(4);
            return ProductForPreviewResource::collection($products);
        } catch (Exception $e) {
            return response(["status" => "fail", "message" => $e->getMessage()]);
        }
    }

    public function show($productSlug)
    {
        $product = Product::with("category:id,title", "brand:id,title", "color:id,title")
            ->where("slug", $productSlug)
            ->firstOrFail();
        $relatedProducts = Product::select("id", "name", "slug", "image", "sale_price", "discount_price", "rating")
            ->where("category_id", $product->category_id)
            ->whereNot("id", $product->id)
            ->inRandomOrder()
            ->limit(4)
            ->get();
        return response(["data" => [
            "product" => new ProductResource($product),
            "relatedProducts" => ProductForPreviewResource::collection($relatedProducts),
        ]]);
    }

    public function likes()
    {
        return Auth::user()->like()->pluck("product_likes.product_id");
    }

    public function getCarts()
    {
        return Auth::user()->cart()->pluck("carts.product_id");
    }

    public function addProductLike(Request $request)
    {
        $customerLikes = Customer::find($request->user()->id)->like();
        if (!in_array($request->product_id, $customerLikes->pluck("product_likes.product_id")->toArray()))
            $customerLikes->attach($request->product_id);
        return response([], 204);
    }

    public function removeProductLike(Request $request)
    {
        $userId = $request->user()->id;
        $productId = $request->product_id;
        $customerLikes = Customer::find($userId)->like();
        if (in_array($productId, $customerLikes->pluck("product_likes.product_id")->toArray()))
            $customerLikes->sync($request->data);
        return response([], 204);
    }

    public function addToCart(Request $request)
    {
        try {
            $customerInCart = Customer::find($request->user()->id)->cart()->pluck("carts.product_id")->toArray();
            if (!in_array($request->product_id, $customerInCart)) {
                Cart::create([
                    "customer_id" => $request->user()->id,
                    "product_id" => $request->product_id,
                    "qty" => $request->qty,
                ]);
                return response(["status" => "success", "message" => "Added to cart"]);
            } else {
                return response(["status" => "fail", "message" => "Already in cart"]);
            }
        } catch (Exception $e) {
            return response(["status" => "fail", "message" => $e->getMessage()]);
        }
    }

    public function filteredData($data)
    {
        return array_filter(explode("%", $data), function ($var) {
            return $var !== "";
        });
    }
}
