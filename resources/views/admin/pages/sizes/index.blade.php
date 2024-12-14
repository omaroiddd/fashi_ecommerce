@extends('admin.master')

@section('title', 'Sizes')

@section('headerPage', 'Sizes')

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
                                <h4>Sizes
                                    <a href="{{ route('admin.sizes.create') }}" class="btn btn-primary float-end">
                                        Add Size
                                    </a>
                                </h4>
                            </div>
                            <div class="card-body table-responsive">

                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Size Name</th>
                                            <th>Products</th>
                                            <th width="40%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($sizes as $size)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $size->name }}</td>
                                                <td>
                                                    @foreach ($size->products as $product)
                                                        <span class="badge bg-info my-1">{{ $product->title }}</span>
                                                    @endforeach
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.sizes.edit', $size->id) }}"
                                                        class="btn text-success">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <!-- <a href=""
                                                                class="btn btn-danger mx-2">Delete</a> -->
                                                    <form action="{{ route('admin.sizes.destroy', $size->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn text-danger">
                                                            <i class="fas fa-trash"></i>
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
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
@endsection
