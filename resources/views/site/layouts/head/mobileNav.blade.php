@php
    use App\Models\Category;
    $categories = Category::all();
@endphp
<!-- start navbar that displayed in responsive mood -->
<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="navbar-brand" href="{{ route('site.home') }}">
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
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span>MENU</span>
            <span>
                <i class="fal fa-bars"></i>
            </span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item @if (request()->is('home*') || request()->is('/')) active @endif">
                    <a class="nav-link" href="{{ route('site.home') }}">Home<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item @if (request()->is('shop*')) active @endif">
                    <a class="nav-link" href="{{ route('site.shop') }}">Shop</a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link" href="#">
                        All Department
                        <div class='fa fa-caret-right right'></div>
                    </a>
                    <ul>
                        <li>
                            <a href="#" class="active nav-link1">
                                T-shirts
                            </a>
                        </li>
                        <li>
                            <a href="#" class="nav-link1">
                                Shoes
                            </a>
                        </li>
                        <li>
                            <a href="#" class="nav-link1">
                                Shirts
                            </a>
                        </li>
                        <li>
                            <a href="#" class="nav-link1">
                                Bags
                            </a>
                        </li>
                        <li>
                            <a href="#" class="nav-link1">
                                Dresses
                            </a>
                        </li>
                    </ul>
                </li> --}}
                <li class="nav-item @if (request()->is('category*')) active @endif">
                    <a class="nav-link" href="#">
                        Collection
                        <div class='fa fa-caret-right right'></div>
                    </a>
                    <ul>
                        @foreach ($categories as $category)
                            <li>
                                <a href="{{ route('site.category.show', $category->name) }}">
                                    {{ $category->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
                <li class="nav-item @if (request()->is('contact*')) active @endif">
                    <a class="nav-link" href="{{ route('site.contact') }}">Contact</a>
                </li>
                @auth
                    <li class="nav-item @if (request()->is('checkout*')) active @endif">
                        <a class="nav-link" href="">CheckOut</a>
                    </li>
                @endauth
                @if (Auth::check() && Auth::user()->hasRole(['super-admin', 'admin']))
                    <li class="nav-item1 ">
                        <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </li>
                @endif
            </ul>
        </div>
    </nav>
</div>
<!-- end navbar that displayed in responsive mood -->
