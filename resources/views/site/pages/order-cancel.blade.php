@extends('site.master')

@section('title', 'Cancel Order')

@section('sub_page', 'Cancel Order')

@section('content')

    @include('site.layouts.breadcrumb_inside')

    <!-- start section for confirmation order page -->
    <section class="checkorder py-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="checkorder__content p-5 shadow">
                        <h2>Order Cancelled</h2>
                        <p>
                            <a href="{{ route('site.home') }}" class="btn btn-primary">Back to Home</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
