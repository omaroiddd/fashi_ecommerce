@extends('admin.master')

@section('title', 'Tags')

@section('headerPage', 'Tags')

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
                                <h4>Tags
                                    <a href="{{ route('admin.tags.create') }}" class="btn btn-primary float-end">
                                        Add Tag
                                    </a>
                                </h4>
                            </div>
                            <div class="card-body table-responsive">

                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Tag Name</th>
                                            <th>Products</th>
                                            <th width="40%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($tags as $tag)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $tag->tag_name }}</td>
                                                <td>
                                                    @foreach ($tag->products as $product)
                                                        <span class="badge bg-info my-1">{{ $product->title }}</span>
                                                    @endforeach
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.tags.edit', $tag->id) }}"
                                                        class="btn text-success">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <!-- <a href=""
                                                                class="btn btn-danger mx-2">Delete</a> -->
                                                    <form action="{{ route('admin.tags.destroy', $tag->id) }}"
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
