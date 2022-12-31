@extends('layouts.client')
@section('headstyle')
    <link rel="stylesheet" href="{{ asset('css/gallery.css') }}">
@endsection
@section('content')


    <section class="blanksection"></section>
    <!-- ================Hero-start================== -->
    <section>
        <div class="galllery_hero">
            <div class="container">
                <div class="galllery_hero-text">
                    <h2>VISIT OUR TOUR GALLERY</h2>
                </div>
            </div>
        </div>
    </section>

    <!-- ================Hero-End================== -->
    <!-- ===============SundorBon start=============== -->
    @foreach ($categories as $category)
    @if ($category->galleries->count() > 0)
    <section>
        <div class="galary_sundorban">
            <div class="container">
                <div class="galary_text">
                    <h2 class="text-uppercase">{{$category->name}}</h2>
                </div>
                <div class="partners__ul">
                    @foreach ($category->galleries as $gallery )
                        @foreach ($gallery->media as $media)
                        <div class="">
                            <img src="{{$media->original_url}}" alt="" onclick="popthisImage('{{$media->original_url}}');">
                        </div>
                        @endforeach
                    @endforeach
                </div>
                {{-- <div class="galary-button">
                    <button class="partners__button__a">Show More </button>
                </div> --}}
            </div>

        </div>
    </section>
    @endif
    @endforeach
@endsection
