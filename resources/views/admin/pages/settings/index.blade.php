@extends('admin.master')

@section('title', 'Settings')

@section('headerPage', 'Settings')

@section('admin-content')
    <div class="content-wrapper">
        @include('admin.layouts.breadcrumb')

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                @include('inc.success')
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mt-3">
                            <div class="card-header">
                                <h4>
                                    Settings
                                    <a href="{{ route('admin.social.create') }}" class="btn btn-primary float-end">
                                        Add Setting
                                    </a>
                                </h4>
                            </div>
                            <div class="card-body table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Address</th>
                                            <th>Facebook Url</th>
                                            <th>Twitter Url</th>
                                            <th>Instagram Url</th>
                                            <th>Youtube Url</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($settings as $setting)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $setting->email }}</td>
                                                <td>{{ $setting->phone }}</td>
                                                <td>{{ $setting->address }}</td>
                                                <td>{{ $setting->facebook }}</td>
                                                <td>{{ $setting->twitter }}</td>
                                                <td>{{ $setting->instagram }}</td>
                                                <td>{{ $setting->youtube }}</td>
                                                <td>
                                                    <a href="{{ route('admin.social.edit', $setting->id) }}"
                                                        class="btn text-success">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <!-- <a href=""
                                                                class="btn btn-danger mx-2">Delete</a> -->
                                                    <form action="{{ route('admin.social.destroy', $setting->id) }}"
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
