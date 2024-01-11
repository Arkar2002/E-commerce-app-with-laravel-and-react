@extends('layouts.app')

@section('title', 'Color')

@section('content')
    @can('create')
        <a href="{{ route('color.create') }}" class="btn btn-success mb-4">
            <i class="fas fa-plus-circle"></i>
            Create new color
        </a>
    @endcan
    <table id="colors" class="display" style="width:100%">
        <thead>
            <tr class="">
                <th class="no-sort no-order"></th>
                <th class="text-center">Name</th>
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
            $table = new DataTable('#colors', {
                ajax: "{{ route('datatables.colors') }}",
                columns: [{
                        data: "plus-icon",
                    },
                    {
                        data: "title",
                        name: "title",
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
