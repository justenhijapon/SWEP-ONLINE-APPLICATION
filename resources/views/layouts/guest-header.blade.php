<head id="header" class="header-one" style="padding: 0px !important;">
    <div class="bg-white">
        <div class="container" style="">
            <div class="logo-area" style="padding: 0px;">
                <div class="row align-items-center">
                    <div class="col-lg-12" >

                        <table class="xsmall large" style="margin-bottom: 15px; margin-top: 5px;">
                            <tbody style="width: 100%">
                            <tr class="no-padding">
                                <td style="vertical-align: top;">
                                    <table style="border-spacing: 0px !important;">
                                        <tr style="line-height: 12px;">
                                            <td rowspan="3">
                                                <a href="/">
                                                    <img src="{{asset('/images/Guest/ph_seal_sra_logo.png')}}" style="width: 190px">
                                                </a>
                                            </td>
                                            <td style="padding-bottom: 0px !important; ">
                                                <p class="text-strong no-margin bottom-t" style="font-size: 16px; line-height: 6px;">REPUBLIC OF THE PHILIPPINES</p>
                                            </td>
                                            <td rowspan="3" style="margin-bottom: 5px;">
                                                <img src="{{asset('/images/Guest/bagongPilipinas.jpg')}}" style="width: 85px; padding-left: 5px;">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="padding-top: 0px !important;">
                                                <p class="text-strong no-margin" style="font-size: 14px; line-height: 1px;">Department of Agriculture</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p class="text-strong no-margin" style="font-size: 35px; line-height: 10px; color: green">SUGAR REGULATORY ADMINISTRATION</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td colspan="2">
                                                @php
                                                    $date = Carbon::now()->format('l, F j, Y');
                                                @endphp
                                                <p class="info-text pull-left no-margin" style="font-size: 14px; padding-bottom: 0px; line-height: 1px;">
                                                    Sugar Center Bldg., North Avenue, Diliman, Quezon City
                                                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                                    <strong class="">Today:</strong> {{$date}}
                                                </p>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
{{--          <p class="no-margin no-padding" style="background-color: green; height: 50px; margin: 0">--}}
    </div>
    <style>
        nav{
            a{
                color: whitesmoke;
            }
        }
    </style>

        <nav class="navbar navbar-expand-lg navbar-light " style="background-color: green; color: whitesmoke; height: 60px;">
            <div class="container">
            <a class="navbar-brand" href="/"><h4 class="underline-hover" style="margin: 0; color: whitesmoke">ONLINE APPLICATION</h4></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="/"><h5 class="underline-hover" style="color: whitesmoke; margin: 0">Home</h5> <span class="sr-only">(current)</span></a>
                    </li>
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link" href="#">Link</a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item dropdown">--}}
{{--                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
{{--                            Dropdown--}}
{{--                        </a>--}}
{{--                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">--}}
{{--                            <a class="dropdown-item" href="#">Action</a>--}}
{{--                            <a class="dropdown-item" href="#">Another action</a>--}}
{{--                            <div class="dropdown-divider"></div>--}}
{{--                            <a class="dropdown-item" href="#">Something else here</a>--}}
{{--                        </div>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link disabled" href="#">Disabled</a>--}}
{{--                    </li>--}}
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
            </div>
        </nav>


</head>