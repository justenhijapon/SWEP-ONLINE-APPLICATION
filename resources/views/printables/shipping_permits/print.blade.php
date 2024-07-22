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
            width: 100%;
            border-collapse: collapse;
        }

        table, td {
            /*border: 1px solid black;*/
            border-collapse: collapse;
            border: 1px solid black;
        }

        td{
            width: 100px;
            word-wrap: break-word;
        }


    </style>
</head>
<body>

<table style="width: 100%; table-layout: fixed;">
    <br><br><br><br><br>
    <tbody>
    <tr>
        <td>{{ $print->sp_port_of_origin }}</td>
        <td>{{ $print->sp_port_of_origin }}</td>
        <td>{{ $print->sp_freight }} {{ $print->sp_plate_no }}/ {{ $print->sp_vessel }}/</td>
        <td>{{ $print->sp_edd_etd }}</td>
        <td>{{ $print->sp_eda_eta }}</td>
    </tr>
    <tr>
        <td colspan="3" rowspan="2">{{ $print->spMIll_Origin->mill_name ?? null}}</td>
        <td style=" padding-left: 5px;"><?php if($print->sp_sugar_class == 'RAW') { echo '/'; } ?>&nbsp;</td>
        <td style=" font-weight: bold; padding-left: 5px;" ><?php if($print->sp_sugar_class == 'REFINED') { echo '/'; } ?>&nbsp;</td>
    </tr>
    <tr>
        <td style=" padding-left: 5px;"><?php if($print->sp_sugar_class == 'DIRECT CONSUMPTION') { echo '/'; } ?>&nbsp;</td>
        <td style=" padding-left: 5px;"><?php if($print->sp_sugar_class == 'OTHERS') { echo '/'; } ?>&nbsp;</td>
    </tr>
    <tr>
        <td colspan="3" rowspan="2">{{ $print->sp_markings }}</td>
        <td colspan="2">{{$translated}}</td>
    </tr>
    <tr>
        <td colspan="2">AND 00/100 ({{ $print->sp_volume }}) LKg BAGS</td>
    </tr>
    <tr>
        <td colspan="3">{{ $print->sp_shipper }}{{ $print->sp_shipper_tin }} </td>
        <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="3">{{ $print->sp_shipper_add }}</td>
        <td colspan="2" ></td>
    </tr>
    <tr>
        <td colspan="3">{{ $print->sp_consignee }}{{ $print->sp_consignee_tin }}</td>
        <td>{{ $print->sp_or_no }}</td>
        <td>{{ $print->sp_amount }}</td>
    </tr>
    <tr>
        <td colspan="3" >{{ $print->sp_consignee_add }}</td>
        <td colspan="2" style="font-size: small; padding-left: 5px; font-weight: bold;"></td>
    </tr>
    <tr>
        <td colspan="3" style="padding-left: 20px; font-weight: bold; color: red;"></td>
        @php
            $spCollectingOfficer = $print->spCollecting_Officer;
            $middleInitial = $spCollectingOfficer->middlename ? substr($spCollectingOfficer->middlename, 0, 1) . '.' : '';
            $fullName = $spCollectingOfficer->lastname . ', ' . $spCollectingOfficer->firstname . ' ' . $middleInitial;
        @endphp
        <td colspan="2
        " style="text-align: center">{{ $fullName }}</td>
    </tr>
    </tbody>
</table>
</body>
</html>
