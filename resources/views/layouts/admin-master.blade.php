<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SRA Web Portal - GAD</title>
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @include('layouts.css-plugins')

    @yield('css')


    <style type="text/css">
        .pagination>.active>a,
        .pagination>.active>a:focus,
        .pagination>.active>a:hover,
        .pagination>.active>span,
        .pagination>.active>span:focus,
        .pagination>.active>span:hover{
            background-color: {{ __static::pagination_color(Auth::user()->color) }} ;
            border-color: {{ __static::pagination_color(Auth::user()->color) }}
      }
    </style>
</head>
<body class="hold-transition  {!! Auth::check() ? __sanitize::html_encode(Auth::user()->color) : '' !!}">

<body class="hold-transition {!! Auth::check() ? __sanitize::html_encode(Auth::user()->color) : '' !!}">

<div id="loader"></div>

<div class="wrapper">

    @include('layouts.admin-topnav')

    @include('layouts.admin-sidenav')

    <div class="content-wrapper">
        @yield('content')
        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b>Version</b> 1.2.0
            </div>
            <strong>Copyright &copy; 2019-2020 <a href="#">MIS-VISAYAS</a>.</strong> All rights
            reserved.
        </footer>
    </div>
</div>

@include('layouts.js-plugins')

@yield('modals')

{!! __html::modal_loader() !!}

@yield('scripts')

</body>

</html>