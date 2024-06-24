@if(!empty($group_array))

    <div class="col-md-12">
        @include('printables.header_sra')
        <div class="col-md-12">
            @foreach($types as $type)
                @switch($type)
                    @case('or_payor')
                        <b>GROUPED LIST BY: Payor</b>
                        @break
                    @case('or_crop_year')
                        <b>GROUPED LIST BY: Crop Year</b>
                        @break
                    @case('or_mill')
                        <b>GROUPED LIST BY: Mill</b>
                        @break
                    @case('or_sugar_class')
                        <b>GROUPED LIST BY: Sugar Class</b>
                        @break
                    @case('or_drawee_bank')
                        <b>GROUPED LIST BY: Drawee Bank</b>
                        @break
                    @case('or_cancellation')
                        <b>GROUPED LIST BY: Cancellation</b>
                        @break
                    @case('or_shut_out')
                        <b>GROUPED LIST BY: Shut Out</b>
                        @break
                    @case('or_transhipment')
                        <b>GROUPED LIST BY: Transhipment</b>
                        @break
                    @case('or_other_fees')
                        <b>GROUPED LIST BY: Other Fees</b>
                        @break
                    @default
                        <b>GROUPED LIST BY: {{$type}}</b>
                @endswitch
            @endforeach
        </div>
        <br><br>
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
            @foreach($group_array as $key => $or)
                @foreach($or as $item)
                    @php $num++ @endphp
                    <tr>
                        @if(in_array("numbering", $columns_chosen))
                            <th>{{$num}}</th>
                        @endif
                        @foreach($columns_chosen as $column_chosen)
                            @if($column_chosen != 'numbering')
                                @switch($column_chosen)
                                    @case('or_date')
                                        <td class="{{$column_chosen}}">
                                            {{date("M. d, Y",strtotime($item->$column_chosen))}}
                                        </td>
                                        @break
                                    @case('or_mill')
                                        <td class="{{$column_chosen}}">
                                            {{$item->orMIll_Origin->mill_name}}
                                        </td>
                                        @break
                                    @case('orShippingPermit')
                                        <td class="{{$column_chosen}}">
                                            @foreach($item->orUtilization as $orhippingpermit)
                                                {{$orhippingpermit->oru_sp_no}}<br>
                                            @endforeach
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
{{--    @foreach($port_origin as $key => $or)--}}
{{--        @if(count($or) > 0)--}}
{{--            <div class="col-md-12" style="break-after: page;">--}}


{{--                @include('printables.header_sra')--}}


{{--                <p class="text-left" style="font-weight: bold">Total: {{count($or)}}--}}
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
{{--                            @if(!empty($or))--}}
{{--                                @foreach($or as $or)--}}
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
{{--                                                                {{date("M. d, Y",strtotime($or->$column_chosen))}}--}}
{{--                                                            </td>--}}
{{--                                                            @break--}}
{{--                                                        @case('sp_no')--}}
{{--                                                            <td class="{{$column_chosen}}">--}}
{{--                                                                {{$or->$column_chosen}}--}}
{{--                                                            </td>--}}
{{--                                                            @break--}}
{{--                                                        @case('sp_port_of_origin')--}}
{{--                                                            <td class="{{$column_chosen}}">--}}
{{--                                                                {{$or->portOfOrigin->port_name}}--}}
{{--                                                            </td>--}}
{{--                                                            @break--}}
{{--                                                        @default--}}
{{--                                                            <td class="{{$column_chosen}}">--}}
{{--                                                                {{$or->$column_chosen}}--}}
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

