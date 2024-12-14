@extends('site.master')

@section('title', 'Shopping Cart')

@section('sub_page', 'Shopping Cart')

@section('content')

    @include('site.layouts.breadcrumb_inside')
    @if ($items->count() > 0)
        <section class="shopcart fullCart py-5">
            <div class="container">
                @include('inc.success')
                <div class="row">
                    <div class="col-lg-12">
                        <div class="carttable">
                            <table>
                                <thead class="text-uppercase">
                                    <tr>
                                        <th>image</th>
                                        <th>product name</th>
                                        <th>price</th>
                                        <th>quantity</th>
                                        <th>total</th>
                                        <th><i class="fal fa-times"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($items as $item)
                                        <tr class="cart-item">
                                            <td>
                                                <img src="{{ asset($item->model->image) }}" alt="{{ $item->name }}"
                                                    width="120px" height="120px">
                                            </td>
                                            <td>
                                                <h5>
                                                    {{ $item->name }}
                                                </h5>
                                            </td>
                                            <td>
                                                <span>${{ $item->price }}</span>
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-center align-items-center">
                                                    <form style="width: auto; margin: unset;" method="POST"
                                                        action="{{ route('site.cart.qty.decrease', ['rowId' => $item->rowId]) }}">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="value-button decreaseQty" id="decrease"
                                                            value="Decrease Value">-
                                                        </div>
                                                    </form>
                                                    <input type="number" id="number" value="{{ $item->qty }}"
                                                        min="1" name="stock_quantity" />
                                                    <form style="width: auto; margin: unset;" method="POST"
                                                        action="{{ route('site.cart.qty.increase', ['rowId' => $item->rowId]) }}">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="value-button increaseQty" id="increase"
                                                            value="Increase Value">+
                                                        </div>
                                                    </form>
                                                </div>
                                            </td>
                                            <td>
                                                <span>${{ $item->subtotal() }}</span>
                                            </td>
                                            <td>
                                                <form class="remove-item-form" style="width: auto; border: unset;"
                                                    method="POST"
                                                    action="{{ route('site.cart.item.remove', ['rowId' => $item->rowId]) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger bg-danger">
                                                        <i class="fal fa-times px-3"></i>
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
                <div class="row py-5">
                    <div class="col-lg-4 col-md-12">
                        <div class="cartbuttons d-flex">
                            <a href="{{ route('site.shop') }}" class="btn2 text-capitalize">
                                continue shopping
                            </a>
                            <form method="POST" action="{{ route('site.cart.destroy') }}" class="clearCartForm">
                                @csrf
                                @method('DELETE')
                                <button class="btn3 text-capitalize clearCartBtn" type="submit">
                                    clear cart
                                </button>
                            </form>
                        </div>
                        <div class="discount">
                            @if (!Session::has('coupon'))
                                <h6>
                                    discount codes
                                </h6>
                                <form method="POST" action="{{ route('site.cart.coupon.apply') }}">
                                    @csrf
                                    <input type="text" placeholder="Enter Your Codes" name="coupon_code">
                                    <button type="submit" class="discountbtn">
                                        APPLY
                                    </button>
                                </form>
                            @else
                                <form class="position-relative bg-body" method="POST"
                                    action="{{ route('site.cart.coupon.remove') }}">
                                    @csrf
                                    @method('DELETE')
                                    <input type="text" name="coupon_code" placeholder="Enter Your Codes"
                                        value="{{ session()->get('coupon')['code'] }} Applied!" readonly>
                                    <button type="submit" class="discountbtn">
                                        REMOVE COUPON
                                    </button>
                                </form>
                            @endif
                            @if (Session::has('error'))
                                <p class="text-danger">
                                    {{ Session::get('error') }}
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-4 offset-lg-4 col-md-12">
                        @if (Session::has('discounts'))
                            <div class="carttotal">
                                <ul>
                                    <li>
                                        Subtotal
                                        <span id="subtotal">
                                            ${{ Cart::instance('cart')->subtotal() }}
                                        </span>
                                    </li>
                                    <li>
                                        Discount {{ Session('coupon')['code'] }}
                                        <span id="discount">
                                            ${{ Session('discounts')['discount'] }}
                                        </span>
                                    </li>
                                    <li>
                                        Subtotal After Discount
                                        <span id="subAfterDiscount">
                                            ${{ Session('discounts')['subtotal'] }}
                                        </span>
                                    </li>
                                    <li>
                                        VAT
                                        <span id="vat">
                                            ${{ Session('discounts')['tax'] }}
                                        </span>
                                    </li>
                                    <li>
                                        Total
                                        <span id="total">
                                            ${{ Session('discounts')['total'] }}
                                        </span>
                                    </li>
                                </ul>
                                <a href="{{route('site.cart.checkout')}}" class="proceed-btn">PROCEED TO CHECK OUT</a>
                            </div>
                        @else
                            <div class="carttotal">
                                <ul>
                                    <li>
                                        Subtotal
                                        <span id="subtotal">
                                            ${{ Cart::instance('cart')->subtotal() }}
                                        </span>
                                    </li>
                                    <li>
                                        VAT
                                        <span id="vat">
                                            ${{ Cart::instance('cart')->tax() }}
                                        </span>
                                    </li>
                                    <li>
                                        Total
                                        <span id="total">
                                            ${{ Cart::instance('cart')->total() }}
                                        </span>
                                    </li>
                                </ul>
                                <a href="{{route('site.cart.checkout')}}" class="proceed-btn">PROCEED TO CHECK OUT</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    @else
        <div class="emptyCart">
            <div class="container">
                <div class="row py-5">
                    <div class="col-lg-12 col-md-12">
                        <div class="cartbox text-center">
                            <h2>
                                Your Cart is Empty
                            </h2>
                            <p>
                                You have no items in your shopping cart.
                            </p>
                            <a href="{{ route('site.shop') }}" class="btn">Shop Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

@push('js')
    <script>
        $(function() {
            $('.decreaseQty').click(function() {
                $(this).closest('form').submit();
            });

            $('.increaseQty').click(function() {
                $(this).closest('form').submit();
            });
        })
    </script>

    <script>
        $(document).ready(function() {
            $('.clearCartBtn').click(function() {
                if (confirm('Are you sure you want to clear the cart?')) {
                    $.ajax({
                        url: $('.clearCartForm').attr('action'), // Get form action URL
                        type: 'POST', // Use POST method
                        data: {
                            _method: 'DELETE', // Override the form method with DELETE
                            _token: $('meta[name="csrf-token"]').attr('content') // CSRF token
                        },
                        success: function(response) {
                            if (response.status === 'success') {
                                location.reload(); // Reload the page after clearing the cart
                            } else {
                                Toastify({
                                    text: 'Failed to clear the cart.',
                                    className: "success",
                                    duration: 3000,
                                    newWindow: true,
                                    close: true,
                                    gravity: "top", // `top` or `bottom`
                                    position: "left", // `left`, `center` or `right`
                                    stopOnFocus: true, // Prevents dismissing of toast on hover
                                    style: {
                                        background: "#dc3741",
                                    },
                                    onClick: function() {} // Callback after click
                                }).showToast();
                            }
                        },
                        error: function(xhr, status, error) {
                            Toastify({
                                text: 'An error occurred while clearing the cart.',
                                className: "success",
                                duration: 3000,
                                newWindow: true,
                                close: true,
                                gravity: "top", // `top` or `bottom`
                                position: "left", // `left`, `center` or `right`
                                stopOnFocus: true, // Prevents dismissing of toast on hover
                                style: {
                                    background: "#dc3741",
                                },
                                onClick: function() {} // Callback after click
                            }).showToast();
                        }
                    });
                }
            });
        });
    </script>

    <script>
        // jQuery to handle the form submission via AJAX
        $(document).on('submit', '.remove-item-form', function(e) {
            e.preventDefault(); // Prevent normal form submission

            var form = $(this); // Get the form
            var url = form.attr('action'); // Get the form action URL

            // Send AJAX request to remove item from the cart
            $.ajax({
                url: url,
                type: 'POST',
                data: form.serialize(), // Serialize the form data
                success: function(response) {
                    // If the request is successful, handle the response
                    if (response.status === 'success') {
                        // You can remove the item from the DOM, update the cart count, etc.
                        form.closest('.cart-item')
                            .remove(); // Assuming '.cart-item' is the wrapper for the product in the cart
                        $('#subtotal').text('$' + response.subtotal);
                        $('#vat').text('$' + response.tax);
                        $('#total').text('$' + response.total);
                        $('.cartCount').html(response.count);
                        if (response.discount > 0) {
                            $('#discount').text('$' + response.discount);
                            $('#subAfterDiscount').text('$' + response.subtotalAfterDiscount);
                            var total = response.subtotalAfterDiscount + response.tax;
                            $('#total').text('$' + total);
                        } else {
                            // Hide discount and subtotal after discount if not applicable
                            $('#discount').parent().hide();
                            $('#subAfterDiscount').parent().hide();
                        }
                        if (response.isEmpty) {
                            location.reload(); // Reload the page after clearing the cart
                        }
                        Toastify({
                            text: response.message,
                            className: "success",
                            duration: 3000,
                            newWindow: true,
                            close: true,
                            gravity: "top", // `top` or `bottom`
                            position: "left", // `left`, `center` or `right`
                            stopOnFocus: true, // Prevents dismissing of toast on hover
                            style: {
                                background: "linear-gradient(to right, #00b09b, #96c93d)",
                            },
                            onClick: function() {} // Callback after click
                        }).showToast(); // Show the success message

                    }
                },
                error: function(xhr, status, error) {
                    // Handle error if something goes wrong
                    Toastify({
                        text: 'Error removing item from cart.',
                        className: "error",
                        duration: 3000,
                        newWindow: true,
                        close: true,
                        gravity: "top", // `top` or `bottom`
                        position: "left", // `left`, `center` or `right`
                        stopOnFocus: true, // Prevents dismissing of toast on hover
                        style: {
                            background: "#dc3741",
                        },
                        onClick: function() {} // Callback after click
                    }).showToast();
                }
            });
        });
    </script>
@endpush