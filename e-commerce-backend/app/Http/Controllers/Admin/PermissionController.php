<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePermissionRequest;
use App\Http\Requests\Admin\UpdatePermissionRequest;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\DataTables;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->can('view_permission')) {
            return view('permission.index');
        } else {
            return abort(403, "Unauthorized Action");
        }
    }

    // datatable
    public function ssd()
    {
        $permissions = Permission::query();
        return DataTables::of($permissions)
            ->addColumn("plus-icon", function () {
                return null;
            })
            ->addColumn("action", function ($each) {
                if (Auth::user()->can('update_permission')) {
                    $edit_btn = '<a href="' . route("permission.edit", $each->id) . '" class="btn btn-success" title="edit"><i class="fas fa-edit"></i></a>';
                } else {
                    $edit_btn = "";
                }

                if (Auth::user()->can('delete_permission')) {
                    $delete_btn = '<a href="#" class="btn btn-danger delete-btn" data-url="' . route("permission.destroy", $each->id) . '" title="delete"><i class="fas fa-trash-alt"></i></a>';
                } else {
                    $delete_btn = '';
                }
                return '<div class="action">' . $edit_btn . $delete_btn . '</div>';
            })
            ->rawColumns(["action"])
            ->removeColumn("guard_name")
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::user()->can('create_permission')) {
            return view('permission.create');
        } else {
            return abort(403, "Unauthorized Action");
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePermissionRequest $request)
    {
        if (Auth::user()->can('create_permission')) {
            $data = $request->only('name');
            $permission = Permission::create($data);
            return redirect(route('permission.index'))->with('success', "New Permission ($permission->name) has been added");
        } else {
            return abort(403, "Unauthorized Action");
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission)
    {
        if (Auth::user()->can('update_permission')) {
            return view('permission.edit', compact('permission'));
        } else {
            return abort(403, "Unauthorized Action");
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePermissionRequest $request, Permission $permission)
    {
        if (Auth::user()->can('update_permission')) {
            $data = $request->only('name');
            $permission->update($data);
            return redirect(route('permission.index'))->with('success', "Permission ($permission->name) updated successfully");
        } else {
            return abort(403, "Unauthorized Action");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        if (Auth::user()->can('delete_permission')) {
            $permission->delete();
            return response([], 204);
        } else {
            return abort(403, "Unauthorized Action");
        }
    }
}
