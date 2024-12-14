@extends('admin.master')

@section('title', 'Orders')

@section('headerPage', 'Orders')

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
                                <h4>
                                    Orders
                                </h4>
                            </div>
                            <div class="card-body table-responsive">

                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Order No</th>
                                            <th class="text-center">Name</th>
                                            <th class="text-center">Phone</th>
                                            <th class="text-center">Subtotal</th>
                                            <th class="text-center">Tax</th>
                                            <th class="text-center">Total</th>
                                            <th class="text-center" style="width:260px;">Address</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Order Date</th>
                                            <th class="text-center">Total Items</th>
                                            <th class="text-center">Delivered On</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                            <tr>
                                                <td class="text-center">
                                                    {{ '1' . str_pad($order->id, 4, '0', STR_PAD_LEFT) }}
                                                </td>
                                                <td class="text-center">{{ $order->name }}</td>
                                                <td class="text-center">{{ $order->phone }}</td>
                                                <td class="text-center">${{ $order->sub_total }}</td>
                                                <td class="text-center">${{ $order->tax }}</td>
                                                <td class="text-center">${{ $order->total }}</td>
                                                <td class="text-center">
                                                    <p>{{ $order->city }}, {{ $order->state }}, {{ $order->zip }}</p>
                                                </td>
                                                <td class="text-center">
                                                    @if ($order->status == 'delivered')
                                                        <span class="badge bg-success">Delivered</span>
                                                    @elseif($order->status == 'cancelled')
                                                        <span class="badge bg-danger">Cancelled</span>
                                                    @else
                                                        <span class="badge bg-warning">Ordered</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">{{ $order->created_at }}</td>
                                                <td class="text-center">{{ $order->orderItems->count() }}</td>
                                                <td class="text-center">{{ $order->delivery_date }}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('admin.order.items', ['order_id' => $order->id]) }}">
                                                        <div class="list-icon-function view-icon">
                                                            <div class="item eye">
                                                                <i class="fas fa-eye"></i>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        {{ $orders->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
@endsection
