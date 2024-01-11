<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Http\Controllers\helper\ImageStore;
use App\Http\Requests\Admin\StoreEmployeeRequest;
use App\Http\Requests\Admin\UpdateEmployeeRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class EmployeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('employee.index');
    }

    // datatable
    public function ssd()
    {
        // whereNot("id", Auth::user()->id)
        $userId = Auth::user()->id;
        $employees = User::query();
        return DataTables::of($employees)
            ->editColumn("gender", function ($each) {
                return Str::ucfirst($each->gender);
            })
            ->editColumn("name", function ($each) use ($userId) {
                $checkIfUser = $userId == $each->id ? "(You)" : "";
                return $each->name . $checkIfUser;
            })
            ->addColumn("role", function ($each) {
                $output = "";
                foreach ($each->roles as $r) {
                    $output .= '<span class="badge badge-pill bg-success">' . $r->name . '</span>';
                }
                return $output;
            })
            ->addColumn("plus-icon", function () {
                return null;
            })
            ->addColumn("image", function ($each) {
                return '<img src="' . $each->image_url . '" class="datatable-img" />';
            })
            ->addColumn("action", function ($each) use ($userId) {
                if ($userId !== $each->id) {
                    $edit_btn = '<a href="' . route("employee.edit", $each->id) . '" class="btn btn-success" title="edit"><i class="fas fa-edit"></i></a>';

                    $delete_btn = '<a href="#" class="btn btn-danger delete-btn" data-url="' . route("employee.destroy", $each->id) . '" title="delete"><i class="fas fa-trash-alt"></i></a>';

                    return '<div class="action">' . $edit_btn . $delete_btn . '</div>';
                } else {
                    return null;
                }
            })
            ->rawColumns(["role", "image", "action"])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view("employee.create", compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployeeRequest $request)
    {
        $data = $request->all();
        $data["password"] = Hash::make($data["password"]);
        // image
        $image = new ImageStore();
        $data = $image->storeImage("public", "admins", $request->file("image"), $data);
        $user = User::create($data);
        $user->syncRoles($request->roles);
        return redirect(route("employee.index"))->with("success", "New Employee ($user->name) has been added");
    }

    /**
     * Display the specified resource.
     */
    public function show(User $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $employee)
    {
        $roles = Role::all();
        $oldRoles = $employee->roles->pluck('id')->toArray();
        return view("employee.edit", compact("employee", "roles", "oldRoles"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeeRequest $request, User $employee)
    {
        $data = $request->all();
        if ($data['password']) $data['password'] = Hash::make($data['password']);
        else $data['password'] = $employee->password;
        if ($file = $request->file('image')) {
            $image = new ImageStore();
            if ($employee->image) $image->deleteImage('public', 'admins', $employee->image);
            $data = $image->storeImage("public", "admins", $file, $data);
        }
        $employee->update($data);
        $employee->syncRoles($request->roles);
        return redirect(route("employee.index"))->with("success", "Employee ($employee->name) has been updated");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $employee)
    {
        $image = new ImageStore();
        if ($employee->image) $image->deleteImage('public', 'admins', $employee->image);
        $employee->delete();
        return response([], 204);
    }
}
