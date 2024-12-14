@extends('site.master')

@section('title', 'Contact')


@section('page', 'Contact')
@section('content')
    @include('site.layouts.breadcrumb')
    <section class="contact">
        <!-- container of map -->
        <div class="container">
            <div class="map">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d48158.34857810273!2d-74.097819!3d41.027514!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sbd!4v1606477691006!5m2!1sen!2sbd"
                    width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false"
                    tabindex="0">
                </iframe>
            </div>
        </div>

        <!-- container of social and comments -->
        <div class="container pt-5">
            <div class="row">
                <div class="col-lg-5 col-md-12 pb-3">
                    <div class="contactTxt">
                        <h4>
                            Contact Us
                        </h4>
                        <p>
                            Contrary to popular belief, Lorem Ipsum is simply random text.
                            It has roots in a piece of classical Latin literature
                            from 45 BC, maki years old.
                        </p>
                    </div>
                    <div class="contactSocial">
                        <div class="contactItem">
                            <div class="itemIcon">
                                <i class="fal fa-map-marker-alt"></i>
                            </div>
                            <div class="itemTxt">
                                <span>Address:</span>
                                <p>
                                    60-49 Road 11378 New York
                                </p>
                            </div>
                        </div>
                        <div class="contactItem">
                            <div class="itemIcon">
                                <i class="fal fa-mobile-alt"></i>
                            </div>
                            <div class="itemTxt">
                                <span>Phone:</span>
                                <p>
                                    +65 11.188.888
                                </p>
                            </div>
                        </div>
                        <div class="contactItem">
                            <div class="itemIcon">
                                <i class="fal fa-envelope"></i>
                            </div>
                            <div class="itemTxt">
                                <span>Email:</span>
                                <p>
                                    hellocolorlib@gmail.com
                                </p>
                            </div>
                        </div>
                        <div class="clr"></div>
                    </div>
                </div>
                <div class="col-lg-6 offset-lg-1 col-md-12 pb-3">
                    <div class="contactTxt comment">
                        <h4>
                            Leave A Comment
                        </h4>
                        <p>
                            Our staff will call back later and answer your questions.
                        </p>
                    </div>
                    <form method="POST" action="{{ route('site.contact.store') }}">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                @include('inc.success')
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <input type="text" placeholder="Your Name" name="name" class="mb-0">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <input type="email" placeholder="Your Email" name="email" class="mb-0">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <textarea placeholder="Message" name="message" class="mb-0"></textarea>
                                @error('message')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-12 col-md-12 mt-4">
                                <button class="btn text-uppercase">
                                    send message
                                </button>
                            </div>
                        </div>
                </div>
                </form>
            </div>
        </div>
        </div>
    </section>
@endsection
