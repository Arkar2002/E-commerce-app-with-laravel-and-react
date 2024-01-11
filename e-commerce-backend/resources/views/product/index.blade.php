@extends('layouts.app')

@section('title', 'Product')

@section('content')
    @can('create')
        <a href="{{ route('product.create') }}" class="btn btn-success mb-4">
            <i class="fas fa-plus-circle"></i>
            Create new product
        </a>
    @endcan
    <table id="products" class="display text-center" style="width:100%">
        <thead>
            <tr>
                <th class="no-sort no-order"></th>
                <th class="no-sort text-center">Image</th>
                <th class="no-sort text-center">Name</th>
                <th class="no-sort text-center">Category</th>
                <th class="no-sort text-center">Brand</th>
                <th class="no-sort text-center">Supplier</th>
                <th class="no-search text-center">Quantity</th>
                <th class="no-search text-center">Buy Price</th>
                <th class="no-search text-center">Sale Price</th>
                <th class="no-search text-center">Discount Price</th>
                <th class="no-search text-center">View Count</th>
                <th class="no-search text-center">Like Count</th>
                <th class="no-search no-sort text-center">Description</th>
                <th class="no-search no-sort priority2 text-center">
                    <span>Add/Remove</span>
                    <span>(Qty)</span>
                </th>
                <th class="no-search no-sort @can('update') priority @endcan">Action</th>
                <th class="hidden no-search"></th>
            </tr>
        </thead>
        <tbody class="text-center"></tbody>
    </table>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $table = new DataTable('#products', {
                ajax: "{{ route('datatables.products') }}",
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
                        data: "category.title",
                        name: "category.title",
                        render: (data) => data.at(0).toUpperCase() + data.substring(1),
                    },
                    {
                        data: "brand.title",
                        name: "brand.title",
                    },
                    {
                        data: "supplier.name",
                        name: "supplier.name",
                    },
                    {
                        data: "qty",
                        name: "qty",
                    },
                    {
                        data: "buy_price",
                        name: "buy_price",
                        render: (data) => formatCurrency(data),
                    },
                    {
                        data: "sale_price",
                        name: "sale_price",
                        render: (data) => formatCurrency(data),
                    },
                    {
                        data: "discount_price",
                        name: "discount_price",
                        render: (data) => Number(data) > 0 ? formatCurrency(data) : "-",
                    },
                    {
                        data: "view_count",
                        name: "view_count",
                    },
                    {
                        data: "like_count",
                        name: "like_count",
                    },
                    {
                        data: "description",
                        name: "description",
                    },
                    {
                        data: "add_remove",
                        name: "add_remove",
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
                    [14, "DESC"],
                ]
            });
        })
    </script>
@endsection
