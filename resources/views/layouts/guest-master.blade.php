<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SRA Web Portal - Shipping Permit</title>
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('layouts.css-plugins')
    <style type="text/css">
      .content-wrapper {
        position: relative; /* Ensure proper stacking context */
      }

      .content-wrapper::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image:url(http://hrrs.sra.gov.ph/images/sugar.jpg);
        background-position: center bottom;
        background-size: cover;
        -webkit-filter: brightness(30%);
        z-index: -1; /* Send the blurred background behind the content */
      }

      .form-control {
        height: 40px; /* Increase the height of the input fields */
      }

      .btn {
        height: 40px; /* Increase the height of the button */
      }

      .form-group {
        display: flex;
        align-items: center; /* Center vertically */
      }

      .form-control-feedback {
        font-size: 20px; /* Increase the size of the glyphicon icons */
        margin-right: 10px; /* Add some space between icon and input field */
      }

      .login-box {
        width: 800px; /* Adjust the width as needed */
        margin: 0 auto;
        padding-top: 50px;

      }
      .login-logo a {
        font-size: 4rem; /* Increase the font size for the logo */
        font-family: Arial, Helvetica, sans-serif;
        color: white;
      }

      .login-box-msg{
        font-size: 2rem; /* Increase the font size for the logo */
        font-family: Arial, Helvetica, sans-serif;
      }

      .login-box-body {
        display: flex;
        justify-content: space-between;
        padding: 20px;
        border-radius: 25px;
        height: 300px;
      }
      .image-container {
        flex: 1;
        display: flex;
        justify-content: center; /* Center the image horizontally */
        align-items: center; /* Center the image vertically if needed */

      }
      .image-container img {
        width: 300px; /* Set the desired width */
        height: 300px; /* Set the desired height */
      }
      .form-container {
        flex: 1;
      }
      @media (max-width: 768px) {
        .login-box {
          width: 100%;
        }
        .login-box-body {
          padding: 10px;
        }
        .image-container {
          padding-right: 0;
          margin-bottom: 30px;
        }
      }
    </style>
  </head>
  <body class="hold-transition skin-blue layout-top-nav">
    <div class="wrapper">
      <header class="main-header">
{{--        <nav class="navbar navbar-static-top">--}}
{{--          <div class="container">--}}
{{--            <div class="navbar-header">--}}
{{--              <a href="#" class="navbar-brand"><b>SUGAR REGULATORY ADMINISTRATION</b></a>--}}
{{--            </div>--}}
{{--            <div class="navbar-custom-menu">--}}
{{--              <ul class="nav navbar-nav">--}}
{{--                <li class="notifications-menu"><a href="#">Login</a></li>--}}
{{--                <li class="notifications-menu"><a href="#">Info </a></li>--}}
{{--              </ul>--}}
{{--            </div>--}}
{{--          </div>--}}
{{--        </nav>--}}
      </header>
      <div class="content-wrapper">
        <div class="container">
          @yield('content')
        </div>
      </div>
{{--      <footer class="main-footer">--}}
{{--        <div class="container">--}}
{{--          <div class="pull-right hidden-xs">--}}
{{--            <b>Version</b> 1.2.0--}}
{{--          </div>--}}
{{--          <strong>Copyright &copy; 2019-2020 <a href="#">MIS-VISAYAS</a>.</strong> All rights--}}
{{--          reserved.--}}
{{--        </div>--}}
{{--      </footer>--}}
      
    </div>


    @include('layouts.js-plugins')
    
    <script type="text/javascript">
      
      @yield('scripts')

    </script>
    

  </body>
</html>