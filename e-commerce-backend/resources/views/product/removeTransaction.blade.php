@extends('layouts.app')

@section('title', 'Remove Product Transaction')

@section('content')
    <div class="col-6 mx-auto">

        <a href="{{ route('product.index') }}" class="btn btn-dark mb-4">Back</a>

        <h2>
            Remove Quantity for Product
            (<strong class="text-danger">{{ $product->name }}</strong>)
        </h2>
        <div>
            Remaining Quantity: <strong>{{ $product->qty }}</strong>
            <span id="addQty" class="text-success"></span>
        </div>
        <div>
            Buy Price : {{ $product->buy_price }} MMK
        </div>
        <hr>

        <form action="{{ route('product.removeStore', $product->id) }}" method="POST" id="create">
            @csrf

            <div class="form-group mb-3">
                <label for="totalQty">Quantity (Remove Quantity)</label>
                <input type="number" id="totalQty" name="qty" class="form-control @error('qty') is-invalid @enderror"
                    placeholder="Amount of quantites to add">
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
    {!! JsValidator::formRequest('App\Http\Requests\Admin\RemoveTransactionRequest', '#create') !!}
    <script>
        $(document).ready(function() {
            $("#totalQty").on("keyup", function() {
                $currentQty = Number("{{ $product->qty }}");
                if ($currentQty > Number($(this).val())) {
                    $totalQty = $currentQty - Number($(this).val());
                    $("#addQty").html(`<span class="text-danger">-${$(this).val()}(${$totalQty})</span>`);
                } else {
                    $("#addQty").html(
                        `<span class="text-danger">Amount of quantity to remove should be less than ${$currentQty}</span>`
                    );
                    $(this).val($currentQty - 1);
                }
            })
        })
    </script>
@endsection
