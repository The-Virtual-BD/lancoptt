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
                    <h2>All VESSELS</h2>
                </div>
            </div>
        </div>
    </section>

    <!-- ================Hero-End================== -->
    <!-- ===============SundorBon start=============== -->
    <section>
        <div class="galary_sundorban">
            <div class="container">
                <div class="row">
                        @foreach ($cruises as $cruise )
                        <div class="col-md-6 mb-4">
                            <img src="{{$cruise->media->first()->original_url}}" alt="" onclick="popthisImage('{{$cruise->media->first()->original_url}}');">
                            <div class="p-4 bg-myorange text-b">
                                <p>{!!$cruise->body!!}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                {{-- <div class="galary_text">
                    <h2 class="text-uppercase">{{$category->name}}</h2>
                </div> --}}

                {{-- <div class="galary-button">
                    <button class="partners__button__a">Show More </button>
                </div> --}}
            </div>

        </div>
    </section>
@endsection
