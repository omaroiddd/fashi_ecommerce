@extends('admin.master')

@section('title', 'Permissions')

@section('headerPage', 'Permissions')

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
                                <h4>Permissions
                                    @can('create permission')
                                        <a href="{{ url('permissions/create') }}" class="btn btn-primary float-end">Add
                                            Permission</a>
                                    @endcan
                                </h4>
                            </div>
                            <div class="card-body table-responsive">

                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th width="40%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($permissions as $permission)
                                            <tr>
                                                <td>{{ $permission->id }}</td>
                                                <td>{{ $permission->name }}</td>
                                                <td>
                                                    @can('update permission')
                                                        <a href="{{ url('permissions/' . $permission->id . '/edit') }}"
                                                            class="btn text-success">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                    @endcan

                                                    @can('delete permission')
                                                        <a href="{{ url('permissions/' . $permission->id . '/delete') }}"
                                                            class="btn text-danger mx-2">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                    @endcan
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
