<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductRemoveTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductRemoveTransactionController extends Controller
{
    public function create(Product $product)
    {
        $product = $product->loadMissing("supplier");
        return view("admin.productRemoveTransaction.product-remove-transaction", compact("product"));
    }

    public function store(Request $request, Product $product)
    {
        $data = $request->validate(["qty" => "required", "description" => "nullable"]);
        $data["product_id"] = $product->id;
        $data["supplier_id"] = $product->supplier_id;
        $data["buy_price"] = $product->buy_price;
        $qty = $data["qty"];
        $product->update(["qty" => DB::raw("qty-$qty")]);
        ProductRemoveTransaction::create($data);
        return redirect(route("product-add-transaction.index") . "?product=remove")->with("success", "Quantity($qty) was removed from product ($product->name)");
    }
}
