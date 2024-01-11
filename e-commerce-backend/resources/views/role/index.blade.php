@extends('layouts.app')

@section('title', 'Roles')

@section('content')
    @can('create_role')
        <a href="{{ route('role.create') }}" class="btn btn-success mb-4">
            <i class="fas fa-plus-circle"></i>
            Create new role
        </a>
    @endcan
    <table id="roles" class="display border" style="width:100%">
        <thead>
            <tr class="">
                <th class="no-sort no-order"></th>
                <th class="text-center">Role</th>
                <th class="text-center no-sort">Permissions</th>
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
            $table = new DataTable('#roles', {
                ajax: "{{ route('datatables.roles') }}",
                columns: [{
                        data: "plus-icon",
                    },
                    {
                        data: "name",
                        name: "name",
                    },
                    {
                        data: "permissions",
                        name: "permissions",
                    },
                    {
                        data: "action",
                        data: "action",
                    },
                    {
                        data: "updated_at",
                        data: "updated_at",
                    },
                ],
                order: [
                    [3, "DESC"],
                ]
            });
        })
    </script>
@endsection
