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
                                <h4>Create Product
                                    <a href="{{ route('admin.products.index') }}" class="btn btn-danger float-end">Back</a>
                                </h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.products.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row mx-0">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="">Product Name</label>
                                                <input type="text" name="title" class="form-control" />
                                                @error('title')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="">Price</label>
                                                <input type="number" name="price" class="form-control" />
                                                @error('price')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="">sale Percentage</label>
                                                <input type="number" name="sale_percentage" class="form-control" />
                                                @error('sale_percentage')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="">Stock Quantity</label>
                                                <input type="number" name="stock_quantity" class="form-control" />
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
                                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
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
                                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
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
                                                        <option value="{{ $tag->id }}">{{ $tag->tag_name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('tag_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="">Sizes</label>
                                                <select name="sizes[]" class="form-control" multiple>
                                                    @foreach ($sizes as $size)
                                                        <option value="{{ $size->id }}">{{ $size->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('size_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="">Product Image</label>
                                                <input type="file" name="image" class="form-control" />
                                                @error('image')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-primary">Save</button>
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
