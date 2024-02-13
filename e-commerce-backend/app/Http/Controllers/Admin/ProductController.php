<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\helper\ImageStore;
use App\Http\Requests\Admin\RemoveTransactionRequest;
use App\Http\Requests\Admin\StoreProductRequest;
use App\Http\Requests\Admin\StoreTransactionRequest;
use App\Http\Requests\Admin\UpdateProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductAddTransaction;
use App\Models\ProductRemoveTransaction;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class ProductController extends Controller
{
    // datatables
    public function ssd()
    {
        if (Auth::user()->can('view')) {
            $products = Product::with("category", "brand", "supplier", "color");
            return DataTables::of($products)
                ->addColumn("plus-icon", function () {
                    return null;
                })
                ->addColumn("add_remove", function ($each) {
                    $add_btn = '<a href="' . route('product.add', $each->id) . '" class="btn btn-sm btn-dark"><i class="fas fa-plus"></i></a>';

                    $remove_btn = '<a href="' . route('product.remove', $each->id) . '" class="btn btn-sm btn-dark"><i class="fas fa-minus"></i></a>';

                    return '<div class="action">' . $add_btn . $remove_btn . '</div>';
                })
                ->addColumn("action", function ($each) {
                    if (Auth::user()->can('update')) {
                        $edit_btn = '<a href="' . route("product.edit", $each->id) . '" class="btn btn-success" title="edit"><i class="fas fa-edit"></i></a>';
                    } else {
                        $edit_btn = "";
                    }

                    if (Auth::user()->can('delete')) {
                        $delete_btn = '<a href="#" class="btn btn-danger delete-btn" data-url="' . route("product.destroy", $each->id) . '" title="delete"><i class="fas fa-trash-alt"></i></a>';
                    } else {
                        $delete_btn = '';
                    }

                    return '<div class="action">' . $edit_btn . $delete_btn . '</div>';
                })
                ->editColumn("image", function ($each) {
                    return '<img src="' . $each->image_url . '" class="datatable-img" />';
                })
                ->rawColumns(["image", "description", "add_remove", "action"])
                ->make(true);
        } else {
            return abort(403, "Unauthorized Action");
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->can('view')) {
            return view("product.index");
        } else {
            return abort(403, "Unauthorized Action");
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::user()->can('create')) {
            $categories = Category::all();
            $brands = Brand::all();
            $suppliers = Supplier::all();
            $colors = Color::all();
            return view("product.create", compact('categories', 'brands', 'suppliers', 'colors'));
        } else {
            return abort(403, "Unauthorized Action");
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        if (Auth::user()->can('create')) {
            $data = $request->all();
            // slug
            $data["slug"] = time() . $data["name"];
            $colors = $request->colors;
            // take out data that's not necessary
            $data = Arr::except($data, ["colors"]);
            // image
            $image = new ImageStore();
            $data = $image->storeImage("public", "products", $request->file("image"), $data);

            Product::create($data)->color()->sync($colors);
            return redirect(route("product.index"))->with("success", "Product created successfully");
        } else {
            return abort(403, "Unauthorized Action");
        }
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
        if (Auth::user()->can('update')) {
            $categories = Category::all();
            $brands = Brand::all();
            $suppliers = Supplier::all();
            $colors = Color::all();
            $old_colors = $product->color->pluck("id")->toArray();
            return view("product.edit", compact('categories', 'brands', 'suppliers', 'colors', 'old_colors', 'product'));
        } else {
            return abort(403, "Unauthorized Action");
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        if (Auth::user()->can('update')) {
            $data = Arr::except($request->all(), ["colors"]);
            // slug
            $data["slug"] = time() . $data["name"];

            if ($file = $request->file("image")) {
                $image = new ImageStore();
                $image->deleteImage("public", "products", $product->image);
                $data = $image->storeImage("public", "products", $file, $data);
            }
            $product->update($data);
            $product->color()->sync($request->colors);
            return redirect(route("product.index"))->with("success", "Product($product->name) updated successfully");
        } else {
            return abort(403, "Unauthorized Action");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if (Auth::user()->can('delete')) {
            $image = new ImageStore();
            $image->deleteImage("public", "products", $product->image);
            $product->delete();
            return "success";
        } else {
            return abort(403, "Unauthorized Action");
        }
    }

    // Show add transactions
    public function createTransaction(Product $product)
    {
        $suppliers = Supplier::all();
        return view('product.addTransaction', compact("product", "suppliers"));
    }

    public function storeTransaction(StoreTransactionRequest $request, Product $product)
    {
        $data = $request->all();
        $data["product_id"] = $product->id;
        ProductAddTransaction::create($data);
        $product->update([
            "qty" => DB::raw('qty+' . $data["qty"] . ''),
            "buy_price" => $data["buy_price"],
        ]);
        return redirect(route('product.index'))->with("success", '(' . $data["qty"] . ') has been added to ' . $product->name . '');
    }

    // show remove transaction
    public function removeTransaction(Product $product)
    {
        return view('product.removeTransaction', compact('product'));
    }

    public function removeStoreTransaction(RemoveTransactionRequest $request, Product $product)
    {
        $data = $request->all();
        $data["product_id"] = $product->id;
        ProductRemoveTransaction::create($data);
        $product->update([
            "qty" => DB::raw('qty-' . $data["qty"] . ''),
        ]);
        return redirect(route('product.index'))->with("success", '(' . $data["qty"] . ') has been removed from ' . $product->name . '');
    }
}
