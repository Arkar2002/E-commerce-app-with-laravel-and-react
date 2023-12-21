<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductAddTransaction;
use App\Models\ProductRemoveTransaction;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductAddTransactionController extends Controller
{
    public function index(Request $request)
    {
        if ($request->query("product") == "add") {
            $transactions = ProductAddTransaction::latest();
        } else {
            $transactions = ProductRemoveTransaction::latest();
        }

        $transactions = $transactions->with("product", "supplier")->paginate(10)->appends($request->query());

        return view("admin.productAddTransation.index", compact("transactions"));
    }

    public function create(Product $product)
    {
        $suppliers = Supplier::get();
        return view("admin.productAddTransation.product-add-transaction", compact("product", "suppliers"));
    }

    public function store(Request $request, Product $product)
    {
        $data = $request->validate([
            "supplier_id" => "required",
            "buy_price" => "required",
            "qty" => "required",
            "description" => "nullable|string"
        ]);
        $data["product_id"] = $product->id;
        $productTransaction = ProductAddTransaction::create($data);
        $product->update([
            "supplier_id" => $productTransaction->supplier_id,
            "buy_price" => $productTransaction->buy_price,
            "qty" => DB::raw("qty+$productTransaction->qty"),
        ]);
        return redirect(route("product-add-transaction.index") . "?product=add")->with("success", "Product ($product->name) quantity successfully added");
    }
}
