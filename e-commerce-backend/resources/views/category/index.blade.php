@extends('layouts.app')

@section('title', 'Product')

@section('content')
    @can('create')
        <a href="{{ route('category.create') }}" class="btn btn-success mb-4">
            <i class="fas fa-plus-circle"></i>
            Create new category
        </a>
    @endcan
    <table id="categories" class="display" style="width:100%">
        <thead>
            <tr class="">
                <th class="no-sort no-order"></th>
                <th class="no-sort text-center">Image</th>
                <th class="text-center">Name</th>
                <th class="no-sort no-search text-center">Total Products</th>
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
            $table = new DataTable('#categories', {
                ajax: "{{ route('datatables.categories') }}",
                columns: [{
                        data: "plus-icon",
                    },
                    {
                        data: "image",
                        name: "image",
                    },
                    {
                        data: "title",
                        name: "title",
                    },
                    {
                        data: "product_count",
                        data: "product_count",
                        render: (data) => data > 0 ? data : "-",
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
                    [5, "DESC"],
                ]
            });
        })
    </script>
@endsection
