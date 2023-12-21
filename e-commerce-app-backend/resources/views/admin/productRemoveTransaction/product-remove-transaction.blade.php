@extends('admin.layouts.master')
@section('content')
    <div class="col-6 mx-auto">

        <a href="{{ route('products.index') }}" class="btn btn-warning mb-4">All Products</a>

        <h2>
            Remove for Product
            (<strong class="text-danger">{{ $product->name }}</strong>)
        </h2>
        <div>
            Remaining Quantity: <strong>{{ $product->qty }}</strong>
            <span id="addQty" class="text-danger"></span>
        </div>
        <div>
            Buy From: <strong>{{ $product->supplier->name }}</strong>
        </div>
        <div>
            Buy Price: <strong>{{ $product->buy_price }}.00 MMK</strong>
        </div>
        <hr>

        <form action="{{ route('product-remove-transaction.store', $product->id) }}" method="POST">
            @csrf

            <div class="form-group mb-3">
                <label for="totalQty">Quantity (Remove Quantity)</label>
                <input type="number" id="totalQty" name="qty" class="form-control @error('qty') is-invalid @enderror"
                    placeholder="Amount of quantites to remove">
                @error('qty')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="description">Description (Optional)</label>
                <textarea type="number" id="description" name="description" class="form-control" placeholder="Enter Description"></textarea>
            </div>

            <button class="btn btn-primary">Remove Product</button>
        </form>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $("#totalQty").keyup(function() {
                if (this.value.length === 0) return $("#addQty").text("");
                const remainQty = "{{ $product->qty }}";
                if (Number(remainQty) < Number(this.value)) {
                    this.value = remainQty;
                    $("#addQty").text("Remove quantity should be less than remaining quantites");
                    return;
                }
                $("#addQty").text(`-${this.value} (${Number(remainQty) - Number(this.value)})`);
            })
        })
    </script>
@endsection
