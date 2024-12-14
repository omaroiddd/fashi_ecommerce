<!-- start div that contain the logo and text input -->
<div class="lowHead">
    <div class="container">
        <div class="row">
            <div class="col-lg-2 col-md-2">
                <a href="{{ route('site.home') }}">
                    <img src="{{ asset('site/img/logo.png') }}">
                </a>
            </div>
            <div class="col-lg-7 col-md-7">
                <div class="row">
                    <div class="col-lg-4 col-md-5">
                        <div class="cate">
                            <span class="text-left">
                                Find Your Product
                            </span>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-7 col-sm-12 col-12">
                        <div class="input-group" style="position: relative;">
                            <input type="text" class="form-control" id="global-search"
                                placeholder="What do you need?">
                            <div class="input-group-append">
                                <button class="btn" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                        <!-- Dropdown for search results -->
                        <div class="search-results" id="global-search-results" style="display:none;"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 text-center p-2">
                <div class="shopping">
                    <a class="btn1 viewCard text-dark" href="{{ route('site.wishlist.index') }}">
                        <i class="fal fa-heart ml-3">
                            <span class="one wishlistCount">
                                {{ Cart::instance('wishlist')->content()->count() }}
                            </span>
                        </i>
                    </a>
                    @auth
                        <a class="btn1 viewCard text-dark" href="{{ route('site.cart.index') }}">
                            <i class="fal fa-shopping-bag ml-3 mr-3">
                                <span class="one cartCount">
                                    {{ Cart::instance('cart')->content()->count() }}
                                </span>
                            </i>
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end dic that contain the logo and text input -->
