@extends('admin.layouts.master')

@section('css')
    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
    @foreach ($errors->all() as $error)
        <span>{{ $error }}</span>
    @endforeach
    <div class="container-fluid">
        <div>
            <a href="{{ route('products.index') }}" class="btn btn-warning">All Products</a>
        </div>

        <hr>

        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="row px-3">
                <div class="col-8">
                    <div class="card p-4">
                        <h2 class="text-muted mb-3">Product Info</h2>
                        <div class="form-group">
                            <label for="name">Product Name</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                placeholder="Product Name" value="{{ $product->name }}">
                            @error('name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <img src="{{ $product->image_url }}" width="200">
                        <div class="form-group">
                            <label for="image" class="form-label">Product
                                Image</label>
                            <input type="file" id="image" name="image"
                                class="form-control @error('image') is-invalid @enderror">
                            @error('image')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <img id="preshowImage" width="200">
                        <span class="text-danger" id="preshowError"></span>
                        <div class="form-group">
                            <label for="description" class="form-label">Enter
                                Description</label>
                            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                                placeholder="Description">{{ $product->description }}</textarea>
                            @error('description')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="card p-4">
                        <h2 class="text-muted mb-3">Product Pricing</h2>
                        <div class="form-group">
                            <label for="buy_price">Buy Price</label>
                            <input type="number" id="buy_price" name="buy_price"
                                class="form-control @error('buy_price') is-invalid @enderror" placeholder="Buy Price"
                                value="{{ $product->buy_price }}">
                            @error('buy_price')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="sale_price">Sale Price</label>
                            <input type="number" id="sale_price" name="sale_price"
                                class="form-control @error('sale_price') is-invalid @enderror" placeholder="Sale Price"
                                value="{{ $product->sale_price }}">
                            @error('sale_price')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="discount_price">Discount Price</label>
                            <input type="number" id="discount_price" name="discount_price"
                                class="form-control @error('discount_price') is-invalid @enderror"
                                placeholder="Discount Price" value="{{ $product->discount_price }}">
                            @error('discount_price')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card p-4">
                        <div class="form-group">
                            <label for="supplier_id">Choose Supplier</label>
                            <select id="supplier" id="supplier_id" name="supplier_id"
                                class="form-control @error('supplier_id') is-invalid @enderror">
                                @foreach ($suppliers as $s)
                                    <option value="{{ $s->id }}" @if ($s->id === $product->supplier_id) selected @endif>
                                        {{ $s->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="category_id">Choose Category</label>
                            <select id="category" id="category_id" name="category_id" class="form-control">
                                @foreach ($categories as $c)
                                    <option value="{{ $c->id }}" @if ($c->id === $product->category_id) selected @endif>
                                        {{ Str::ucfirst($c->name) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="brand_id">Choose Brand</label>
                            <select id="brand" id="brand_id" name="brand_id" class="form-control">
                                @foreach ($brands as $b)
                                    <option value="{{ $b->id }}" @if ($b->id === $product->brand_id) selected @endif>
                                        {{ Str::ucfirst($b->name) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="color">Choose Colors</label>
                            <select id="color" name="color_id[]"
                                class="form-control @error('color_id') is-invalid @enderror" multiple>
                                @foreach ($colors as $c)
                                    @foreach ($product->color as $pc)
                                        <option value="{{ $c->id }}"
                                            @if ($pc->id === $c->id) selected @endif>{{ $c->name }}</option>
                                    @endforeach
                                @endforeach
                            </select>
                            @error('color_id')
                                <span class="invalid-feedback">Color field is required</span>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-end align-items-center">
                            <button type="reset" class="btn btn-outline-dark mr-2">Cancel</button>
                            <button class="btn btn-primary">Edit product</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#description").summernote({
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']]
                ]
            });

            $("#color").select2();

            $("#image").change(function() {
                const formData = new FormData();
                formData.append("preShowImage", this.files[0]);
                $.ajax({
                    method: "POST",
                    processData: false,
                    contentType: false,
                    data: formData,
                    url: "/api/image-preview",
                    success: (data) => {
                        $("#preshowError").text("");
                        $("#preshowImage").attr("src", data);
                    },
                    error: (error) => {
                        $(this).val("");
                        const {
                            message
                        } = JSON.parse(error.responseText);
                        $("#preshowError").text(message);
                    }
                });

            })
        })
    </script>
@endsection
