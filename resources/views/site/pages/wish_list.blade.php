@extends('site.master')

@section('title', 'WishList')

@section('sub_page', 'WishList')

@section('content')

    @include('site.layouts.breadcrumb_inside')
    @if (Cart::instance('wishlist')->content()->count() > 0)
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
                                        <th>Action</th>
                                        <th><i class="fal fa-times"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (Cart::instance('wishlist')->content() as $wishlistItem)
                                        <tr class="wishlist-item">
                                            <td>
                                                <img src="{{ asset($wishlistItem->model->image) }}"
                                                    alt="{{ $wishlistItem->name }}" width="120px" height="120px">
                                            </td>
                                            <td>
                                                <h5>
                                                    {{ $wishlistItem->name }}
                                                </h5>
                                            </td>
                                            <td>
                                                <span>${{ $wishlistItem->price }}</span>
                                            </td>
                                            <td class="addTocart_container">
                                                <form method="POST" class="move-to-cart border-0"
                                                    action="{{ route('site.wishlist.move.to.cart', ['rowId' => $wishlistItem->rowId]) }}">
                                                    @csrf
                                                    <button type="submit" class="move-cart btn btn-sm btn-warning">
                                                        Move to Cart
                                                    </button>
                                                </form>
                                            </td>
                                            <td>
                                                <form class="wishlist-remove-item-form" style="width: auto; border: unset;"
                                                    method="POST"
                                                    action="{{ route('site.wishlist.item.remove', ['rowId' => $wishlistItem->rowId]) }}">
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
                    <div class="col-md-12">
                        <div class="cartbuttons d-flex">
                            <a href="{{ route('site.shop') }}" class="btn2 text-capitalize">
                                continue shopping
                            </a>
                            <form method="POST" action="{{ route('site.whislist.destroy') }}" class="clearwishlistForm">
                                @csrf
                                @method('DELETE')
                                <button class="btn3 text-capitalize clearwishlistBtn" type="submit">
                                    Clear wishlist
                                </button>
                            </form>
                        </div>
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
                                Your WishList is Empty
                            </h2>
                            <p>
                                No item found in your wishlist.
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
        $(document).ready(function() {
            $('.clearwishlistBtn').click(function() {
                if (confirm('Are you sure you want to clear the cart?')) {
                    $.ajax({
                        url: $('.clearwishlistForm').attr('action'), // Get form action URL
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
                                    text: 'Failed to clear the wishlist.',
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
                                text: 'An error occurred while clearing the wishlist.',
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
        $(document).on('submit', '.wishlist-remove-item-form', function(e) {
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
                        form.closest('.wishlist-item')
                            .remove(); // Assuming '.wishlist-item' is the wrapper for the product in the cart
                        $('.wishlistCount').html(response.count);
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

    <script>
        $(document).on('click', '.move-cart', function(e) {
            e.preventDefault();
            let button = $(this);
            let form = button.closest('.move-to-cart'); // Find the closest form
            let formData = form.serialize(); // Serialize form data
            var url = form.attr('action'); // Get the form action URL
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: url, // Update with your route name
                type: 'POST',
                data: formData,
                success: function(response) {
                    if (response.status === 'success') {
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
                        }).showToast();
                        $('.cartCount').html(response.cartCount); // update cart count in the header
                        button.closest('.addTocart_container').html(`
                            <a href="{{ route('site.cart.index') }}" class="btn">
                                Go To Cart
                            </a>
                        `);
                    }
                },
                error: function(xhr) {
                    Toastify({
                        text: "Please, login First",
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
                    console.error(xhr.responseText);
                }
            });
        });
    </script>
@endpush
