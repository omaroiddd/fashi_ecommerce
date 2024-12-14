    <!-- start footer section -->
    <footer>
        <!-- start section of logos -->
        <section class="logos">
            <div class="container">
                <div class="owl-carousel owl-theme" id="logos">
                    <div class="item pic1">
                        <img src="{{ asset('site/img/logo-1.png') }}" alt="">
                    </div>
                    <div class="item">
                        <img src="{{ asset('site/img/logo-2.png') }}" alt="">
                    </div>
                    <div class="item pic3">
                        <img src="{{ asset('site/img/logo-3.png') }}" alt="">
                    </div>
                    <div class="item">
                        <img src="{{ asset('site/img/logo-4.png') }}" alt="">
                    </div>
                    <div class="item">
                        <img src="{{ asset('site/img/logo-5.png') }}" alt="">
                    </div>
                </div>
            </div>
        </section>
        <!-- end section of logos -->
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-4 col-md-12 col-sm-12 col-12">
                    <div class="footerLogo pb-5">
                        <a href="{{ route('site.home') }}">
                            <img src="{{ asset('site/img/footer-logo.png') }}" alt="logo">
                        </a>
                    </div>
                    <div class="footerAddress">
                        <span>
                            Address: 60-49 Road 11378 New York
                        </span>
                    </div>
                    <div class="footerPhone">
                        <span>
                            Phone: +65 11.188.888
                        </span>
                    </div>
                    <div class="footerMail">
                        <span>
                            Email: hello.test@gmail.com
                        </span>
                    </div>
                    <div class="footerSocial pt-5">
                        @if (!empty($facebook))
                            <a href="https://{{$facebook->facebook}}" target="_blank">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                        @endif
                        @if (!empty($instagram->instagram))
                        <a href="https://{{ $instagram->instagram }}" target="_blank">
                            <i class="fab fa-instagram"></i>
                        </a>
                        @endif
                        @if (!empty($twitter))
                            <a href="https://{{ $twitter->twitter }}" target="_blank">
                                <i class="fab fa-twitter"></i>
                            </a>
                        @endif
                        @if (!empty($youtube))
                            <a href="https://{{ $youtube->youtube }}" target="_blank">
                                <i class="fab fa-youtube"></i>
                            </a>
                        @endif
                    </div>

                </div>
                <div class="col-lg-4 col-md-12 col-sm-12 col-12">
                    <div class="information">
                        <h4>Information</h4>
                        <ul>
                            <li>
                                <a href="{{ route('site.home') }}">
                                    Home
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('site.shop') }}">
                                    Shop
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('site.contact') }}">
                                    Contact
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12 col-12">
                    <div class="joinNow">
                        <h4>
                            Join Our Newsletter Now
                        </h4>
                        <span>
                            Get E-mail updates about our latest shop and
                            special offers.
                        </span>
                        <form>
                            <input type="text" placeholder="Entet Your Mail">
                            <button class="text-uppercase">subscribe</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="lowFooter py-4">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-12 col-sm-12 col-12">
                        <span>
                            Copyright ©2020 All rights reserved | This template is made with
                            <span>
                                <i class="fal fa-heart"></i>
                            </span>
                            by <a href="#">US</a>
                        </span>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12 col-12">
                        <div class="payment">
                            <img src="{{ asset('site/img/payment-method.png') }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- end footer section -->



    <script src="{{ asset('site/js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('site/js/popper.min.js') }}"></script>
    <script src="{{ asset('site/js/bootstrap.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1-rc.1/js/select2.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    @stack('js')
    <script src="{{ asset('site/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('site/js/main.js') }}"></script>
    <script>
        $(document).ready(function() {
            // Trigger search when user types in the input field
            $('#global-search').on('input', function() {
                let query = $(this).val();

                // Check if query length is at least 3 characters
                if (query.length >= 3) {
                    $.ajax({
                        url: '/search-products', // Ensure this route is defined globally
                        method: 'GET',
                        data: {
                            query: query
                        },
                        success: function(data) {
                            if (data.length > 0) {
                                let html = '';
                                data.forEach(function(product) {
                                    html += `<a href="/shop/single-product/${product.id}" class="search-item" data-id="${product.id}">
                                    <img src="/${product.image}" alt="${product.title}" width="50" height="50">
                                    <span>${product.title}</span> - $${product.price}
                                </a>`;
                                });
                                $('#global-search-results').html(html).show();
                            } else {
                                $('#global-search-results').html(
                                        '<div class="search-item">No products found</div>')
                                    .show();
                            }
                        },
                        error: function() {
                            $('#global-search-results').html(
                                '<div class="search-item">Error occurred</div>').show();
                        }
                    });
                } else {
                    $('#global-search-results').hide();
                }
            });

            // Handle click event on search item
            $(document).on('click', '.search-item', function() {
                $('#global-search').val($(this).text());
                $('#global-search-results').hide();
            });
        });
    </script>
    </body>

    </html>
