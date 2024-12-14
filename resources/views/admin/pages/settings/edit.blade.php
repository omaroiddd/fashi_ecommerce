@extends('admin.master')

@section('title', 'Settings')

@section('headerPage', 'Settings')

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
                                <h4>Edit Settings
                                    <a href="{{ route('admin.social.index') }}" class="btn btn-danger float-end">Back</a>
                                </h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.social.update', $social->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="">Email</label>
                                        <input type="email" name="email" class="form-control" value = {{$social->email}}>
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Phone</label>
                                        <input type="text" name="phone" class="form-control" value = {{$social->phone}}>
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Address</label>
                                        <input type="text" name="address" class="form-control" value = {{$social->address}}>
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Facebook URL</label>
                                        <input type="text" name="facebook" class="form-control" value = {{$social->facebook}}>
                                        @error('facebook')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Twitter URL</label>
                                        <input type="text" name="twitter" class="form-control" value = {{$social->twitter}}>
                                        @error('twitter')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Instagram URL</label>
                                        <input type="text" name="instagram" class="form-control" value = {{$social->instagram}}>
                                        @error('instagram')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Youtube URL</label>
                                        <input type="text" name="youtube" class="form-control" value = {{$social->youtube}}>
                                        @error('youtube')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
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
