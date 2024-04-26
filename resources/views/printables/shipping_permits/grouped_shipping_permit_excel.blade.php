@if(!empty($port_origin))

    <div class="col-md-12">
        @include('printables.header_sra')
        <div class="col-md-12">
            <b>GROUPED LIST BY: Port</b>
        </div>
        <br>
        <table class="table table-bordered">
            <thead>
            <tr>
                @if(in_array("numbering", $columns_chosen))
                    <th>#</th>
                @endif
                @foreach($columns_chosen as $column_chosen)
                    @if($column_chosen != "numbering")
                        <th>{{ array_search($column_chosen, $columns) }}</th>
                    @endif
                @endforeach
            </tr>
            </thead>
            <tbody>
            @php $num = 0; @endphp
            @foreach($port_origin as $key => $sp)
                @foreach($sp as $item)
                    @php $num++ @endphp
                    <tr>
                        @if(in_array("numbering", $columns_chosen))
                            <th>{{$num}}</th>
                        @endif
                        @foreach($columns_chosen as $column_chosen)
                            @if($column_chosen != 'numbering')
                                @switch($column_chosen)
                                    @case('sp_date')
                                        <td class="{{$column_chosen}}">
                                            {{date("M. d, Y",strtotime($item->$column_chosen))}}
                                        </td>
                                        @break
                                    @case('sp_no')
                                        <td class="{{$column_chosen}}">
                                            {{$item->$column_chosen}}
                                        </td>
                                        @break
                                    @case('sp_port_of_origin')
                                        <td class="{{$column_chosen}}">
                                            {{$item->portOfOrigin->port_name}}
                                        </td>
                                        @break
                                    @default
                                        <td class="{{$column_chosen}}">
                                            {{$item->$column_chosen}}
                                        </td>
                                @endswitch
                            @endif
                        @endforeach
                    </tr>
                @endforeach
            @endforeach
            </tbody>
        </table>
    </div>
@else
    <div class="alert alert-danger">
        <h4><i class="icon fa fa-ban"></i> No data!</h4>
        We have not found any data based on your filters.
    </div>
@endif

{{--@if(!empty($port_origin))--}}
{{--    @foreach($port_origin as $key => $sp)--}}
{{--        @if(count($sp) > 0)--}}
{{--            <div class="col-md-12" style="break-after: page;">--}}


{{--                @include('printables.header_sra')--}}


{{--                <p class="text-left" style="font-weight: bold">Total: {{count($sp)}}--}}
{{--                    <span class="pull-right">--}}

{{--                                      @if(count($filters) > 0 )--}}

{{--                            @php--}}
{{--                                $last_element = end($filters);--}}
{{--                            @endphp--}}
{{--                            @foreach($filters as $key => $filter)--}}
{{--                                @if($filter != $last_element),@endif--}}
{{--                            @endforeach--}}
{{--                                        </span>--}}
{{--                    @endif--}}

{{--                    </span>--}}
{{--                </p>--}}



{{--                <div class="row">--}}
{{--                    <br>--}}
{{--                    <div class="col-md-12">--}}
{{--                        <table class="table table-bordered">--}}
{{--                            <thead class="">--}}

{{--                            @if(!empty($columns_chosen))--}}

{{--                                @if(in_array("numbering", $columns_chosen))--}}
{{--                                    <th>#</th>--}}
{{--                                @endif--}}

{{--                                @foreach($columns_chosen as $column_chosen)--}}
{{--                                    @if($column_chosen != "numbering")--}}
{{--                                        <th>{{ array_search($column_chosen, $columns) }}</th>--}}
{{--                                    @endif--}}
{{--                                @endforeach--}}
{{--                            @endif--}}
{{--                            </thead>--}}
{{--                            <tbody>--}}
{{--                            @php--}}
{{--                                $num = 0;--}}

{{--                                  // $key = array_search("numbering", $columns_chosen);--}}

{{--                                  // unset($columns_chosen[$key]);--}}

{{--                            @endphp--}}
{{--                            @if(!empty($sp))--}}
{{--                                @foreach($sp as $sp)--}}
{{--                                    @php $num++ @endphp--}}
{{--                                    <tr>--}}
{{--                                        @if(in_array("numbering", $columns_chosen))--}}
{{--                                            <th>{{$num}}</th>--}}
{{--                                        @endif--}}
{{--                                        @if(!empty($columns_chosen))--}}
{{--                                            @foreach($columns_chosen as $column_chosen)--}}
{{--                                                @if($column_chosen != 'numbering')--}}
{{--                                                    @switch($column_chosen)--}}
{{--                                                        @case('sp_date')--}}
{{--                                                            <td class="{{$column_chosen}}">--}}
{{--                                                                {{date("M. d, Y",strtotime($sp->$column_chosen))}}--}}
{{--                                                            </td>--}}
{{--                                                            @break--}}
{{--                                                        @case('sp_no')--}}
{{--                                                            <td class="{{$column_chosen}}">--}}
{{--                                                                {{$sp->$column_chosen}}--}}
{{--                                                            </td>--}}
{{--                                                            @break--}}
{{--                                                        @case('sp_port_of_origin')--}}
{{--                                                            <td class="{{$column_chosen}}">--}}
{{--                                                                {{$sp->portOfOrigin->port_name}}--}}
{{--                                                            </td>--}}
{{--                                                            @break--}}
{{--                                                        @default--}}
{{--                                                            <td class="{{$column_chosen}}">--}}
{{--                                                                {{$sp->$column_chosen}}--}}
{{--                                                            </td>--}}
{{--                                                    @endswitch--}}
{{--                                                @endif--}}

{{--                                            @endforeach--}}
{{--                                        @endif--}}
{{--                                    </tr>--}}
{{--                                @endforeach--}}
{{--                            @endif--}}

{{--                            </tbody>--}}
{{--                        </table>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <hr class="noPrint" style="border: 1px dashed blue !important">--}}
{{--            </div>--}}

{{--        @endif--}}
{{--    @endforeach--}}
{{--@else--}}
{{--    <div class="alert alert-danger">--}}
{{--        <h4><i class="icon fa fa-ban"></i> No data!</h4>--}}
{{--        We have not found any data based on your filters.--}}
{{--    </div>--}}
{{--@endif--}}

