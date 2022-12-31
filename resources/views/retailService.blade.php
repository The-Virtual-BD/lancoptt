@extends('layouts.client')
@section('headstyle')
    <link rel="stylesheet" href="{{ asset('css/retailService.css') }}">
@endsection
@section('content')
    <section class="blanksection"></section>
    <!-- ================Hero-start================== -->
    <section>
        <div class="galllery_hero">
            <div class="container">
                <div class="galllery_hero-text">
                    <h2>EXPLORE OUR RETAIL SERVICES</h2>
                </div>
            </div>
        </div>
    </section>

    <!-- ================Hero-End================== -->

    <!-- ==================Reatil service start============= -->
    <section>
        <div class="tab_area">
            <div class="container">

                <div class="row">
                    <div class="col-md-4">
                        <div class="nav flex-column me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            @foreach ($trades as $item)
                            <button class="nav-link @if ($loop->first) active @endif" id="v-pills-{{$item->id}}-tab" data-bs-toggle="pill"
                                data-bs-target="#v-pills-{{$item->id}}" type="button" role="tab" aria-controls="v-pills-{{$item->id}}"
                                aria-selected="true"><span class="iconify icon-gap"
                                    data-icon="ic:outline-navigate-next"></span>{{$item->title}}</button>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-7 offset-md-1">
                        <div class="tab-content" id="v-pills-tabContent">
                            @foreach ($trades as $item)
                            <div class="tab-pane fade @if ($loop->first) show active @endif" id="v-pills-{{$item->id}}" role="tabpanel"
                                aria-labelledby="v-pills-{{$item->id}}-tab">
                                <div class="tab_des">

                                    <div class="tab_content_text">
                                        <div class="tab_content_first_text_image">
                                            <div class="mr-30 tab_content_first_text">
                                                <h2>{{$item->title}}</h2>
                                                <p>{!!$item->body!!}</p>
                                            </div>
                                            <div class="tab_img">
                                                <img class="img-fluid" src="{{$item->media->first()->original_url}}" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- ==================Reatil service start============= -->
    <!-- =================Subscribe-Start============== -->
    <section id="retailservicetab">
        <div class="subdcribe_area_retail">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-12">
                        <div class="subscribe_text">
                            <h2>NEWS<br><span>SUBSCRIBE</span></h2>
                        </div>
                    </div>
                    <div class="col-md-8 col-sm-12">
                        <form id="subscriptionForm">
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
@endsection
