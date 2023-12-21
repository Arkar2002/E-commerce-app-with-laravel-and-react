<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductAddTransaction;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $products = Product::with("category", "brand", "supplier");
        if ($search = $request->query("name")) {
            $products = $products->where("name", "LIKE", "%$search%");
        }

        if ($sortby = $request->query('sortby')) {
            $sortby = explode("-", $request->query('sortby'));
            $products = $products->orderBy($sortby[0], $sortby[1]);
        } else {
            $products = $products->orderBy("created_at", "DESC");
        }
        $products = $products->paginate(10)->appends($request->query());
        return view("admin.product.index", compact("products"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $suppliers = Supplier::all();
        $categories = Category::all();
        $brands = Brand::all();
        $colors = Color::all();
        return view('admin.product.create', compact("suppliers", "categories", "brands", "colors"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $this->productValidation($request);
        $colors = $data["color_id"];
        $data = Arr::except($data, ["color_id"]);
        $file = $request->file("image");
        $filename = uniqid() . $file->getClientOriginalName();
        $file->storeAs("public/productImages", $filename);
        $data["image"] = $filename;
        $product = Product::create($data);
        $product->color()->sync($colors);
        ProductAddTransaction::create([
            "product_id" => $product->id,
            "supplier_id" => $product->supplier_id,
            "qty" => $product->qty,
            "buy_price" => $product->buy_price,
        ]);
        return back()->with("success", "Product ($product->name) successfully created");
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $suppliers = Supplier::all();
        $categories = Category::all();
        $brands = Brand::all();
        $colors = Color::all();
        $product = $product->loadMissing("color");
        return view('admin.product.edit', compact("suppliers", "categories", "brands", "colors", "product"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $data = $this->productValidation($request, $product->id);
        $colors = $data["color_id"];
        $data = Arr::except($data, ["color_id"]);
        if ($file = $request->file("image")) {
            Storage::delete("/public/productImages/" . $product->image);
            $filename = uniqid() . $file->getClientOriginalName();
            $file->storeAs("public/productImages", $filename);
            $data["image"] = $filename;
        }
        $product->update($data);
        $product->color()->sync($colors);
        return back()->with("success", "Product ($product->name) successfully updated");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        Storage::delete("/public/productImages/" . $product->image);
        $product->delete();
        return back()->with("success", "Product Successfully deleted");
    }

    public function productValidation(Request $request, $id = null)
    {
        $required = $id ? "" : "required";
        return $request->validate([
            "name" => "required|string|unique:products,name,$id",
            "image" => "file|mimes:png,jpg,jpeg,webp|$required",
            "description" => "required",
            "qty" => $required,
            "buy_price" => "required",
            "sale_price" => "required",
            "discount_price" => "required",
            "supplier_id" => "required",
            "category_id" => "required",
            "brand_id" => "required",
            "color_id" => "required",
        ]);
    }
}
