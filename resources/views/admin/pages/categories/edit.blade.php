@extends('admin.master')

@section('title', 'Categories')

@section('headerPage', 'Categories')

@section('admin-content')
    <div class="content-wrapper">
        @include('admin.layouts.breadcrumb')

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">

                        @if ($errors->any())
                            <ul class="alert alert-warning">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <div class="card">
                            <div class="card-header">
                                <h4>Edit Category
                                    <a href="{{ route('admin.categories.index') }}" class="btn btn-danger float-end">Back</a>
                                </h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="">Categories Name</label>
                                        <input type="text" name="name" class="form-control" value="{{ $category->name }}" />
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Categories Image</label>
                                        <input type="file" name="image" class="form-control"/>
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
