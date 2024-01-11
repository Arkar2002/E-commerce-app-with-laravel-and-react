<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Http\Controllers\helper\ImageStore;
use App\Http\Requests\Admin\StoreCategoryRequest;
use App\Http\Requests\Admin\UpdateCategoryRequest;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->can('view')) {
            return view("category.index");
        } else {
            return abort(403, "Unauthorized Action");
        }
    }

    // datatables
    public function ssd()
    {
        $categories = Category::withCount("product");
        return DataTables::of($categories)
            ->addColumn("plus-icon", function () {
                return null;
            })
            ->addColumn("image", function ($each) {
                return '<img src="' . $each->image_url . '" class="datatable-img" />';
            })
            ->editColumn("title", function ($each) {
                return Str::ucfirst($each->title);
            })
            ->addColumn("action", function ($each) {
                if (Auth::user()->can('update')) {
                    $edit_btn = '<a href="' . route("category.edit", $each->id) . '" class="btn btn-success" title="edit"><i class="fas fa-edit"></i></a>';
                } else {
                    $edit_btn = "";
                }

                if (Auth::user()->can('delete')) {
                    $delete_btn = '<a href="#" class="btn btn-danger delete-btn" data-url="' . route("category.destroy", $each->id) . '" title="delete"><i class="fas fa-trash-alt"></i></a>';
                } else {
                    $delete_btn = '';
                }

                return '<div class="action">' . $edit_btn . $delete_btn . '</div>';
            })
            ->rawColumns(["image", "action"])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::user()->can('create')) {
            return view("category.create");
        } else {
            return abort(403, "Unauthorized Action");
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        if (Auth::user()->can('create')) {
            $data = $request->all();
            $image = new ImageStore();
            $data = $image->storeImage("public", "categories", $request->file("image"), $data);
            $category = Category::create($data);
            return redirect(route("category.index"))->with("success", "New Category ($category->title) has been added");
        } else {
            return abort(403, "Unauthorized Action");
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        if (Auth::user()->can('update')) {
            return view("category.edit", compact("category"));
        } else {
            return abort(403, "Unauthorized Action");
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        if (Auth::user()->can('update')) {
            $data = $request->all();
            if ($file = $request->file("image")) {
                $image = new ImageStore();
                $image->deleteImage("public", "categories", $category->image);
                $data = $image->storeImage("public", "categories", $file, $data);
            }
            $category->update($data);
            return redirect(route("category.index"))->with("success", "Category ($category->title) updated successfully");
        } else {
            return abort(403, "Unauthorized Action");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if (Auth::user()->can('delete')) {
            $image = new ImageStore();
            $image->deleteImage("public", "categories", $category->image);
            $category->delete();
            return response([], 204);
        } else {
            return abort(403, "Unauthorized Action");
        }
    }
}
