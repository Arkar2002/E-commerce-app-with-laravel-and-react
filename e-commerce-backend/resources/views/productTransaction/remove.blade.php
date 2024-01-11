@extends('layouts.app')

@section('title', 'Product Transactions')

@section('content')
    <div class="d-flex align-items-center mb-4">
        <a href="{{ route('product-transations') }}?status=add"
            class="btn {{ request()->query('status') == 'add' ? 'btn-primary' : 'btn-outline-primary' }}  me-2">Add
            Transaction</a>
        <a href="{{ route('product-transations') }}?status=remove"
            class="btn {{ request()->query('status') == 'remove' ? 'btn-primary' : 'btn-outline-primary' }}">Remove
            Transaction</a>
    </div>
    <table id="removeTransactions" class="display" style="width:100%">
        <thead>
            <tr class="">
                <th class="no-sort no-order"></th>
                <th class="no-sort no-order no-search">Image</th>
                <th class="text-center">Product Name</th>
                <th class="text-center no-search">Qty</th>
                <th class="text-center no-sort no-search">Description</th>
                <th class="hidden no-search"></th>
            </tr>
        </thead>
        <tbody class="text-center"></tbody>
    </table>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $table = new DataTable('#removeTransactions', {
                ajax: "{{ route('datatable.product-transations') }}?status=remove",
                columns: [{
                        data: "plus-icon",
                    },
                    {
                        data: "image",
                        name: "image",
                    },
                    {
                        data: "product.name",
                        name: "product.name",
                    },
                    {
                        data: "qty",
                        data: "qty",
                    },
                    {
                        data: "description",
                        data: "description",
                    },
                    {
                        data: "updated_at",
                        data: "updated_at",
                    },
                ],
                order: [
                    // [6, "DESC"],
                ]
            });
        })
    </script>
@endsection
