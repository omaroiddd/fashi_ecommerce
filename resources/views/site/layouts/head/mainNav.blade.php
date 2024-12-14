@php
    use App\Models\Category;
    $categories = Category::all();
@endphp
<!-- start navbar -->
<nav class="nav1">
    <div class="container">
        <ul class="navList m-auto">
            {{-- <div class="depart">
                        <i class="far fa-bars"></i>
                        <span>All Department</span>
                        <i class="fal fa-angle-down"></i>
                        <ul class="departDown">
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
                    </div> --}}
            <li class="nav-item1 @if (request()->is('home*') || request()->is('/')) active1 @endif">
                <a class="nav-link" href="{{ route('site.home') }}">HOME <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item1 @if (request()->is('shop*')) active1 @endif">
                <a class="nav-link" href="{{ route('site.shop') }}">SHOP</a>
            </li>
            <li class="nav-item1 @if (request()->is('category*')) active1 @endif">
                <a class="nav-link" href="#">COLLECTION</a>
                <ul class="collList">
                    @foreach ($categories as $category)
                        <li class="nav-item1">
                            <a href="{{ route('site.category.show', $category->name) }}">
                                {{ $category->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </li>
            <li class="nav-item1 @if (request()->is('contact*')) active1 @endif">
                <a class="nav-link" href="{{ route('site.contact') }}">CONTACT</a>
            </li>
            @auth
                <li class="nav-item1 @if (request()->is('checkout*')) active1 @endif">
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
<!-- start navbar -->
