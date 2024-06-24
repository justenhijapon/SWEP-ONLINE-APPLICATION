<table class="table table-bordered">
    <tbody>
    @php
        $num = 0;

          // $key = array_search("numbering", $columns_chosen);

          // unset($columns_chosen[$key]);

    @endphp
    @if(!empty($or))
        <tr>
            @if(!empty($columns_chosen))

                @if(in_array("numbering", $columns_chosen))
                    <th>#</th>
                @endif

                @foreach($columns_chosen as $column_chosen)
                    @if($column_chosen != "numbering")
                        <th>{{ array_search($column_chosen, $columns) }}</th>
                    @endif
                @endforeach
            @endif
        </tr>
        @foreach($or as $or)
            @php $num++ @endphp
            <tr>
                @if(in_array("numbering", $columns_chosen))
                    <th>{{$num}}</th>
                @endif
                @if(!empty($columns_chosen))
                    @foreach($columns_chosen as $column_chosen)
                        @if($column_chosen != 'numbering')
                            @switch($column_chosen)
                                @case('or_date')
                                    <td class="{{$column_chosen}}">
                                        {{date("M. d, Y",strtotime($or->$column_chosen))}}
                                    </td>
                                    @break
                                @case('or_no')
                                    <td class="{{$column_chosen}}">
                                        {{$or->$column_chosen}}
                                    </td>
                                    @break
                                @case('or_mill')
                                    <td class="{{$column_chosen}}">
                                        {{$or->orMIll_Origin->mill_name}}
                                    </td>
                                    @break
                                @case('orShippingPermit')
                                    <td class="{{$column_chosen}}">
                                        @foreach($or->orUtilization as $orhippingpermit)
                                            {{$orhippingpermit->oru_sp_no}}<br>
                                        @endforeach
                                    </td>
                                    @break
                                @default
                                    <td class="{{$column_chosen}}">
                                        {{$or->$column_chosen}}
                                    </td>
                            @endswitch
                        @endif

                    @endforeach
                @endif
            </tr>
        @endforeach
    @endif

    </tbody>
</table>