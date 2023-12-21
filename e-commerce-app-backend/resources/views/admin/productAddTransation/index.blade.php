@extends('admin.layouts.master')
@section('content')
    <div class="container-fluid">
        <div>
            <a href="{{ route('product-add-transaction.index') }}?product=add"
                class="btn {{ request()->query('product') == 'add' ? 'btn-primary' : 'btn-outline-primary' }}">
                Add Transaction
            </a>
            <a href="{{ route('product-add-transaction.index') }}?product=remove"
                class="btn {{ request()->query('product') == 'remove' ? 'btn-primary' : 'btn-outline-primary' }}">
                Remove Transaction
            </a>
        </div>
        <hr>

        <h2>{{ Str::ucfirst(request()->query('product')) }} Transactions Records</h2>

        @if (count($transactions) > 0)
            <table class="table table-striped text-center">
                <thead>
                    <tr>
                        <th class="col-2">Image</th>
                        <th>Product Name</th>
                        <th>Total Quantity</th>
                        <th>Buy Price</th>
                        <th>Supplier Name</th>
                        <th>Description</th>
                        <th>Buy Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactions as $t)
                        <tr>
                            <td>
                                <img src="{{ $t->product->image_url }}" width="100" alt="">
                            </td>
                            <td>{{ $t->product->name }}</td>
                            <td>{{ $t->qty }}</td>
                            <td>MMK {{ $t->buy_price }}.00</td>
                            <td>{{ $t->supplier->name }}</td>
                            <td>{{ Str::length($t->description) > 0 ? $t->description : '-' }}</td>
                            <td>{{ $t->created_at->format('d-M-Y') }} ({{ $t->created_at->diffForHumans() }})</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div>{{ $transactions->links() }}</div>
        @else
            <h4 class="d-flex justify-content-center align-items-center mt-5">
                There is no &MediumSpace;<strong>{{ request()->query('product') }} transaction data</strong>&MediumSpace;
                to show
            </h4>
        @endif
    </div>
@endsection
