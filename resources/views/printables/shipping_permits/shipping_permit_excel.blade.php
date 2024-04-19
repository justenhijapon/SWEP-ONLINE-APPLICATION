<table class="table table-bordered">
    <tbody>
    @php
        $num = 0;

          // $key = array_search("numbering", $columns_chosen);

          // unset($columns_chosen[$key]);

    @endphp
    @if(!empty($sp))
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
        @foreach($sp as $sp)
            @php $num++ @endphp
            <tr>
                @if(in_array("numbering", $columns_chosen))
                    <th>{{$num}}</th>
                @endif
                @if(!empty($columns_chosen))
                    @foreach($columns_chosen as $column_chosen)
                        @if($column_chosen != 'numbering')
                            @switch($column_chosen)
                                @case('sp_date')
                                    <td class="{{$column_chosen}}">
                                        {{date("M. d, Y",strtotime($sp->$column_chosen))}}
                                    </td>
                                    @break
                                @case('sp_no')
                                    <td class="{{$column_chosen}}">
                                        {{$sp->$column_chosen}}
                                    </td>
                                    @break
                                @case('sp_port_of_origin')
                                    <td class="{{$column_chosen}}">
                                        {{$sp->portOfOrigin->port_name}}
                                    </td>
                                    @break
                                @default
                                    <td class="{{$column_chosen}}">
                                        {{$sp->$column_chosen}}
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