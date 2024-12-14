@extends('admin.master')

@section('title', 'Order Items')

@section('headerPage', 'Order Items')

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
                                    Order Items
                                    <a href="{{ route('admin.orders') }}" class="btn btn-danger float-end">Back</a>
                                </h4>
                            </div>
                            @if (Session::has('status'))
                                <p class="alert alert-success">{{ Session::get('status') }}</p>
                            @endif
                            @if ($transaction->order->status != 'cancelled')
                                <div class="wg-box mt-4" style="padding: 20px;">
                                    <h5>Update Order Status</h5>
                                    <form action="{{ route('admin.order.status.update') }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="order_id" value="{{ $transaction->order->id }}" />
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="select">
                                                    <select id="order_status" name="order_status" class="form-control">
                                                        <option value="ordered"
                                                            {{ $transaction->order->status == 'ordered' ? 'selected' : '' }}>
                                                            Ordered
                                                        </option>
                                                        <option value="delivered"
                                                            {{ $transaction->order->status == 'delivered' ? 'selected' : '' }}>
                                                            Delivered</option>
                                                        <option value="cancelled"
                                                            {{ $transaction->order->status == 'cancelled' ? 'selected' : '' }}>
                                                            cancelled</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <button type="submit"
                                                    class="btn btn-primary tf-button w208">Update</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            @endif
                            <div class="card-body table-responsive">
                                <table class="table table-bordered table-striped">
                                    <tr>
                                        <th>Order No</th>
                                        <td>{{ '1' . str_pad($transaction->order->id, 4, '0', STR_PAD_LEFT) }}</td>
                                        <th>Mobile</th>
                                        <td>{{ $transaction->order->phone }}</td>
                                        <th>Pin/Zip Code</th>
                                        <td>{{ $transaction->order->zip }}</td>
                                    </tr>
                                    <tr>
                                        <th>Order Date</th>
                                        <td>{{ $transaction->order->created_at }}</td>
                                        <th>Delivered Date</th>
                                        <td>{{ $transaction->order->delivery_date }}</td>
                                        <th>Cancelled Date</th>
                                        <td>{{ $transaction->order->cancelled_date }}</td>
                                    </tr>
                                    <tr>
                                        <th>Order Status</th>
                                        <td colspan="5">
                                            @if ($transaction->order->status == 'delivered')
                                                <span class="badge bg-success">Delivered</span>
                                            @elseif($transaction->order->status == 'cancelled')
                                                <span class="badge bg-danger">Cancelled</span>
                                            @else
                                                <span class="badge bg-warning">Ordered</span>
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="wg-box mt-5">
                    <div class="flex items-center justify-between gap10 flex-wrap">
                        <div class="wg-filter flex-grow">
                            <h5>Ordered Items</h5>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Price</th>
                                    <th class="text-center">Quantity</th>
                                    <th class="text-center">Category</th>
                                    <th class="text-center">Brand</th>
                                    <th class="text-center">Return Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orderitems as $orderitem)
                                    <tr>

                                        <td class="pname">
                                            <div class="d-flex align-items-center flex-wrap" style="gap: 10px;">
                                                <div>
                                                    <img src="/{{ $orderitem->product->image }}"
                                                        alt="{{ $orderitem->product->title }}" class="image"
                                                        width="50px" height="50px">
                                                </div>
                                                <p class="mb-0">
                                                    {{ $orderitem->product->title }}
                                                </p>
                                            </div>

                                        </td>
                                        <td class="text-center">${{ $orderitem->price }}</td>
                                        <td class="text-center">{{ $orderitem->quantity }}</td>
                                        <td class="text-center">{{ $orderitem->product->category->name }}</td>
                                        <td class="text-center">{{ $orderitem->product->brand->name }}</td>
                                        <td class="text-center">{{ $orderitem->rstatus == 0 ? 'No' : 'Yes' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-12">
                        {{ $orderitems->links('pagination::bootstrap-5') }}
                    </div>
                </div>
                <div class="wg-box mt-5 p-5 shadow rounded bg-white">
                    <h5>Shipping Address</h5>
                    <div class="my-account__address-item col-md-6">
                        <div class="my-account__address-item__detail">
                            <p>{{ $transaction->order->name }}</p>
                            <p>{{ $transaction->order->address }}</p>
                            <p>{{ $transaction->order->locality }}</p>
                            <p>{{ $transaction->order->city }}, {{ $transaction->order->country }}</p>
                            <p>{{ $transaction->order->landmark }}</p>
                            <p>{{ $transaction->order->zip }}</p>
                            <p>Mobile : {{ $transaction->order->phone }}</p>
                        </div>
                    </div>
                </div>

                <div class="wg-box mt-5">
                    <h5>Transactions</h5>
                    <table class="table table-striped table-bordered table-transaction">
                        <tr>
                            <th>Subtotal</th>
                            <td>${{ $transaction->order->sub_total }}</td>
                            <th>Tax</th>
                            <td>${{ $transaction->order->tax }}</td>
                            <th>Discount</th>
                            <td>${{ $transaction->order->discount }}</td>
                        </tr>
                        <tr>
                            <th>Total</th>
                            <td>${{ $transaction->order->total }}</td>
                            <th>Payment Mode</th>
                            <td>{{ $transaction->mode }}</td>
                            <th>Status</th>
                            <td>
                                @if ($transaction->status == 'approved')
                                    <span class="badge bg-success">Approved</span>
                                @elseif($transaction->status == 'declined')
                                    <span class="badge bg-danger">Declined</span>
                                @elseif($transaction->status == 'refunded')
                                    <span class="badge bg-secondary">Refunded</span>
                                @else
                                    <span class="badge bg-warning">Pending</span>
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="wg-box mt-3 pb-5">
                    <form action="{{ route('admin.account_cancel_order') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="order_id" value="{{ $order->id }}" />
                        <button type="submit" class="btn btn-danger">Cancel Order</button>
                    </form>
                </div>
        </section>
        <!-- /.content -->
    </div>
@endsection
