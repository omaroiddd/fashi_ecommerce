@extends('site.master')

@section('title', 'Shop')

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.0/nouislider.css">
@endpush

@section('page', 'Shop')
@section('content')
    @include('site.layouts.breadcrumb')
    <section class="shop py-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div id="productList">
                        <div class="card mb-3">
                            <div class="shop-card">
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <div class="shop-pic ">
                                            <img src="{{ asset($product->image) }}" alt="{{ $product->title }}">
                                            <div class="shop-sale">
                                                sale
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <div class="shop-text">
                                                <h5 class="card-title">{{ $product->title }}</h5>
                                                <p class="card-text mb-2">
                                                    {{ $product->category->name }}
                                                </p>
                                                @foreach ($product->tags as $tag)
                                                    <span class="badge bg-warning text-white py-1 my-1">{{ $tag->tag_name }}
                                                    </span>
                                                @endforeach
                                                <p class="mt-2">
                                                    ${{ $product->sale_percentage }}
                                                    <span> ${{ $product->price }}</span>
                                                </p>
                                                <h6 class="mt-2 mb-3">
                                                    {{ $product->brand->name }}
                                                </h6>
                                                @if (Cart::instance('cart')->content()->where('id', $product->id)->count() > 0)
                                                    <a href="{{ route('site.cart.index') }}"
                                                        class="btn mb-3 text-capitalize">
                                                        Go to Cart
                                                    </a>
                                                @else
                                                    <form method="POST" action="{{ route('site.cart.store') }}">
                                                        @csrf
                                                        <div class="d-flex mb-4" style="gap: 10px;">
                                                            <div class="shopcart-qty">
                                                                <div class="value-button" id="decrease"
                                                                    value="Decrease Value">
                                                                    -</div>
                                                                <input type="number" id="number" value="1"
                                                                    min="1" name="stock_quantity" />
                                                                <div class="value-button" id="increase"
                                                                    value="Increase Value">
                                                                    +</div>
                                                            </div>
                                                            <input type="hidden" name="id"
                                                                value="{{ $product->id }}">
                                                            <input type="hidden" name="title"
                                                                value="{{ $product->title }}">
                                                            <input type="hidden" name="price"
                                                                value="{{ $product->sale_percentage == '' ? $product->price : $product->sale_percentage }}">
                                                            <button type="submit" class="btn">
                                                                Add to Cart
                                                            </button>
                                                        </div>
                                                    </form>
                                                @endif
                                                @if (Cart::instance('wishlist')->content()->where('id', $product->id)->count() > 0)
                                                    <a href="{{ route('site.wishlist.index') }}">
                                                        Go to WishList
                                                    </a>
                                                @else
                                                    <form method="POST" action="{{ route('site.wishlist.store') }}"
                                                        class="add-to-wishlist-form">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $product->id }}">
                                                        <input type="hidden" name="stock_quantity" value="1">
                                                        <input type="hidden" name="title" value="{{ $product->title }}">
                                                        <input type="hidden" name="price"
                                                            value="{{ $product->sale_percentage == '' ? $product->price : $product->sale_percentage }}">
                                                        <button class="wishlistBtn btn bg-transparent" type="submit"
                                                            style="color: #e7ab3c !important;">
                                                            Add to WishList
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-12">
                    <h4>
                        Related Products
                    </h4>
                </div>
                @foreach ($related_products as $product)
                    <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                        <div class="shop-card pb-2">
                            <div class="shop-pic ">
                                <img src="{{ asset($product->image) }}" alt="{{ $product->title }}">
                                <div class="shop-pic-icon">
                                    <span class="wishlistIcon">
                                        @if (Cart::instance('wishlist')->content()->where('id', $product->id)->count() > 0)
                                            <a href="{{ route('site.wishlist.index') }}">
                                                <i class="fas fa-heart" style="color: #e7ab3c"></i>
                                            </a>
                                        @else
                                            <form method="POST" action="{{ route('site.wishlist.store') }}"
                                                class="add-to-wishlist-form">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $product->id }}">
                                                <input type="hidden" name="stock_quantity" value="1">
                                                <input type="hidden" name="title" value="{{ $product->title }}">
                                                <input type="hidden" name="price"
                                                    value="{{ $product->sale_percentage == '' ? $product->price : $product->sale_percentage }}">
                                                <button class="wishlistBtn btn bg-transparent outline-0 border-0"
                                                    type="submit">
                                                    <i class="fal fa-heart" style="color: #e7ab3c; font-size: 22px;"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </span>
                                </div>
                                @if (!empty($product->sale_percentage))
                                    <div class="shop-sale">
                                        sale
                                    </div>
                                @endif
                                <ul>
                                    <li class="cartIcon">
                                        @if (Cart::instance('cart')->content()->where('id', $product->id)->count() > 0)
                                            <a href="{{ route('site.cart.index') }}">
                                                <i class="fas fa-shopping-basket  text-white"></i>
                                            </a>
                                        @else
                                            <form method="POST" action="{{ route('site.cart.store') }}"
                                                class="add-to-cart-form">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $product->id }}">
                                                <input type="hidden" name="stock_quantity" value="1">
                                                <input type="hidden" name="title" value="{{ $product->title }}">
                                                <input type="hidden" name="price"
                                                    value="{{ $product->sale_percentage == '' ? $product->price : $product->sale_percentage }}">
                                                <button class="addCart btn p-0" type="submit">
                                                    <i class="fas fa-shopping-cart text-white"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </li>
                                    <li>
                                        <a href="{{ route('site.single-product', $product->id) }}">
                                            <span>+ Quick View</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="far fa-random"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="shop-text text-center">
                                <h6>
                                    {{-- when no category show no category --}}
                                    {{ $product->category->name }}
                                </h6>
                                @foreach ($product->tags as $tag)
                                    <span class="badge bg-light text-muted py-1 my-1">{{ $tag->tag_name }}</span>
                                @endforeach
                                <a href="{{ route('site.single-product', $product->id) }}">
                                    <h5>
                                        {{ $product->title }}
                                    </h5>
                                </a>
                                <p>
                                    ${{ $product->sale_percentage }}
                                    <span> ${{ $product->price }}</span>
                                </p>
                                <h6>
                                    {{ $product->brand->name }}
                                </h6>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
@push('js')
    <script>
        $(document).on('click', '.addCart', function(e) {
            e.preventDefault();
            let button = $(this);
            let form = button.closest('.add-to-cart-form'); // Find the closest form
            let formData = form.serialize(); // Serialize form data
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '{{ route('site.cart.store') }}', // Update with your route name
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
                        button.closest('.cartIcon').html(`
                            <a href="{{ route('site.cart.index') }}">
                                <i class="fas fa-shopping-basket  text-white"></i>
                            </a>
                        `);
                    }
                },
                error: function(xhr) {
                    Toastify({
                        text: "Please, login first",
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
                    button.closest('.cartIcon').html(`
                            <form method="POST" action="{{ route('site.cart.store') }}"
                                                        class="add-to-cart-form">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $product->id }}">
                                                        <input type="hidden" name="stock_quantity" value="1">
                                                        <input type="hidden" name="title" value="{{ $product->title }}">
                                                        <input type="hidden" name="price"
                                                            value="{{ $product->sale_percentage == '' ? $product->price : $product->sale_percentage }}">
                                                        <button class="addCart btn p-0" type="submit">
                                                            <i class="fas fa-shopping-cart text-white"></i>
                                                        </button>
                                                    </form>
                    `);
                    console.error(xhr.responseText);
                }
            });
        });
    </script>

    <script>
        $(document).on('click', '.wishlistBtn', function(e) {
            e.preventDefault();
            let button = $(this);
            let form = button.closest('.add-to-wishlist-form'); // Find the closest form
            let formData = form.serialize(); // Serialize form data
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '{{ route('site.wishlist.store') }}', // Update with your route name
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
                        $('.wishlistCount').html(response
                            .wishlistCount); // update cart count in the header
                        button.closest('.wishlistIcon').html(`
                            <a href="{{ route('site.wishlist.index') }}">
                                <i class="fas fa-heart" style="color: #e7ab3c"></i>
                            </a>
                        `);
                    }
                },
                error: function(xhr) {
                    Toastify({
                        text: "Someting went wrong, Please try again !",
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
                    button.closest('.wishlistIcon').html(`
                            <form method="POST" action="{{ route('site.wishlist.store') }}"
                                                        class="add-to-wishlist-form">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $product->id }}">
                                                        <input type="hidden" name="stock_quantity" value="1">
                                                        <input type="hidden" name="title" value="{{ $product->title }}">
                                                        <input type="hidden" name="price"
                                                            value="{{ $product->sale_percentage == '' ? $product->price : $product->sale_percentage }}">
                                                        <button class="wishlist btn bg-transparent outline-0 border-0" type="submit">
                                                            <i class="fal fa-heart" style="color: #e7ab3c; font-size: 22px;"></i>
                                                        </button>
                                                    </form>
                    `);
                    console.error(xhr.responseText);
                }
            });
        });
    </script>
@endpush
