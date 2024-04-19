@extends('printables.print_layout')

@section('body')
    <style type="text/css">
        .or{
            text-align: left
        }
        .date{
            text-align: left
        }
        .numbering{
            width: 10px;
        }

        .enrolee_name{
            text-align: left
        }

        .mill_district{
            text-align: left
        }
        .members, .male_members, .female_members{
            width: 8%
        }
        @media print{
            .noPrint{
                display: none
            }
        }
    </style>


    <div style="" id="content">
        <div class="row">
            <div class="col-md-12">
                <b>LIST OF Official Reciepts</b>


                <div class="row">
                    <br>
                    <div class="col-md-12">
                        @include('printables.official_reciepts.official_reciepts_excel')

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


