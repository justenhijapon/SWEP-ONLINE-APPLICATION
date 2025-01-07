<!DOCTYPE html>
<html>
<head>
    <title>Print</title>
    <style>
        @media print {
            @page {
                size: A4;
                margin: 0;
            }
            .content-container {
                width: 105mm; /* Half the width of A4 */
                height: 148.5mm; /* Half the height of A4 */
                margin: 0 auto; /* Center the content container */
                transform: scale(0.5); /* Scale down the content */
                transform-origin: top left; /* Ensure scaling starts from the top left */
            }
        }

        table {
            table-layout: fixed;
            border-collapse: collapse;
            margin-top: 130px;
            margin-bottom: 100px;
            margin-right: 20px;
            margin-left: 40px;
        }

        table, td {
            border: 1px solid black;
            border-collapse: collapse;
            /*border: 1px solid black;*/
            color:black;
            font-family: Cambria;
        }

        td{
            /*width: 100px;*/
            word-wrap: break-word;
            word-break: break-all;
            font-weight: bold;
        }

    </style>
</head>
<body>

<table>
    <tbody>
        <tr>
            <td style="width: 143px"></td>
            <td style="width: 144px"></td>
            <td style="width: 203px;"></td>
            <td style="width: 90px"></td>
            <td style="width: 100px;"></td>
        </tr>
        <tr>
            <td colspan="5" style=" padding-bottom: 25px; padding-right: 30px; text-align: right;">{{ \Carbon\Carbon::parse($print->sp_date)->format('M j, Y') }}</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td style="font-size: 10px; height: 15.5px; text-align: right; padding-right: 20px">{{ $print->sp_vessel }}/</td>
        </tr>
        <tr>
            <td style="text-align: left; font-size: small; vertical-align: top">{{ $print->sp_port_of_origin }}</td>
            <td style="text-align: center; font-size: small;  vertical-align: top">{{ $print->sp_port_of_destination }}</td>
            <td style="text-align: center; font-size: 10px; height: 30px; max-height: 30px; vertical-align: top">{{ $print->sp_freight }}/{{ $print->sp_plate_no }}/{{ $print->sp_ship_operator }}</br></td>
            <td style="font-size: 13px; vertical-align: top">{{ \Carbon\Carbon::parse($print->sp_edd_etd)->format('m/d/Y') }}</td>
            <td style="font-size: 13px; vertical-align: top">{{ \Carbon\Carbon::parse($print->sp_eda_eta)->format('m/d/Y') }}</td>
        </tr>
{{--        <tr>--}}
{{--            <td></td>--}}
{{--            <td></td>--}}
{{--            <td style="font-size: small" colspan="3"><br></td>--}}
{{--        </tr>--}}

{{--        <tr>--}}
{{--            <td colspan="5" style="height: 7px"></td>--}}
{{--        </tr>--}}
        <tr>
            <td colspan="3" rowspan="2" style="padding-left: 50px;">{{ $print->spMIll_Origin->mill_name ?? null }}</td>
            <td style="padding-left: 5px; font-size: 13px">
                <?php if(in_array($print->sp_sugar_class, ['RAW', 'A', 'B', 'BD', 'C', 'D', 'E', 'F'])) { echo '/ RAW'; } ?>&nbsp;
            </td>
            <td style="font-weight: bold; padding-left: 5px;">
                <?php if($print->sp_sugar_class == 'REFINED') { echo '/ REFINED'; } ?>&nbsp;
            </td>
        </tr>
        <tr>
            <td style="padding-left: 5px;">
                <?php if($print->sp_sugar_class == 'DIRECT CONSUMPTION') { echo '/ DIRECT CONSUMPTION'; } ?>&nbsp;
            </td>
            <td style="padding-left: 5px;">
                <?php if(in_array($print->sp_sugar_class, ['OTHERS', 'MUSCOVADO'])) { echo '/ OTHERS'; } ?>&nbsp;
            </td>
        </tr>

{{--        <tr>--}}
{{--            <td colspan="5" style="height: 4px"></td>--}}
{{--        </tr>--}}

        @php
            $words = explode(' ', $print->sp_markings); // Split the string into an array of words
            $halfIndex = ceil(count($words) / 2); // Calculate the halfway point
            $firstHalf = implode(' ', array_slice($words, 0, $halfIndex)); // First half of the words
            $secondHalf = implode(' ', array_slice($words, $halfIndex)); // Second half of the words
        @endphp

        <tr>
            <td colspan="3" rowspan="2" style="font-size: 13px; padding-left: 50px; height: 38px">
                {{ $firstHalf }}<br>{{ $secondHalf }}
            </td>
            <td colspan="2" rowspan="4" style="font-size: 13px; padding-top: 5px; vertical-align: top">
                {{$translated}}
                <br>
                AND 00/100 ({{ $print->sp_volume }}) LKg BAGS
            </td>
        </tr>
        <tr>

        </tr>
        <tr>
            <td colspan="3" style="height: 4px"></td>
        </tr>
        <tr>
            <td colspan="3" style=" padding-left: 50px; font-size: 13px">{{ $print->sp_shipper }}{{ $print->sp_shipper_tin }} </td>

        </tr>
        <tr>
            <td colspan="3" style=" padding-left: 50px; font-size: 13px">{{ $print->sp_shipper_add }}</td>

        </tr>
        <tr>
            <td colspan="5" style=" height: 10px;"></td>
        </tr>
        <tr>
            <td colspan="3" style=" padding-left: 50px; font-size: 13px">{{ $print->sp_consignee }}{{ $print->sp_consignee_tin }}, {{ $print->sp_consignee_add }}</td>
            <td style="text-align: center; vertical-align: top; padding-right: 5px">{{ $print->sp_or_no }}</td>
            <td style="vertical-align: top">{{ number_format($print->sp_amount, 2) }}</td>
        </tr>
{{--        <tr>--}}
{{--            <td colspan="3" style=" padding-left: 50px; "><br></td>--}}
{{--            <td colspan="2" style="font-size: small; padding-left: 5px; font-weight: bold;"></td>--}}
{{--        </tr>--}}
        <tr>
            <td colspan="5" style=" padding-bottom: 10px;"></td>
        </tr>
        <tr>
            <td colspan="3" style="font-weight: bold; color: red; font-size: 13px"></td>
            @php
                $spCollectingOfficer = $print->spCollecting_Officer;
                $middleInitial = $spCollectingOfficer->middlename ? substr($spCollectingOfficer->middlename, 0, 1) . '.' : '';
                $fullName = $spCollectingOfficer->lastname . ', ' . $spCollectingOfficer->firstname . ' ' . $middleInitial;
            @endphp
            <td colspan="2" style="text-align: left; padding-left: 25px; font-size: smaller;">{{ $fullName }}</td>
        </tr>
        <tr>
            <td colspan="3" style="font-weight: bold; color: red;"></td>
            <td colspan="2" style="text-align: center; padding-right: 30px; font-size: 13px">{{$print->spCollecting_Officer->position }}</td>
        </tr>
    </tbody>
</table>
</body>
</html>
