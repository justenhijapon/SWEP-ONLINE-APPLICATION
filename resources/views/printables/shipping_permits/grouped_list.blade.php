
@extends('printables.print_layout_no_header')

@section('body')
    <style type="text/css">
        /*.school{*/
        /*    width: 15% !important*/
        /*}*/
        /*.course_applied{*/
        /*    width: 15% !important*/
        /*}*/

        /*.hip_applied{*/
        /*    width: 50px !important;*/
        /*    text-align: center;*/
        /*}*/
        /*.resolution_no{*/
        /*    width: 105px ;*/
        /*    text-align: center*/
        /*}*/
        /*.mill_district{*/
        /*    width: 10%*/
        /*}*/

        /*.numbering{*/
        /*    width: 10px;*/
        /*}*/

        @media print{
            .noPrint{
                display: none
            }
        }
    </style>
    <div style="">
        <div id="loader">
            <center>
                <img style="width: 300px; margin: 40px 0;" src="{!! __static::loader(Auth::user()->color) !!}">
            </center>
        </div>
    </div>

    <div style="" id="content">
        <div class="row">
            <div class="col-md-12">
                <div class="row" >
                    <br>
                    @include('printables.shipping_permits.grouped_shipping_permit_excel')
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            $("#loader").fadeOut(function(){
                $("#content").fadeIn(1000);
            })
        })
    </script>
@endsection
