<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title')</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="//fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <!-- <link rel="stylesheet" href="{{ mix('css/app.css') }}"> -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/main.css') }}" rel="stylesheet">
        <link href="{{ asset('js/dropzone.min.css') }}" rel="stylesheet">
        <!-- Scripts -->
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script src="{{ mix('js/app.js') }}" defer></script>
        <script src="/js/lang/public/lang.js" ></script>
        <script src="/js/translator.js" ></script>
        <script src="/js/inputmask.min.js" ></script>
        <script src="/js/helpers.js" ></script>
        <script src="/js/main.js" ></script>
        <script src="/js/dropzone.min.js" ></script>

    </head>
    <body>
        <div class="font-sans text-gray-900 antialiased content">
          @yield('content')
        </div>
    </body>
</html>
