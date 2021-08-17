
@extends('printables.print_layout')

@section('body')
    <style type="text/css">
        .school{
            width: 15% !important
        }
        .course_applied{
            width: 15% !important
        }

        .scholarship_applied{
            width: 50px !important;
            text-align: center;
        }
        .resolution_no{
            width: 105px ;
            text-align: center
        }
        .number{
            text-align: right;
        }

        .left{
            text-align: left;
        }
        .numbering{
            width: 10px;
        }

        @media print{
            .noPrint{
                display: none
            }
        }
    </style>
    <b>{{$request->year}} GAD Budget Monitoring</b>
    <div style="">
        <div id="loader">
            <center>
                <img style="width: 300px; margin: 40px 0;" src="{!! __static::loader(Auth::user()->color) !!}">
            </center>
        </div>
    </div>
    <br>
{{--    {{print_r($request->columns)}}--}}
    <div style="" id="content">
        <div class="row">
            <div class="col-md-12">
                @if(!empty($columns_chosen))
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                @foreach($columns_chosen as $column_chosen)
                                    <th class="text-center"><b>{{$columns_default[$column_chosen]}}</b></th>
                                @endforeach
                            </tr>
                        </thead>
                        @if(!empty($projects))
                            <tbody>
                                @php
                                    $total_budget = $projects->sum('budget');
                                    $total_utilized = 0;
                                @endphp
                                @foreach($projects as $project)
                                    <tr>
                                        @php
                                            $utilized_fund = $project->seminars->sum('utilized_fund')+$project->otherActivities->sum('utilized_fund');
                                            $total_utilized = $total_utilized+$utilized_fund;
                                        @endphp
                                        @foreach($columns_chosen as $column_chosen)

                                            @switch($column_chosen)
                                                @case('budget')
                                                    <td class="number">{{number_format($project->$column_chosen,2)}}</td>
                                                @break

                                                @case('utilized_fund')
                                                    <td class="number">{{number_format($utilized_fund,2)}}</td>
                                                @break

                                                @case('balance')
                                                    <td class="number">{{number_format($project->budget - $utilized_fund,2)}}</td>
                                                @break

                                                @default
                                                <td class="left">{{$project->$column_chosen}}</td>

                                                    @break
                                            @endswitch


                                        @endforeach
                                    </tr>
                                @endforeach
                                @php
                                //echo array_search('budget',$columns_chosen);
                                $columns_chosen_count = count($columns_chosen);
                                @endphp
                                <tr style="font-weight: bold">
                                    <td class="left">TOTAL</td>
                                    @for($i=1; $i < $columns_chosen_count ; $i++)
                                        @switch($columns_chosen[$i])
                                            @case('budget')
                                                <td class="number">{{number_format($total_budget,2)}}</td>
                                            @break

                                            @case('utilized_fund')
                                                <td class="number">{{number_format($total_utilized,2)}}</td>
                                            @break

                                            @case('balance')
                                                <td class="number">{{number_format($total_budget-$total_utilized,2)}}</td>
                                            @break

                                            @default
                                                <td></td>
                                            @break
                                        @endswitch

                                    @endfor
                                </tr>
                            </tbody>
                        @endif
                    </table>
                @endif
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