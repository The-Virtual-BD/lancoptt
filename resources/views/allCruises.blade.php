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
                    <h2>All VESSELS</h2>
                </div>
            </div>
        </div>
    </section>

    <!-- ================Hero-End================== -->
    <!-- ===============SundorBon start=============== -->
    <section>
        <div class="tab_area">
            <div class="container">

                <div class="row">
                    <div class="col-12">
                        <div class="nav flex me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            @foreach ($cruises as $item)
                            <button class="nav-link @if ($loop->first) active @endif" id="v-pills-{{$item->id}}-tab" data-bs-toggle="pill"
                                data-bs-target="#v-pills-{{$item->id}}" type="button" role="tab" aria-controls="v-pills-{{$item->id}}"
                                aria-selected="true"><span class="iconify icon-gap"
                                    data-icon="ic:outline-navigate-next"></span>{{$item->title}}</button>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="tab-content" id="v-pills-tabContent">
                            @foreach ($cruises as $item)
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
                                                <img class="img-fluid" src="{{$item->media->first()->original_url}}" alt="" onclick="popthisImage('{{$item->media->first()->original_url}}');">
                                            </div>
                                        </div>
                                        @forelse ($item->options as $option)
                                        <div class="row my-5">
                                            <div class="col-md-8 mb-2">
                                                <h3>{{$option->title}}</h3>
                                                <p>{!!$option->body!!}</p>
                                            </div>
                                            <div class="col-md-4 row">
                                                <img class="img-fluid" src="{{$option->media->first()->original_url}}" alt="" onclick="popthisImage('{{$option->media->first()->original_url}}');">
                                                {{-- @forelse ($option->media as $media)
                                                <div class="col-md-6 mb-3">
                                                    <img class="img-fluid" src="{{$media->original_url}}" alt="" onclick="popthisImage('{{$media->original_url}}');">
                                                </div>
                                                @empty

                                                @endforelse --}}
                                            </div>
                                        </div>
                                        @empty

                                        <div class="">
                                            No Option Found
                                        </div>
                                        @endforelse
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
@endsection
