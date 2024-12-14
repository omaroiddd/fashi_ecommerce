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

                        @if (session('status'))
                            <div class="alert alert-success">{{ session('status') }}</div>
                        @endif

                        <div class="card mt-3">
                            <div class="card-header">
                                <h4>Categories
                                        <a href="{{route('admin.categories.create')}}" class="btn btn-primary float-end">Add
                                            Category</a>
                                </h4>
                            </div>
                            <div class="card-body">

                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Image</th>
                                            <th width="40%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $category)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $category->name }}</td>
                                                <td>
                                                    <img class="img-fluid" style="width: 90px;" src="{{ $category->image }}" alt="{{ $category->name }}">
                                                </td>
                                                <td>
                                                        <a href="{{ route('admin.categories.edit', $category->id) }}"
                                                            class="btn text-success">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <!-- <a href=""
                                                            class="btn btn-danger mx-2">Delete</a> -->
                                                        <form action="{{ route('admin.categories.destroy', $category->id) }}"
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
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
@endsection
