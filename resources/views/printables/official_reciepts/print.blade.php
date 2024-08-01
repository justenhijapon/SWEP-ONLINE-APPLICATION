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
            /*width: 100%;*/
            border-collapse: collapse;
            margin-top: 155px;
            /*margin-bottom: 100px;*/
            margin-right: 100px;
            margin-left: 20px;
        }

        table, td {
            /*border: 1px solid black;*/
            border-collapse: collapse;
            /*border: 1px solid black;*/
        }

        td{
            width: 100px;
            /*word-wrap: break-word;*/
            font-weight: bold;
            word-wrap: break-word;
            word-break: break-all;
        }


    </style>
</head>
<body>

<table>
    <tbody>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>{{ $print->or_no }}</td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td style="padding-bottom: 40px">{{ date('M d, Y', strtotime($print->or_date)) }}</td>
        <td></td>
    </tr>
    <tr>
        <td colspan="4" style="padding-left: 30px">{{ $print->or_payor }}</td>
        <td></td>
    </tr>
    <tr>
        <td colspan="5" style=" padding-bottom: 5px;"></td>
    </tr>
    <tr>
        <td></td>
        <td colspan="4" style="padding-bottom: 40px">{{ $print->orMIll_Origin->mill_code }}</td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td style="font-size: 12px;">SP NO.</td>
        <td style="font-size: 12px;">VOLUME</td>
        <td style="font-size: 12px;">AMOUNT</td>

    </tr>
    <tr style="height: 190px;">
        <td style="vertical-align: top; text-align: center;"></td>
        <td style="vertical-align: top; text-align: center;"></td>
        <td style="vertical-align: top; text-align: center;">
            @foreach($print->orUtilization as $orhippingpermit)
                {{$orhippingpermit->oru_sp_no}}<br>
            @endforeach
        </td>
        <td style="vertical-align: top; text-align: center;">
            @foreach($print->orUtilization as $orhippingpermit)
                {{$orhippingpermit->oru_volume}}<br>
            @endforeach
        </td>
        <td style="vertical-align: top; text-align: center;">
            @foreach($print->orUtilization as $orhippingpermit)
                {{$orhippingpermit->oru_amount}}<br>
            @endforeach
        </td>
    </tr>
    <tr>
        <td colspan="5" style=" padding-bottom: 5px;"></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td style="text-align: right;">SHP PRMT.</td>
        <td style="text-align: center;">{{ $print->or_total_amount ?? 0 }}</td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td style="text-align: center;">{{ $print->or_total_amount ?? 0 }}</td>
    </tr>
    <tr>
        <td></td>
        <td colspan="4" style="padding-bottom: 20px;">{{$translated ?? Zero }} PESOS ONLY</td>
    </tr>
    <tr>
        <td colspan="5" style=" padding-bottom: 10px;"></td>
    </tr>
    <tr>
        <td>X</td>
        <td colspan="4">{{$print->or_drawee_bank}}/CHECK#: {{$print->or_chk_no}}/CHECK DATE: {{ \Carbon\Carbon::parse($print->or_chk_date)->format('m/d/Y') }}</td>
    </tr>
    </tbody>
</table>
</body>
</html>
