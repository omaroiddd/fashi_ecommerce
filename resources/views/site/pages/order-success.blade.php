@extends('site.master')

@section('title', 'Success')

@section('sub_page', 'Success')

@section('content')

    @include('site.layouts.breadcrumb_inside')

    <!-- start section for confirmation order page -->
    <section class="checkorder py-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="checkorder__content p-5 shadow">
                        <h2>Thank you. Your order has been received.</h2>
                        <p>
                            Your order number is: <strong>{{ $order->id }}</strong>
                        </p>
                        <p>
                            You will receive an email confirmation shortly.
                        </p>
                        <p>
                            <span>Order Created Date: </span>
                            <span>{{ $order->created_at }}</span>
                        </p>
                        <p>
                            <span>Payment Method: </span>
                            <span>
                                {{ $order->transaction->mode }}
                            </span>
                        </p>
                        <p>
                            {{ $order->transaction->transaction_id }}
                        </p>
                        <p>
                            <span>Transaction Status: </span>
                            <span>
                                {{ $order->transaction->status }}
                            </span>
                        </p>
                        <p class="text-center">
                            <a href="{{ route('site.home') }}" class="btn btn-primary">Back to Home</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
