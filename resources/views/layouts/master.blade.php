<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">

        <title>@yield('page_title')</title>
        <meta name="description" content="@yield('page_description')">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>
    <body>

        @yield('content')

        <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
