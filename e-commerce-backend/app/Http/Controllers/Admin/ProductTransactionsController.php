<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductAddTransaction;
use App\Models\ProductRemoveTransaction;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ProductTransactionsController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query("status") ?? "add";
        if ($status == 'add') {
            return view('productTransaction.add');
        } else {
            return view('productTransaction.remove');
        }
    }

    public function ssd(Request $request)
    {
        $status = $request->query("status") ?? "add";
        $data = null;
        if ($status === 'add') {
            $data = ProductAddTransaction::with("product", "supplier");
        } else {
            $data = ProductRemoveTransaction::with("product");
        }
        return DataTables::of($data)
            ->addColumn("plus-icon", function () {
                return null;
            })
            ->editColumn("qty", function ($each) use ($status) {
                return $status == 'add' ? '<span class="text-success">+' . $each->qty . '</span>' : '<span class="text-danger">-' . $each->qty . '</span>';
            })
            ->editColumn("image", function ($each) {
                return '<img src="' . $each->product->image_url . '" class="datatable-img" />';
            })
            ->rawColumns(["image", "qty"])
            ->make(true);
    }
}
