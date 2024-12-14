@extends('site.master')

@section('title', 'FAQ')

@section('sub_page', 'FAQ')

@section('content')

    @include('site.layouts.breadcrumb_inside')
    <!-- start section of slide answers for questions -->
    <section class="question py-5">
        <div class="accordion" id="accordionExample">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <h2 class="mb-0">
                                    <button type="button" class="btn btn-link" data-toggle="collapse"
                                        data-target="#collapseOne">
                                        <i class="fa fa-plus"></i>
                                        Is There Anything I Should Bring?
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                data-parent="#accordionExample">
                                <div class="card-body">
                                    <p>Lorem ipsum dolor sit amet consectetur
                                        adipisicing elit. Iste maiores, hic
                                        molestiae enim, possimus, ipsam vitae
                                        fuga adipisci quibusdam non velit corrupti
                                        accusamus provident natus architecto
                                        eligendi quod labore iure.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-header" id="headingTwo">
                                <h2 class="mb-0">
                                    <button type="button" class="btn btn-link collapsed" data-toggle="collapse"
                                        data-target="#collapseTwo">
                                        <i class="fa fa-plus"></i>
                                        Where Can I Find Market Research Reports?
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                data-parent="#accordionExample">
                                <div class="card-body">
                                    <p>Lorem ipsum dolor sit amet consectetur
                                        adipisicing elit. Iste maiores, hic
                                        molestiae enim, possimus, ipsam vitae
                                        fuga adipisci quibusdam non velit corrupti
                                        accusamus provident natus architecto
                                        eligendi quod labore iure.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-header" id="headingThree">
                                <h2 class="mb-0">
                                    <button type="button" class="btn btn-link collapsed" data-toggle="collapse"
                                        data-target="#collapseThree">
                                        <i class="fa fa-plus"></i>
                                        Where Can I Find The Well Street Journal?
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                                data-parent="#accordionExample">
                                <div class="card-body">
                                    <p>Lorem ipsum dolor sit amet consectetur
                                        adipisicing elit. Iste maiores, hic
                                        molestiae enim, possimus, ipsam vitae
                                        fuga adipisci quibusdam non velit corrupti
                                        accusamus provident natus architecto
                                        eligendi quod labore iure.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end section of slide answers for questions -->

@endsection
