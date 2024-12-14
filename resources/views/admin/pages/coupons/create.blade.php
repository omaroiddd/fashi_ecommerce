@extends('admin.master')

@section('title', 'Coupons')

@section('headerPage', 'Coupons')

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
                                <h4>Create Coupon
                                    <a href="{{ route('admin.coupons.index') }}" class="btn btn-danger float-end">Back</a>
                                </h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.coupons.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="">Coupon Code</label>
                                        <input type="text" name="code" class="form-control" value = {{old('code')}}>
                                        @error('code')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Coupon Type</label>
                                        <select name="type" class="form-control">
                                            <option value="">Select Type</option>
                                            <option value="fixed">Fixed</option>
                                            <option value="percent">Percent</option>
                                        </select>
                                        @error('type')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Value</label>
                                        <input type="text" name="value" class="form-control" value = {{old('value')}}>
                                        @error('value')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Cart Value</label>
                                        <input type="text" name="cart_value" class="form-control" value = {{old('cart_value')}}>
                                        @error('cart_value')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Expire Date</label>
                                        <input type="date" name="expire_date" class="form-control" value = {{old('expire_date')}}>
                                        @error('expire_date')
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
