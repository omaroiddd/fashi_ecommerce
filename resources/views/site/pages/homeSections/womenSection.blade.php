<!-- start section of women products -->
<section class="women">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-12">
                <div class="women-pic">
                    <div class="women-pic-text">
                        <h2>
                            women's
                        </h2>
                        <a href="{{ route('site.shop') }}">discover me</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 offset-lg-1 col-md-12">
                <div class="owl-carousel owl-theme" id="demo-women">
                    @foreach ($productsWomen as $product)
                        <div class="item">
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
        </div>
    </div>
</section>
<!-- end section of women products -->
