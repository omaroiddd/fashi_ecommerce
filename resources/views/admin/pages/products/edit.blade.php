@extends('admin.master')

@section('title', 'Products')

@section('headerPage', 'Products')

@section('admin-content')
    <div class="content-wrapper">
        @include('admin.layouts.breadcrumb')

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Edit Product
                                    <a href="{{ route('admin.products.index') }}" class="btn btn-danger float-end">Back</a>
                                </h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.products.update', $product->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row mx-0">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="">Product Name</label>
                                                <input type="text" name="title" class="form-control"
                                                    value="{{ $product->title }}" />
                                                @error('title')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="">Price</label>
                                                <input type="number" name="price" class="form-control"
                                                    value="{{ $product->price }}" />
                                                @error('price')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="">sale Percentage</label>
                                                <input type="number" name="sale_percentage" class="form-control"
                                                    value="{{ $product->sale_percentage }}" />
                                                @error('sale_percentage')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="">Stock Quantity</label>
                                                <input type="number" name="stock_quantity" class="form-control"
                                                    value="{{ $product->stock_quantity }}" />
                                                @error('stock_qty')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="">Category Name</label>
                                                <select name="category_id" class="form-control">
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}"
                                                            {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                                            {{ $category->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('category_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="">Brand Name</label>
                                                <select name="brand_id" class="form-control">
                                                    @foreach ($brands as $brand)
                                                        <option value="{{ $brand->id }}"
                                                            {{ old('brand_id', $product->brand_id) == $brand->id ? 'selected' : '' }}>
                                                            {{ $brand->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('brand_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="">Tags Name</label>
                                                <select name="tags[]" class="form-control" multiple>
                                                    @foreach ($tags as $tag)
                                                        <option @if ($product->tags->contains($tag)) selected @endif
                                                            value="{{ $tag->id }}">
                                                            {{ $tag->tag_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('tags[]')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="">Sizes</label>
                                                <select name="sizes[]" class="form-control" multiple>
                                                    @foreach ($sizes as $size)
                                                        <option @if ($product->sizes->contains($size)) selected @endif
                                                            value="{{ $size->id }}">
                                                            {{ $size->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('sizes[]')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="">Product Image</label>
                                                <input type="file" name="image" class="form-control"/>
                                                @error('image')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                <img src="{{ url($product->image) }}" alt="{{ $product->title }}"
                                                    class="img-fluid my-4 d-block" style="width: 200px;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
@endsection
