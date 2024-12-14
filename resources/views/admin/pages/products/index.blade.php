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

                        @include('inc.success')

                        <div class="card mt-3">
                            <div class="card-header">
                                <h4>Products
                                    <a href="{{ route('admin.products.create') }}" class="btn btn-primary float-end">
                                        Add Product
                                    </a>
                                </h4>
                            </div>
                            <div class="card-body table-responsive">

                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Price</th>
                                            <th>Sale Percentage</th>
                                            <th>Stock Quntity</th>
                                            <th>Image</th>
                                            <th>Category Name</th>
                                            <th>Brand Name</th>
                                            <th>Tags</th>
                                            <th>Sizes</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $product)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $product->title }}</td>
                                                <td>{{ $product->price }}</td>
                                                <td>{{ $product->sale_percentage }}</td>
                                                <td>{{ $product->stock_quantity }}</td>
                                                <td>
                                                    <img class="img-fluid" style="width: 90px;" src="{{ $product->image }}"
                                                        alt="{{ $product->title }}">
                                                </td>
                                                <td>{{ $product->category->name }}</td>
                                                <td>{{ $product->brand->name }}</td>
                                                <td>
                                                    @foreach ($product->tags as $tag)
                                                        <span class="badge bg-primary my-1">{{ $tag->tag_name }}</span>
                                                    @endforeach
                                                </td>
                                                <td>
                                                    @foreach ($product->sizes as $size)
                                                        <span class="badge bg-info my-1">{{ $size->name }}</span>
                                                    @endforeach
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.products.edit', $product->id) }}"
                                                        class="btn text-success">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('admin.products.destroy', $product->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn text-danger">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        {{ $products->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
@endsection
