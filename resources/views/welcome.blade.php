<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

</head>

<body class="bg-dark">
    <div class="container" style="padding-top: 10rem;">
        <div class="col d-flex justify-content-center">
            <div class="col-md-8 ">
                <div class="card">
                    <div class="card-header text-center  bg-light">
                        <h2 class="fw-bolder display-4">{{ __('WELCOME!!!') }}</h2>
                    </div>
                    <div class="card-body ">
                        @if(Route::has('login'))
                        <div class="mt-4 mr-4 space-x-4 sm:mt-6 sm:mr-6 sm:space-x-6">
                            @auth
                            <a href="{{ url('/dashboard') }}" class="no-underline hover:underline text-sm font-normal text-dark uppercase">{{ __('Dashboard') }}</a>
                            @else
                            <a href="{{ route('login') }}" class="btn bg-dark no-underline hover:underline text-sm font-normal text-light uppercase">{{ __('Login') }}</a>
                            @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-3 no-underline  hover:underline text-sm font-normal text-dark uppercase">{{ __('Register') }}</a>
                            @endif
                            @endauth
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col d-flex justify-content-center" style="margin-top: 10rem;">
        <a href="https://www.linkedin.com/in/swarangi263/" target="_blank" class="text-sm font-weight-bold text-light text-uppercase">{{ __('Swarangi Satpute') }}</a>

    </div>
</body>

</html>
