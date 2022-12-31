<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- =====Google font anton===== -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Titillium+Web:wght@300;400;700&display=swap"
        rel="stylesheet">
    <!-- =====Google font anton===== -->
    <!-- =====Google font open sance===== -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Anton&family=Open+Sans:ital,wght@0,300;0,400;1,600&family=Titillium+Web:wght@300;400;700&display=swap"
        rel="stylesheet">
    <!-- =====Google font open sance===== -->

    <!-- =========Bootstrap css=========== -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <!-- =========Bootstrap css=========== -->
    <!-- =======coustom css========== -->

    @yield('headstyle')
    <link rel="stylesheet" href="{{asset('css/common.css')}}">
    <!-- =======coustom css========== -->
    <title>Lancoptt</title>
    <script>
        let BASE_URL = {!! json_encode(url('/')) !!} + "/";
    </script>
</head>

<body>
    @guest
    @include('layouts.partials.login')
    @include('layouts.partials.register')
    @endguest
    @include('layouts.partials.imagepop')
    <!-- ============Header-Start============== -->
    @include('layouts.partials.header')

    <!-- ============Header-End============== -->

    @yield('content')

    <!-- ================Footer-start================= -->
    @include('layouts.partials.footer')
    <!-- ================Footer-End================= -->

    <!-- ===========Bootstrap Link============ -->
    @include('layouts.partials.whatsapp')
    @include('layouts.partials.script')
    {{-- <script src="{{asset('js/custom.js')}}"></script> --}}


</body>

</html>
