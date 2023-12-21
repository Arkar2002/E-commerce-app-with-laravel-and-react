@extends('admin.layouts.master')

@section('content')
    <div class="col-6 mx-auto">

        <a href="{{ route('products.index') }}" class="btn btn-warning mb-4">All Products</a>

        <h2>
            Add for Product
            (<strong class="text-danger">{{ $product->name }}</strong>)
        </h2>
        <div>
            Remaining Quantity: <strong>{{ $product->qty }}</strong>
            <span id="addQty" class="text-success"></span>
        </div>
        <hr>

        <form action="{{ route('product-add-transaction.store', $product->id) }}" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label for="supplier">Supplier</label>
                <select name="supplier_id" id="supplier" class="form-control">
                    @foreach ($suppliers as $s)
                        <option value="{{ $s->id }}" @if ($s->id === $product->supplier_id) selected @endif>
                            {{ $s->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="buy_price">Buy Price ( Current: {{ $product->buy_price }} MMK )</label>
                <input type="number" name="buy_price" id="buy_price" placeholder="Enter Buy Price"
                    class="form-control @error('buy_price') is-invalid @enderror">
                @error('buy_price')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="totalQty">Quantity (Add Quantity)</label>
                <input type="number" id="totalQty" name="qty" class="form-control @error('qty') is-invalid @enderror"
                    placeholder="Amount of quantites to add">
                @error('qty')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="description">Description (Optional)</label>
                <textarea type="number" id="description" name="description" class="form-control" placeholder="Enter Description"></textarea>
            </div>

            <button class="btn btn-primary">Add Product</button>
        </form>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $("#totalQty").keyup(function() {
                if (this.value.length === 0) return $("#addQty").text("");
                const remainQty = "{{ $product->qty }}";
                $("#addQty").text(`+${this.value} (${Number(this.value) + Number(remainQty)})`);
            })
        })
    </script>
@endsection
