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
                <div class="col-lg-3 col-md-6 order-2 order-lg-1 pt-3">
                    <div class="blog-category">
                        <h4>All Categories</h4>
                        <div class="category-item brand-item">
                            @foreach ($categories as $category)
                                <div class="item">
                                    <label for="category-{{ $category->id }}">
                                        {{ $category->name }} ({{ $category->products ? $category->products->count() : 0 }})
                                        <input type="checkbox" class="category-filter" value="{{ $category->id }}"
                                            id="category-{{ $category->id }}">
                                        <span></span>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="shop-brand">
                        <h4>Brand</h4>
                        <div class="brand-item">
                            @foreach ($brands as $brand)
                                <div class="item">
                                    <label for="brand-{{ $brand->id }}">
                                        {{ $brand->name }} ({{ $brand->products ? $brand->products->count() : 0 }})
                                        <input type="checkbox" class="brand-filter" value="{{ $brand->id }}"
                                            id="brand-{{ $brand->id }}">
                                        <span></span>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    {{-- <div class="shop-price">
                        <h4>
                            price
                        </h4>
                        <!-- start code of price range slider -->
                        <div class="filter">
                            <div class="filter__label">
                                <input type="text" class="filter__input">
                                <input type="text" class="filter__input">
                            </div>
                            <div id="sliderPrice" class="filter__slider-price" data-min="33" data-max="98" data-step="1">
                            </div>
                        </div>
                        <!-- end code of price range slider -->
                        <div class="price-btn">
                            <button class="btn">filter</button>
                        </div>
                    </div> --}}
                    <div class="shop-price">
                        <h4>price</h4>
                        <div class="filter">
                            <div class="filter__label">
                                <input type="text" class="filter__input min-price" readonly>
                                <input type="text" class="filter__input max-price" readonly>
                            </div>
                            <div id="sliderPrice" class="filter__slider-price" data-min="0" data-max="1000"
                                data-step="1">
                            </div>
                        </div>
                        <div class="price-btn">
                            <button class="btn price-filter-btn">Filter</button>
                        </div>
                    </div>
                    <div class="blog-category">
                        <h4>All Sizes</h4>
                        <div class="category-item brand-item">
                            @foreach ($sizes as $size)
                                <div class="item">
                                    <label for="size-{{ $size->name }}">
                                        {{ $size->name }} ({{ $size->products ? $size->products->count() : 0 }})
                                        <input type="checkbox" class="size-filter" value="{{ $size->id }}"
                                            id="size-{{ $size->name }}">
                                        <span></span>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="blog-tags">
                        <h4>
                            product tags
                        </h4>
                        @foreach ($tags as $tag)
                            <a href="#" class="tag-link" data-value="{{ $tag->tag_name }}">{{ $tag->tag_name }}</a>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-9 col-md-12 order-1 order-lg-2">
                    <div class="row" id="productList">
                        @foreach ($products as $product)
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
                                                            <i class="fal fa-heart"
                                                                style="color: #e7ab3c; font-size: 22px;"></i>
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
                                        <br>
                                        @foreach ($product->sizes as $size)
                                            <span class="badge bg-light text-dark py-1 my-1">{{ $size->name }}</span>
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
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="paginationBox">
                                {{ $products->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.0/nouislider.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const slider = document.getElementById('sliderPrice');

            // Check if slider is already initialized
            if (slider.noUiSlider) {
                slider.noUiSlider.destroy(); // Destroy existing slider instance
            }

            noUiSlider.create(slider, {
                start: [0, 1000],
                connect: true,
                range: {
                    'min': 0,
                    'max': 1000
                },
                step: 1
            });

            slider.noUiSlider.on('update', function(values, handle) {
                if (handle === 0) {
                    document.querySelector('.filter__input.min-price').value = Math.round(values[0]);
                } else {
                    document.querySelector('.filter__input.max-price').value = Math.round(values[1]);
                }
            });

            // Function to render products
            function renderProducts(products) {
                const productList = document.getElementById('productList');
                let html = '';
                products.data.forEach(product => {
                    html += `
                        <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                            <div class="shop-card pb-2">
                                <div class="shop-pic">
                                    <img src="${product.image}" alt="${product.title}">
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
                                                            <i class="fal fa-heart"
                                                                style="color: #e7ab3c; font-size: 22px;"></i>
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
                                    <h6>${product.category ? product.category.name : 'No Category'}</h6>
                                    <span class="badge bg-light text-muted py-1 my-1">${product.tags ? product.tags.map(tag => tag.tag_name).join(' ') : 'No Tags'}</span>
                                    <br>
                                    <span class="badge bg-light text-dark py-1 my-1">${product.sizes ? product.sizes.map(size => size.name).join(' ') : 'No Sizes'}</span>
                                    <a href="{{ route('site.single-product', $product->id) }}">
                                        <h5>${product.title}</h5>
                                    </a>
                                    <p>
                                        $${product.sale_percentage}
                                        <span>$${product.price}</span>
                                    </p>
                                    <h6>${product.brand ? product.brand.name : 'No Brands'}</h6>
                                </div>
                            </div>
                        </div>`;
                });

                productList.innerHTML = html;
            }

            // Function to fetch filtered products
            function fetchFilteredProducts(selectedTag = null) {
                let categories = [];
                let sizes = [];
                let brands = [];
                let priceRange = {};

                // Collect selected categories
                document.querySelectorAll('.category-filter:checked').forEach(function(category) {
                    categories.push(category.value);
                });

                document.querySelectorAll('.size-filter:checked').forEach(function(size) {
                    sizes.push(size.value);
                });

                // Collect selected brands
                document.querySelectorAll('.brand-filter:checked').forEach(function(brand) {
                    brands.push(brand.value);
                });


                // Collect price range
                const minPrice = document.querySelector('.filter__input.min-price').value;
                const maxPrice = document.querySelector('.filter__input.max-price').value;

                if (minPrice && maxPrice) {
                    priceRange = {
                        min: parseFloat(minPrice),
                        max: parseFloat(maxPrice)
                    };
                }

                // Create the request body
                const requestBody = {
                    categories: categories,
                    sizes: sizes,
                    brands: brands,
                    price_range: priceRange
                };

                // Add tag to request body if selected
                if (selectedTag) {
                    requestBody.tag = selectedTag;
                }

                // AJAX request
                fetch('{{ route('site.filter') }}', { // Update this URL to match your route
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify(requestBody)
                    })
                    .then(response => response.json())
                    .then(data => {
                        renderProducts(data);
                    })
                    .catch(error => console.error('Error:', error));
            }

            // Event listener for category filter
            document.querySelectorAll('.category-filter').forEach(function(categoryFilter) {
                categoryFilter.addEventListener('change', function() {
                    fetchFilteredProducts();
                });
            });

            document.querySelectorAll('.size-filter').forEach(function(sizeFilter) {
                sizeFilter.addEventListener('change', function() {
                    fetchFilteredProducts();
                });
            });

            // Event listener for brand filter
            document.querySelectorAll('.brand-filter').forEach(function(brandFilter) {
                brandFilter.addEventListener('change', function() {
                    fetchFilteredProducts();
                });
            });

            document.querySelector('.price-filter-btn').addEventListener('click', function() {
                fetchFilteredProducts();
            });


            // Event listener for tag links
            document.querySelectorAll('.tag-link').forEach(function(tagLink) {
                tagLink.addEventListener('click', function(e) {
                    e.preventDefault();

                    // Remove active class from all tags
                    document.querySelectorAll('.tag-link').forEach(link => {
                        link.classList.remove('active');
                    });

                    // Add active class to clicked tag
                    this.classList.add('active');

                    const tagValue = this.getAttribute('data-value');
                    fetchFilteredProducts(tagValue);
                });
            });

        });
    </script>

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
