@extends('layouts.client')
@section('headstyle')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection
@section('content')


    {{-- <section class="header-gap">
            <div class="header_area  one">
                <div class="container">
                    <div class="hero_text_area">
                        <div class="hero_text">
                            <h2>MAKE YOUR <br> <span class="yellow-text">TOUR</span> <br>UNSTOPABLE</h2>
                        </div>
                    </div>
                </div>
            </div>

    </section> --}}
    <section>
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <div class="header_area  one">
                    <div class="container">
                        <div class="hero_text_area">
                            <div class="hero_text">
                                <h2>MAKE YOUR <br> <span class="yellow-text">TOUR</span> <br>UNSTOPPABLE</h2>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
              <div class="carousel-item">
                <div class="header_area  two">
                    <div class="container">
                        <div class="hero_text_area">
                            <div class="hero_text">
                                <h2>MAKE YOUR <br> <span class="yellow-text">TOUR</span> <br>UNSTOPPABLE</h2>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
              <div class="carousel-item">
                <div class="header_area  three">
                    <div class="container">
                        <div class="hero_text_area">
                            <div class="hero_text">
                                <h2>MAKE YOUR <br> <span class="yellow-text">TOUR</span> <br>UNSTOPPABLE</h2>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>

    </section>



    <!-- ===============Hero-end=============== -->
    <!-- ==============Tour-service start================== -->

    <section>
        <div class="tour_service">
            <div class="tour_service_text  ">
                <h2 class="head-text">OUR TOUR SERVICE</h2>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="service_tour_left">
                            <h2 class="text-uppercase">Explore Our<br> <span class="yellow-text">Tour Package</span></h2>
                            {{-- <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                                has been the industry's standard dummy text ever since the 1500s, when an unknown
                                printer took a galley of type and scrambled it to make a type specimen book.</p> --}}
                            <div class="ticket-btn">
                                <a href="#packages">
                                    <button>SEE PACKAGES</button>
                                </a>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="service_tour_right">
                            <img src="{{ asset('img/tour_service.jpg') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ==============Tour-service start================== -->

    <!-- =======Tour Galary start==================== -->
    <section>
        <div class="tour_galary_area">
            <div class="tour-galary-text ">
                <h2 class="head-text">VISIT OUR TOUR GALLERY</h2>
            </div>
            <div class="container">
                <div class="row">
                    @foreach ($categories as $category)
                        <div class="col-md-6 mb-4">
                            <a href="{{ route('gallery') }}">

                                <div class="tour_galary-img ">
                                    <img src="{{ $category->galleries->last()->media->last()->original_url }}"
                                        alt="">
                                    <div class="galary-overlay-text">
                                        <h2 class="text-uppercase text-center">{{ $category->name }}</h2>
                                        <p>Explore the beautiful land</p>
                                    </div>
                                    <div class="galary-overlay">

                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                    <div class="view_galary">
                        <a href="{{ route('gallery') }}">VIEW GALLERY</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- =======Tour Galary end==================== -->

    <!-- =============Explore Service start============= -->
    <section>
        <div class="explore_service_area">
            <div class="explore_service_text">
                <h2 class="head-text text-white">EXPLORE OUR TRADES</h2>
            </div>
            <div class="container">
                <div class="row">
                    @foreach ($trades as $item)
                    <div class="col-md-4 mb-4">
                        <div class="explore_card">
                            <div class="explor_img">
                                <img src="{{$item->media->first()->original_url}}" alt="">
                            </div>
                            <div class="explore_text">
                                <h2>{{$item->title}}</h2>
                                <p>{!!$item->body!!}</p>
                                <div class="explore-link">
                                    <a href="{{route('retailService')}}">EXPLORE</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach


                </div>
            </div>
    </section>
    <!-- =============Explore Service end============= -->

    <!-- =============Retail Service start============= -->
    <section>
        <div class="retail_service_area">
            <div class="retail_service_text">
                <h2 class="head-text">ALL CRUISES</h2>
            </div>
            <div class="container">
                <div class="row ">
                    @foreach ($cruises as $item)
                    <div class="col-md-6 py-3">
                        <div class="retail_img">
                            <img src="{{$item->media->first()->original_url}}" alt="{{$item->title}}" onclick="popthisImage('{{$item->media->first()->original_url}}');">
                        </div>
                        <div class="p-4 bg-mygray text-w">
                            <p>{!!$item->body!!}</p>
                            <div class="ticket-btn d-flex justify-content-center">
                                <a href="{{route('allCruises')}}">
                                    <button>SEE CRUISES</button>
                                </a>
                            </div>
                        </div>

                    </div>
                    @endforeach
                </div>
                <div class="explore-service-link">
                    <a href="{{route('allCruises')}}">EXPLORE SERVICES</a>
                </div>
            </div>
        </div>
    </section>
    <!-- =============Retail Service End============= -->

    <!-- =============Package start============= -->
    <section id="packages">
        <div class="explore_service_area">
            <div class="explore_service_text">
                <h2 class="head-text text-white">OUR PACKAGES</h2>
            </div>
            <div class="container">
                <div class="row">
                    @foreach ($packages as $item)
                    <div class="col-md-4 mb-4">
                        <div class="explore_card">
                            <div class="explor_img">
                                <img src="{{$item->media->first()->original_url}}" alt="">
                            </div>
                            <div class="explore_text">
                                <h2>{{$item->title}}</h2>
                                <h2>৳ {{$item->price}} /=</h2>
                                <p>{!!$item->body!!}</p>
                                <div class="explore-link">
                                    <a href="{{route('detailspackage')}}">DETAILS</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach


                </div>
            </div>
    </section>
    <!-- =============Package end============= -->

    <!-- =================Subscribe-Start============== -->
    <section>
        <div class="subdcribe_area">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-12">
                        <div class="subscribe_text">
                            <h2>NEWS LETTER<br><span>SUBSCRIBE</span></h2>
                        </div>
                    </div>
                    <div class="col-md-8 col-sm-12">
                        <form action="" id="subscriptionForm">
                            <div class="subscribe_form">
                                <div class="subcribe_input">
                                    <input type="email" id="email" name="email" placeholder="Enter your email">
                                    <input type="hidden" id="site" name="site" value="client">
                                </div>
                                <div class="subscribe_btn">
                                    <button type="submit" id="subscribe">SUBMIT</button>
                                </div>
                            </div>
                        </form>
                        <div class="text-b" id="subscribemsg"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- =================Subscribe-end============== -->
    <!-- =========Get-in-a-touch-start=========== -->

    <section>
        <div class="get-in-touch-area">
            <div class="get-in-toch-text">
                <h2 class="head-text">GET IN <span>TOUCH</span></h2>
            </div>
            <div class="container">
                <div class="submite-form">
                    <form id="contactusfrom">
                        <div class="submite-form-input">
                            <div class="text-input">
                                <input type="text" placeholder="Name" name="conname" id="conname" required>
                            </div>
                            <div class="text-input">
                                <input type="email" placeholder="Email Address" name="conemail" id="conemail" required>
                            </div>
                            <div class="text-input tell">
                                <input type="text" class="onlynumber" placeholder="Phone Number" name="conphone" id="conphone" maxlength="11" required>
                            </div>
                            <div class="text-area">
                                <textarea rows="6" placeholder="Message" name="conmessage" id="conmessage" required></textarea>
                            </div>
                            <div class="submite_btn">
                                <button id="contactusbtn">SUBMIT NOW</button>

                            </div>
                        </div>
                    </form>
                </div>
                <div class="text-b text-center" id="contmsg"></div>
            </div>
        </div>
    </section>
    <!-- =========Get-in-a-touch-end=========== -->
@endsection



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
