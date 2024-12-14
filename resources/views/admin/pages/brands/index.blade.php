@extends('admin.master')

@section('title', 'Brands')

@section('headerPage', 'Brands')

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
                                <h4>Brands
                                        <a href="{{route('admin.brands.create')}}" class="btn btn-primary float-end">Add
                                            Brand</a>
                                </h4>
                            </div>
                            <div class="card-body">

                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th width="40%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($brands as $brand)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $brand->name }}</td>
                                                <td>
                                                        <a href="{{ route('admin.brands.edit', $brand->id) }}"
                                                            class="btn text-success">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <!-- <a href=""
                                                            class="btn btn-danger mx-2">Delete</a> -->
                                                        <form action="{{ route('admin.brands.destroy', $brand->id) }}"
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
