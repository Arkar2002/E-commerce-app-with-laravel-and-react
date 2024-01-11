<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\StoreColorRequest;
use App\Http\Requests\Admin\UpdateColorRequest;
use App\Models\Color;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->can('view')) {
            return view("color.index");
        } else {
            return abort(403, "Unauthorized Action");
        }
    }

    // datatable
    public function ssd()
    {
        $colors = Color::query();
        return DataTables::of($colors)
            ->addColumn("plus-icon", function () {
                return null;
            })
            ->editColumn("title", function ($each) {
                return Str::ucfirst($each->title);
            })
            ->addColumn("action", function ($each) {
                if (Auth::user()->can('update')) {
                    $edit_btn = '<a href="' . route("color.edit", $each->id) . '" class="btn btn-success" title="edit"><i class="fas fa-edit"></i></a>';
                } else {
                    $edit_btn = "";
                }

                if (Auth::user()->can('delete')) {
                    $delete_btn = '<a href="#" class="btn btn-danger delete-btn" data-url="' . route("color.destroy", $each->id) . '" title="delete"><i class="fas fa-trash-alt"></i></a>';
                } else {
                    $delete_btn = '';
                }

                return '<div class="action">' . $edit_btn . $delete_btn . '</div>';
            })
            ->rawColumns(["action"])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::user()->can('create')) {
            return view("color.create");
        } else {
            return abort(403, "Unauthorized Action");
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreColorRequest $request)
    {
        if (Auth::user()->can('create')) {
            $data = $request->only("title");
            $color = Color::create($data);
            return redirect(route("color.index"))->with("success", "New Color ($color->title) has been added");
        } else {
            return abort(403, "Unauthorized Action");
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Color $color)
    {
        if (Auth::user()->can('update')) {
            return view("color.edit", compact("color"));
        } else {
            return abort(403, "Unauthorized Action");
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateColorRequest $request, Color $color)
    {
        if (Auth::user()->can('update')) {
            $data = $request->only("title");
            $color->update($data);
            return redirect(route("color.index"))->with("success", "Color ($color->title) updated successfully");
        } else {
            return abort(403, "Unauthorized Action");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Color $color)
    {
        if (Auth::user()->can('delete')) {
            $color->delete();
            return response([], 204);
        } else {
            return abort(403, "Unauthorized Action");
        }
    }
}
