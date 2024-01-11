@extends('layouts.app')

@section('title', 'Permissions')

@section('content')
    @can('create_permission')
        <a href="{{ route('permission.create') }}" class="btn btn-success mb-4">
            <i class="fas fa-plus-circle"></i>
            Create new permissons
        </a>
    @endcan
    <table id="permissions" class="display border" style="width:100%">
        <thead>
            <tr class="">
                <th class="no-sort no-order"></th>
                <th class="text-center">Permission Name</th>
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
            $table = new DataTable('#permissions', {
                ajax: "{{ route('datatables.permissions') }}",
                columns: [{
                        data: "plus-icon",
                    },
                    {
                        data: "name",
                        name: "name",
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
