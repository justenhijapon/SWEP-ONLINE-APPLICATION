<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SWEP - Online Payment</title>
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

        /* Make the main header sticky */
        .main-header {
            position: fixed;
            width: 100%;
            z-index: 1030; /* Ensure it appears above other elements */
        }

        /* Make the main sidebar sticky */
        .main-sidebar {
            position: fixed;
            top: 0;
            left: 0;
            max-height: 100vh;
            overflow-y: auto; /* Enable vertical scrolling */
            /*scrollbar-width: thin; !* For Firefox *!*/
            /*scrollbar-color: #888 #f1f1f1; !* thumb and track colors *!*/
        }

        /*::-webkit-scrollbar {*/
        /*    width: 20px;  !* Remove scrollbar space *!*/
        /*    !*background: transparent;  !* Optional: just make scrollbar invisible *!*!*/
        /*}*/

        .main-sidebar::-webkit-scrollbar {
            width: 0;
            height: 8px;
            background-color: #4b646f; /* or add it to the track */
        }

        .main-sidebar::-webkit-scrollbar-thumb {
            background: #4b646f;
        }

        .main-sidebar::-webkit-scrollbar-track {
            background: #1a2226;
        }



    </style>

</head>


<body class="hold-transition {!! Auth::check() ? __sanitize::html_encode(Auth::user()->color) : '' !!}">

<div id="loader"></div>

<div class="wrapper">

    @include('layouts.admin-topnav')

    @include('layouts.admin-sidenav')

    <div class="content-wrapper" >
        @yield('content')
        @yield('content2')
    </div>

    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 1.1.0
        </div>
        <strong>Copyright &copy; 2018-2019 <a href="#">SRA</a>.</strong> All rights
        reserved.
    </footer>

</div>
@include('layouts.js-plugins')

@yield('modals')

{!! __html::modal_loader() !!}

<script type="text/javascript">
    let modal_loader = $("#modal_loader").parent('div').html();
    $('#menu-search').on('input', function() {
        var searchText = $(this).val().toLowerCase();
        $('.treeview').each(function() {
            var menuItemText = $(this).text().toLowerCase();
            if (menuItemText.includes(searchText)) {
                $(this).slideDown();
            } else {
                $(this).slideUp();
            }
        });
    });

</script>
@yield('scripts')

</body>

</html>