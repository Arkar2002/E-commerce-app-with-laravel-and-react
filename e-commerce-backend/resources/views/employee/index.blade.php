@extends('layouts.app')

@section('title', 'Employee')

@section('content')
    @can('create_employee')
        <a href="{{ route('employee.create') }}" class="btn btn-success mb-4">
            <i class="fas fa-plus-circle"></i>
            Add new employee
        </a>
    @endcan
    <table id="employees" class="text-center" style="width:100%">
        <thead>
            <tr>
                <th class="no-sort no-order"></th>
                <th class="no-sort no-search">Image</th>
                <th class="text-center">Name</th>
                <th class="text-center no-sort">Email</th>
                <th class="text-center">Role</th>
                <th class="text-center no-sort">Phone</th>
                <th class="text-center">Gender</th>
                <th class="no-search no-sort priority text-center">Action</th>
                <th class="hidden no-search"></th>
            </tr>
        </thead>
        <tbody class="text-center"></tbody>
    </table>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $table = new DataTable('#employees', {
                ajax: "{{ route('datatables.employees') }}",
                columns: [{
                        data: "plus-icon",
                    },
                    {
                        data: "image",
                        name: "image",
                    },
                    {
                        data: "name",
                        name: "name",
                    },
                    {
                        data: "email",
                        name: "email",
                    },
                    {
                        data: "role",
                        name: "role",
                    },
                    {
                        data: "phone",
                        name: "phone",
                    },
                    {
                        data: "gender",
                        name: "gender",
                    },
                    {
                        data: "action",
                        name: "action",
                    },
                    {
                        data: "updated_at",
                    }
                ],
                order: [
                    [8, "DESC"],
                ]
            });
        })
    </script>
@endsection
