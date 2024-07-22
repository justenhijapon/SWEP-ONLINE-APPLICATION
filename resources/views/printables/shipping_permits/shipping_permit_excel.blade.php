<table class="table table-bordered" style="width: 100%;">
    <tbody>
    @php
        $num = 0;
        $totalAmount = 0; // Initialize total amount variable


    @endphp
    @if(!empty($sp))
        <tr>
            @if(!empty($columns_chosen))
                <!-- Calculate colspan based on the number of visible columns -->
                @php
                    $colspan = count($columns_chosen) - 1;
                @endphp
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

                                @case('sp_no')
                                    <td class="{{$column_chosen}}">
                                        {{$sp->$column_chosen}}
                                    </td>
                                    @break
                                @case('sp_date')
                                    <td class="{{$column_chosen}}">
                                        {{date("M. d, Y",strtotime($sp->$column_chosen))}}
                                    </td>
                                    @break
                                @case('sp_edd_etd')
                                    <td class="{{$column_chosen}}">
                                        {{date("M. d, Y",strtotime($sp->$column_chosen))}}
                                    </td>
                                    @break
                                @case('sp_eda_eta')
                                    <td class="{{$column_chosen}}">
                                        {{date("M. d, Y",strtotime($sp->$column_chosen))}}
                                    </td>
                                    @break
                                @case('sp_port_of_origin')
                                    <td class="{{$column_chosen}}">
                                        {{$sp->sp_port_of_origin}}
                                    </td>
                                    @break
                                @case('sp_port_of_destination')
                                    <td class="{{$column_chosen}}">
                                        {{$sp->sp_port_of_destination}}
                                    </td>
                                    @break
                                @case('sp_mill')
                                    <td class="{{$column_chosen}}">
                                        {{$sp->spMIll_Origin->mill_name ?? null}}
                                    </td>
                                    @break
                                @case('sp_amount')
                                    <td class="{{$column_chosen}}">
                                        ₱ {{$sp->$column_chosen}}
                                    </td>
                                    @break
                                @case('sp_collecting_officer')
                                    @php
                                        $spCollectingOfficer = $sp->spCollecting_Officer;
                                        $middleInitial = $spCollectingOfficer->middlename ? substr($spCollectingOfficer->middlename, 0, 1) . '.' : '';
                                        $fullName = $spCollectingOfficer->lastname . ', ' . $spCollectingOfficer->firstname . ' ' . $middleInitial;
                                    @endphp
                                    <td class="{{$column_chosen}}">
                                        {{$fullName}}
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
            <!-- Calculate total amount -->
            @php $totalAmount += $sp->sp_amount; @endphp
        @endforeach
        <!-- Total row -->
{{--        <tr>--}}
{{--            <th colspan="{{$colspan}}">Total:</th>--}}
{{--            <td>{{ $totalAmount }}</td> <!-- Display total amount -->--}}
{{--        </tr>--}}
    @endif

    </tbody>
</table>