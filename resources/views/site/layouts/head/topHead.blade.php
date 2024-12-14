<!--start tophead with language and login -->
<div class="topHead topHead0">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3 p-3  border-right">
                <div class="fashiMail">
                    <i class="fas fa-envelope"></i>
                    <span>
                        hello.test@gmail.com
                    </span>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 p-3">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="fashiPhone">
                            <i class="fas fa-phone-alt"></i>
                            <span>
                                +65 11.188.888
                            </span>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="fashiIcons text-right">
                            <i class="fab fa-facebook-f"></i>
                            <i class="fab fa-twitter"></i>
                            <i class="fab fa-linkedin-in"></i>
                            <i class="fab fa-pinterest-p"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 col-12 p-3 border-left">
                <div class="fashiLogin">
                    <ul class="navbar-nav me-auto navbarTop" style="flex-direction: row;">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="fas fa-user"></i>
                                    {{ Auth::user()->name }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('logout') }}" class="nav-link"
                                    onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>

                        @endguest
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end tophead with language and login -->

<!--start div that be displayed in ipad and the other phones -->
<div class="topHead topHead1">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-5 col-5 p-3">
                <div class="fashiPhone">
                    <i class="fas fa-phone-alt"></i>
                    <span>
                        +65 11.188.888
                    </span>
                </div>
            </div>
            <div class="col-md-6 col-sm-7 col-7 p-3 border-left">
                <div class="fashiLogin">
                    <ul class="navbar-nav me-auto navbarTop" style="flex-direction: row;">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="fas fa-user"></i>
                                    {{ Auth::user()->name }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('logout') }}" class="nav-link"
                                    onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>

                        @endguest
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end div that be displayed in ipad and the other phones -->
