<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreRoleRequest;
use App\Http\Requests\Admin\UpdateRoleRequest;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->can('view_role')) {
            return view('role.index');
        } else {
            return abort(403, "Unauthorized Action");
        }
    }

    // datatable
    public function ssd()
    {
        $roles = Role::query();
        return DataTables::of($roles)
            ->addColumn("plus-icon", function () {
                return null;
            })
            ->addColumn('permissions', function ($each) {
                $output = '';
                foreach ($each->permissions as $p) {
                    $output .= '<span class="badge badge-pill bg-success me-1">' . $p->name . '</span>';
                }
                return $output;
            })
            ->addColumn("action", function ($each) {
                if (Auth::user()->can('update_role')) {
                    $edit_btn = '<a href="' . route("role.edit", $each->id) . '" class="btn btn-success" title="edit"><i class="fas fa-edit"></i></a>';
                } else {
                    $edit_btn = "";
                }

                if (Auth::user()->can('delete_role')) {
                    $delete_btn = '<a href="#" class="btn btn-danger delete-btn" data-url="' . route("role.destroy", $each->id) . '" title="delete"><i class="fas fa-trash-alt"></i></a>';
                } else {
                    $delete_btn = '';
                }

                return '<div class="action">' . $edit_btn . $delete_btn . '</div>';
            })
            ->rawColumns(["permissions", "action"])
            ->removeColumn("guard_name")
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::user()->can('create_role')) {
            $permissions = Permission::all();
            return view('role.create', compact('permissions'));
        } else {
            return abort(403, "Unauthorized Action");
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request)
    {
        if (Auth::user()->can('create_role')) {
            $role = Role::create(["name" => $request->name]);
            $role->givePermissionTo($request->permissions);
            return redirect(route('role.index'))->with('success', "New role ($role->name) has been added");
        } else {
            return abort(403, "Unauthorized Action");
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        if (Auth::user()->can('update_role')) {
            $permissions = Permission::all();
            $oldPermissions = $role->permissions->pluck('id')->toArray();
            return view('role.edit', compact('role', 'permissions', 'oldPermissions'));
        } else {
            return abort(403, "Unauthorized Action");
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        if (Auth::user()->can('update_role')) {
            $role->update(["name" => $request->name]);
            $role->syncPermissions($request->permissions);
            return redirect(route('role.index'))->with('success', "Role ($role->name) has been updated");
        } else {
            return abort(403, "Unauthorized Action");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        if (Auth::user()->can('delete_role')) {
            $role->delete();
            return response([], 204);
        } else {
            return abort(403, "Unauthorized Action");
        }
    }
}
