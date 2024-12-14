@extends('admin.master')

@section('title', 'Coupons')

@section('headerPage', 'Coupons')

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
                                    Coupons
                                    <a href="{{ route('admin.coupons.create') }}" class="btn btn-primary float-end">
                                        Add Coupon
                                    </a>
                                </h4>
                            </div>
                            <div class="card-body table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Code</th>
                                            <th>Type</th>
                                            <th>Value</th>
                                            <th>Cart Value</th>
                                            <th>Expire Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($coupons as $coupon)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $coupon->code }}</td>
                                                <td>{{ $coupon->type }}</td>
                                                <td>{{ $coupon->value }}</td>
                                                <td>${{ $coupon->cart_value }}</td>
                                                <td>{{ $coupon->expire_date }}</td>
                                                <td>
                                                    <a href="{{ route('admin.coupons.edit', $coupon->id) }}"
                                                        class="btn text-success">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <!-- <a href=""
                                                                class="btn btn-danger mx-2">Delete</a> -->
                                                    <form action="{{ route('admin.coupons.destroy', $coupon->id) }}"
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
                    <div class="col-12">
                        {{ $coupons->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
@endsection
