@extends('layouts.app')

@section('title', 'Edit Product (' . $product->name . ')')

@section('back_button', route('product.index'))

@section('content')
    <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data" id="update">
        @csrf
        @method('PUT')
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="fs-5 mb-3">Product Info</div>
                        <div class="form-group mb-3">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control"
                                placeholder="Enter Product Name" value="{{ $product->name }}">
                        </div>
                        <div class="form-group mb-3 image-container">
                            <label for="image">Image (Optional)</label>
                            <input type="file" name="image" id="image" class="image form-control">
                            <button type="button" class="close-btn d-none" title="Remove Selected Img">&times;</button>
                            <div class="preview-img">
                                <img src="{{ $product->image_url }}" class="data-image" alt="">
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="description">Description</label>
                            <textarea name="description" id="summernote" class="form-control" placeholder="Enter Description">{{ $product->description }}
                            </textarea>
                        </div>
                        <hr class="my-3" />
                    </div>
                    <div class="col-md-6">
                        <div class="fs-5 mb-3">Product Detail</div>
                        <div class="form-group mb-3">
                            <label for="category_id">Category</label>
                            <select name="category_id" class="form-select">
                                <option selected disabled>Choose Category</option>
                                @foreach ($categories as $c)
                                    <option value="{{ $c->id }}" @if ($c->id == $product->category_id) selected @endif>
                                        {{ Str::ucfirst($c->title) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="brand_id">Brand</label>
                            <select name="brand_id" class="form-select">
                                <option selected disabled>Choose Brand</option>
                                @foreach ($brands as $b)
                                    <option value="{{ $b->id }}" @if ($b->id == $product->brand_id) selected @endif>
                                        {{ Str::ucfirst($b->title) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="supplier_id">Supplier Name</label>
                            <select name="supplier_id" class="form-select">
                                <option selected disabled>Choose Supplier Name</option>
                                @foreach ($suppliers as $s)
                                    <option value="{{ $s->id }}" @if ($s->id == $product->supplier_id) selected @endif>
                                        {{ Str::ucfirst($s->name) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="color">Choose Color (one or many)</label>
                            <select name="colors[]" class="form-control select2" multiple>
                                @foreach ($colors as $c)
                                    <option value="{{ $c->id }}" @if (in_array($c->id, $old_colors)) selected @endif>
                                        {{ Str::ucfirst($c->title) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="d-grid">
                            <button class="btn btn-primary mb-2">Update Product</button>
                            <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="fs-5 mb-3">Product Price</div>
                        <div class="form-group mb-3">
                            <label for="buy_price">Buy Price</label>
                            <input type="number" name="buy_price" id="buy_price" class="form-control"
                                placeholder="Buy Price" value="{{ $product->buy_price }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="sale_price">Sale Price</label>
                            <input type="number" name="sale_price" id="sale_price" class="form-control"
                                placeholder="Sale Price" value="{{ $product->sale_price }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="discount_price">Discount Price</label>
                            <input type="number" name="discount_price" id="discount_price" class="form-control"
                                placeholder="Discount Price" value="{{ $product->discount_price }}">
                        </div>
                    </div>
                </div>
            </div>
    </form>
@endsection

@section('script')
    {!! JsValidator::formRequest('App\Http\Requests\Admin\UpdateProductRequest', '#update') !!}
    <script>
        $(document).ready(function() {
            $(".dropdown-toggle").removeAttr("data-toggle").attr("data-bs-toggle", "dropdown");
        })
    </script>
@endsection
