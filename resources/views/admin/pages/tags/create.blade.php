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
                        <div class="card">
                            <div class="card-header">
                                <h4>Create Tag
                                    <a href="{{ route('admin.tags.index') }}" class="btn btn-danger float-end">Back</a>
                                </h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.tags.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <div class="mb-3">
                                        <label for="">Tag Name</label>
                                        <input type="text" name="tag_name" class="form-control" />
                                        @error('tag_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
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
