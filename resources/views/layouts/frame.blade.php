<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - @stack('title')</title>

    <link rel="icon" type="image/png" href="{{ url('/favicon.png') }}" sizes="96x96"/>

    <link href="{{ url('/css/bootstrap.min.css') }}" rel="stylesheet">
    @stack('style_before')
    <link href="{{ url('/css/custom.css') }}" rel="stylesheet">

    <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">

    @stack('script_before')
</head>
<body>
@include('menu')

<div id="pageContent">
    @yield('content')
</div>

<div id="pageFooter" class="navbar-fixed-bottom">
    <div class="container text-center">
        <p>&copy; 2017-{{ date('Y') }} csapatnév | Szegedi Innovatív Informatika Verseny</p>
    </div>
</div>

<script src="{{ url('/js/jquery.min.js') }}"></script>

<script>
    var config = {
        baseURL: "{{ url('/') }}/",
        debug: {{ config('app.debug', 'false') == true ? "true":"false" }},
        csrfToken: "{{ csrf_token() }}",
        appName: "{{ config('app.name', 'Laravel') }}"
    };
</script>

<script src="{{ url('/js/bootstrap.min.js') }}"></script>
<script src="{{ url('/js/jquery.dataTables.min.js') }}"></script>

<script src="{{ url('/js/page.js') }}"></script>
@stack('script_after')
</body>
</html>