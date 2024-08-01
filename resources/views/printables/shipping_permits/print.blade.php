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
            margin-top: 145px;
            margin-bottom: 100px;
            margin-right: 20px;
            margin-left: 25px;
        }

        table, td {
            /*border: 1px solid black;*/
            border-collapse: collapse;
            /*border: 1px solid black;*/
        }

        td{
            width: 100px;
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
            <td style="width: 20%"></td>
            <td style="width: 20%"></td>
            <td style="width: 30%;"></td>
            <td style="width: 15%"></td>
            <td style="width: 15%"></td>
        </tr>
        <tr>
            <td colspan="5" style=" padding-bottom: 25px; padding-right: 40px; text-align: right;">{{ \Carbon\Carbon::parse($print->sp_date)->format('M j, Y') }}</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td style="font-size: small" colspan="3">{{ $print->sp_freight }} {{ $print->sp_plate_no }}/ </td>
        </tr>
        <tr>
            <td style="text-align: right; font-size: small">{{ $print->sp_port_of_origin }}</td>
            <td style="text-align: right; font-size: small">{{ $print->sp_port_of_origin }}</td>
            <td style="text-align: center;">{{ $print->sp_vessel }}/</td>
            <td>{{ \Carbon\Carbon::parse($print->sp_edd_etd)->format('m/d/Y') }}</td>
            <td>{{ \Carbon\Carbon::parse($print->sp_eda_eta)->format('m/d/Y') }}</td>
        </tr>
        <tr>
            <td colspan="3" rowspan="2" style="padding-left: 50px;">{{ $print->spMIll_Origin->mill_name ?? null }}</td>
            <td style="padding-left: 5px;">
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

        <tr>
            <td colspan="5" style=" padding-bottom: 10px;"></td>
        </tr>
        <tr>
            <td colspan="3" rowspan="2" style=" padding-left: 50px; ">{{ $print->sp_markings }}</td>
            <td colspan="2">{{$translated}}</td>
        </tr>
        <tr>
            <td colspan="2" style="font-size: smaller;">AND 00/100 ({{ $print->sp_volume }}) LKg BAGS</td>
        </tr>
        <tr>
            <td colspan="5" style=" padding-bottom: 7px;"></td>
        </tr>
        <tr>
            <td colspan="3" style=" padding-left: 50px; ">{{ $print->sp_shipper }}{{ $print->sp_shipper_tin }} </td>
            <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="3" style=" padding-left: 50px; ">{{ $print->sp_shipper_add }}</td>
            <td colspan="2" ></td>
        </tr>
        <tr>
            <td colspan="5" style=" padding-bottom: 5px;"></td>
        </tr>
        <tr>
            <td colspan="3" style=" padding-left: 50px; ">{{ $print->sp_consignee }}{{ $print->sp_consignee_tin }}</td>
            <td style="text-align: center;" >{{ $print->sp_or_no }}</td>
            <td >{{ $print->sp_amount }}</td>
        </tr>
        <tr>
            <td colspan="3" style=" padding-left: 50px; ">{{ $print->sp_consignee_add }}</td>
            <td colspan="2" style="font-size: small; padding-left: 5px; font-weight: bold;"></td>
        </tr>
        <tr>
            <td colspan="5" style=" padding-bottom: 10px;"></td>
        </tr>
        <tr>
            <td colspan="3" style="font-weight: bold; color: red;"></td>
            @php
                $spCollectingOfficer = $print->spCollecting_Officer;
                $middleInitial = $spCollectingOfficer->middlename ? substr($spCollectingOfficer->middlename, 0, 1) . '.' : '';
                $fullName = $spCollectingOfficer->lastname . ', ' . $spCollectingOfficer->firstname . ' ' . $middleInitial;
            @endphp
            <td colspan="2" style="text-align: center; font-size: smaller;">{{ $fullName }}</td>
        </tr>
        <tr>
            <td colspan="3" style="font-weight: bold; color: red;"></td>
            <td colspan="2" style="text-align: center; font-size: smaller;">{{$print->spCollecting_Officer->position }}</td>
        </tr>
    </tbody>
</table>
</body>
</html>
