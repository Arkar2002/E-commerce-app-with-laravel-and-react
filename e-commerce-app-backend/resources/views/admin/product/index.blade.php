@extends('admin.layouts.master')

@section('search')
    <form action="{{ route('products.index') }}" method="GET"
        class="d-none d-sm-inline-block form-inline  ml-md-3 my-2 my-md-0 navbar-search">
        <div class="input-group">
            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for product name..."
                name="name" value="{{ request()->query('name') ?? '' }}">
            <div class="input-group-append mr-2">
                <button class="btn btn-primary">
                    <i class="fas fa-search fa-sm"></i> Search
                </button>
            </div>
            <a href="{{ route('products.index') }}" class="btn btn-warning">Clear</a>
        </div>
    </form>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <a href="{{ route('products.create') }}" class="btn btn-success">Create New Product</a>
            <form action="{{ route('products.index') }}" method="GET" class="d-flex align-items-center">
                <select name="sortby" class="form-control mr-2 mw-100">
                    <option value="created_at-desc" @if (request()->query('sortby') == 'created_at-desc') selected @endif>
                        Sort by date (Recent first)
                    </option>

                    <option value="created_at-asc" @if (request()->query('sortby') == 'created_at-asc') selected @endif>
                        Sort by date (Earlier first)
                    </option>

                    <option value="sale_price-asc" @if (request()->query('sortby') == 'sale_price-asc') selected @endif>
                        Sort by sale price (Low first)
                    </option>

                    <option value="sale_price-desc" @if (request()->query('sortby') == 'sale_price-desc') selected @endif>
                        Sort by sale price (High first)
                    </option>
                </select>
                <button class="btn btn-primary">Sort</button>
            </form>
        </div>
        <table class="table table-striped text-center">
            <thead>
                <tr>
                    <th class="">Image</th>
                    <th class="">Name</th>
                    <th class="">Category</th>
                    <th class="">Brand</th>
                    <th class="">Buy From</th>
                    <th class="">Qty</th>
                    <th class="">Buy Price</th>
                    <th class="">Sale Price</th>
                    <th class="">Discount Price</th>
                    <th class="">View Count</th>
                    <th class="">Like Count</th>
                    <th class="text-right">Option</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $p)
                    <tr>
                        <td>
                            <img src="{{ $p->image_url }}" alt="{{ $p->name }}" width="100%">
                        </td>
                        <td>{{ Str::ucfirst($p->name) }}</td>
                        <td>{{ $p->category->name }}</td>
                        <td>{{ $p->brand->name }}</td>
                        <td>{{ $p->supplier->name }}</td>
                        <td>{{ $p->qty }}</td>
                        <td>MMK {{ $p->buy_price }}.00</td>
                        <td>MMK {{ $p->sale_price }}.00</td>
                        <td>
                            @if ($p->discount_price === 0)
                                -
                            @else
                                MMK {{ $p->discount_price }}.00
                            @endif
                        </td>
                        <td>{{ $p->view_count }}</td>
                        <td>{{ $p->like_count }}</td>
                        <td class="d-flex justify-content-end">
                            <a href="{{ route('products.edit', $p->id) }}" class="btn btn-primary mr-2" title="Edit">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <button data-toggle="modal" data-target="#productModal{{ $p->id }}"
                                class="btn btn-danger mr-2" title="Delete">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                            <a href="{{ route('product-add-transaction.create', $p->id) }}" title="Product Quantity Add"
                                class="btn btn-dark mr-2">+</a>
                            <a href="{{ route('product-remove-transaction.create', $p->id) }}"
                                title="Product Quantity Remove" class="btn btn-dark mr-2">-</a>

                            <div class="modal fade" id="productModal{{ $p->id }}">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Ready to Delete ({{ $p->name }})?</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">Select "Delete" below if you are ready to delete?</div>
                                        <div class="modal-footer">
                                            <button class="btn btn-secondary" type="button"
                                                data-dismiss="modal">Cancel</button>
                                            <form action="{{ route('products.destroy', $p->id) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button class="btn btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $products->links() }}
    </div>
@endsection
