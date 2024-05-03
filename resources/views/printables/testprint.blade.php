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

        .sp-header{
            text-align: center;
        }

        .logo {
            display: inline-block;
            vertical-align: middle;
        }

        #title {
            text-align: center;
            vertical-align: middle;
            display: inline-block;
        }

        #title h4 {
            margin: 0; /* Removes the default margin */
            padding: 0; /* Removes any default padding */
        }

        .sp-copy{
            text-align: right;
        }

        /*.tb2, td{*/
        /*    border: 1px solid black;*/
        /*}*/

        date{
            text-align: right;
            display: inline-block;
        }

        table, td {
            /*border: 1px solid black;*/
            border-collapse: collapse;

        }

        td{
            width: 100px;
        }

        .borderlr{
            border-left: 1px solid black;
            border-right: 1px solid black;
        }

        .bordertp{
            border-left: 1px solid black;
            border-right: 1px solid black;
            border-top: 1px solid black;
        }
        img {
            border-radius: 4px;
            padding: 5px;
            width: 150px;
        }

    </style>
</head>
<body>
<div class="sp-copy">
    <h4>TRADER'S COPY</h4>
</div>
<div class="sp-header">
    <img src="{{URL::asset('/images/sra.png')}}" class="logo" />
    <div id="title">
        <h4>REPUBLIC OF THE PHILIPPINES</h4>
        <h4>SUGAR REGULATORY ADMINISTRATION</h4>
        <h4>SUGAR CENTER BLDG, NORTH AVE., DILIMAN QUEZON CITY</h4>
        <h4>REGULATION DEPARTMENT</h4>
        <h4>TIN : 000-784-336</h4>
        <h2>PERMIT TO SHIP SUGAR WITHIN PHILIPPINE TERRITORY</h2>
    </div>
</div>
<br>
<br><br><br>
<table style="width: 100%;">
    <tbody>
        <tr>
            <td colspan="3" style="padding-left: 20px; font-weight: bold;">TO: SHIPPING CO./ AIRCRAFT OPERATOR, BUREAU OF CUSTOMS,</td>
            <td colspan="2"></td>
        </tr>

        <tr>
            <td colspan="3" style="padding-left: 50px; font-weight: bold;" >PHILIPPINE COAST GUARD& PHILIPPINE PORTS AUTHORITY</td>
            <td colspan="2" style="text-align: center; font-weight: bold;">DATE <u>{{ $test->sp_date }} </u></td>

        </tr>
        <tr>
            <td colspan="5" style="padding: 2px;" class="bordertp" ></td>
        </tr>
        <tr>
            <td colspan="5" style="padding-left: 20px; color: red; font-weight: bold;" class="bordertp" >THIS OFFICE CLEARS THE FOLLOWING SHIPMENT OF SUGAR COASTWISE WITHIN PHILIPPINE TERRITORY ONLY:</td>
        </tr>
        <tr>
            <td colspan="5" style="padding: 2px;" class="bordertp" ></td>
        </tr>
        <tr>
            <td style="width: 3%; padding-left: 5px;" class="bordertp ">PORT OF ORIGIN</td>
            <td style="width: 3%; padding-left: 5px;" class="bordertp">PORT DESTINATION</td>
            <td style="width: 8%; padding-left: 5px;" class="bordertp">NAME OF SHIP/VESSEL</td>
            <td style="width: 2%; padding-left: 5px;" class="bordertp">EDD/ETD</td>
            <td style="width: 2%; padding-left: 5px;" class="bordertp">EDA/ETA</td>
        </tr>
        <tr>
            <td class="borderlr">{{ $test->portOfOrigin->port_name }}</td>
            <td class="borderlr">{{ $test->portOfDestination->port_name }}</td>
            <td class="borderlr">{{ $test->sp_freight }} {{ $test->sp_plate_no }}/ {{ $test->sp_vessel }}/</td>
            <td class="borderlr">{{ $test->sp_edd_etd }}</td>
            <td class="borderlr">{{ $test->sp_eda_eta }}</td>

        </tr>
        <tr>
            <td colspan="3" class="bordertp" style="font-weight: bold; padding-left: 5px;">ORIGIN:(IF IMPORTED, INDICATE CONTROL NO. & DATE OF SRA CLEARANCE AND SPECIFY IF LOCAL OR IMPORTED)</td>
            <td colspan="2" class="bordertp" style="text-align: center; font-weight: bold;">KIND OF SUGAR</td>

        </tr>
        <tr>
            <td colspan="3" class="borderlr">{{ $test->spMIll_Origin->name }}</td>
            <td style="border-top: 1px solid black; font-weight: bold; padding-left: 5px;"><input type="checkbox">RAW</td>
            <td style="border-top: 1px solid black; border-right: 1px solid black; font-weight: bold; padding-left: 5px;" ><input type="checkbox">REFINED</td>
        </tr>
        <tr>
            <td colspan="3" class="borderlr">&nbsp;</td>
            <td style="font-weight: bold; padding-left: 5px;"><input type="checkbox"> DIRECT CONSUMPTION</td>
            <td style="border-right: 1px solid black; font-weight: bold; padding-left: 5px;"><input type="checkbox">OTHERS</td>
        </tr>

        <tr>
            <td colspan="3" class="bordertp" style="font-weight: bold; padding-left: 5px;">MARKING ON BAG:</td>
            <td colspan="2" class="bordertp" style="border-bottom: 1px solid black; text-align: center; font-weight: bold;">QUANTITY(in L-Kg bags in words and figures)</td>

        </tr>
        <tr>
            <td colspan="3" class="borderlr" >{{ $test->sp_markings }}</td>
            <td colspan="2" class="borderlr" style="border-bottom: 1px dotted black ">{{$translated}}</td>


        </tr>
        <tr>
            <td colspan="3" class="borderlr">&nbsp;</td>
            <td colspan="2" class="borderlr" style="border-bottom: 1px dotted black ">AND 00/100 ({{ $test->sp_volume }}) LKg BAGS</td>

        </tr>
        <tr>
            <td colspan="3" class="bordertp" style="font-weight: bold; padding-left: 5px;">TRADER'S NAME, ADDRESS AND TIN</td>
            <td colspan="2" class="borderlr" style="border-bottom: 1px dotted black ">&nbsp;</td>

        </tr>
        <tr>
            <td colspan="3" class="borderlr">{{ $test->sp_shipper }};TIN {{ $test->sp_shipper_tin }} </td>
            <td colspan="2" class="borderlr" style="border-bottom: 1px dotted black ">&nbsp;</td>


        </tr>
        <tr>
            <td colspan="3" class="borderlr">{{ $test->sp_shipper_add }}</td>
            <td colspan="2" class="borderlr" ></td>


        </tr>

        <tr>
            <td colspan="3" class="bordertp" style="font-weight: bold; padding-left: 5px;">CONSIGNEE'S NAME, ADDRESS AND TIN</td>
            <td class="bordertp" style="font-weight: bold; text-align: center; font-size: small;">OFFICIAL RECIEPT NO.</td>
            <td class="bordertp" style="font-weight: bold; text-align: center; font-size: small;">AMOUNT PAID (Php)</td>
        </tr>
        <tr>
            <td colspan="3" class="borderlr">{{ $test->sp_consignee }};TIN {{ $test->sp_consignee_tin }}</td>
            <td class="borderlr">{{ $test->sp_or_no }}</td>
            <td class="borderlr">{{ $test->sp_amount }}</td>
        </tr>
        <tr>
            <td colspan="3" class="borderlr" >{{ $test->sp_consignee_add }}</td>
            <td colspan="2" class="bordertp" style="font-size: small; padding-left: 5px; font-weight: bold;">SIGNATURE OVER PRINTED NAME & TITLE</td>
        </tr>
        <tr>
            <td colspan="3" class="bordertp" style="padding-left: 5px;"><b>TO TRADER/SHIPPING CO.</b> Please present this permit to BUREAU OF CUSTOMS,</td>
            <td colspan="2" rowspan="3" class="borderlr"></td>
        </tr>
        <tr>
            <td colspan="3" class="borderlr" style="padding-left: 50px;">PHILIPPINE COAST GUARD & PHILIPPINE PORTS AUTHORITY when required to do so.</td>

        </tr>
        <tr>
            <td colspan="3" class="borderlr"></td>

        </tr>
        <tr>
            <td colspan="3" class="bordertp" style="padding-left: 20px; font-weight: bold; color: red;">IMPORTANT: 1. ANY ERASURE/ALTERATION SHALL RENDER THIS PERMIT INVALID.</td>
            <td colspan="3" class="borderlr" style="text-align: center">PLACEHOLDER COLLECTING OFFICER</td>

        </tr>
        <tr>
            <td colspan="3" class="borderlr" style="padding-left: 125px; font-weight: bold; color: red;">2. THIS PERMIT IS GOOD FOR ONE TIME SHIPMENT ONLY.</td>
            <td colspan="2" class="borderlr" style="font-weight: bold; text-align: center; font-size: small; text-decoration: overline;">AUTHORIZED SRA REGULATION OFFICER</td>
        </tr>
        <tr>
            <td colspan="3" class="borderlr" style="padding-left: 125px; font-weight: bold; color: red; border-bottom: 1px solid black">3. EXPIRY DATE OF THIS PERMIT IS 15 DAYS AFTER ISSUANCE.</td>
            <td colspan="2" style="border-top: 1px solid black; font-size: small; padding-left: 5px; font-weight: bold;" > SRA SHIPPING PERMIT NO.</td>
        </tr>

    </tbody>

</table>
<table style="width: 100%" class="tb2">
    <tbody>
    <tr>
        <td style="font-size: small; padding-left: 10px" >DISTRIBUTION OF COPIES:</td>
        <td style="font-size: small">1. Gray - Trader</td>
        <td style="font-size: small">3. Pink - Shipping Company</td>
        <td style="font-size: small" >5. Orange - Phil Coast Guard</td>
        <td style="font-size: small" >7. Green - SPRO File</td>
        <td style="font-size: xxx-large; width: 26%; font-weight: bold; text-align: center" rowspan="3" >{{ $test->sp_no }}</td>
    </tr>
    <tr>
        <td></td>
        <td style="font-size: small" >2. Violet - Consignee</td>
        <td style="font-size: small">4. Blue - Bureau of Customs</td>
        <td style="font-size: small">6. Yellow - PPA at Port of Origin</td>
        <td style="font-size: small">8. White - SRA Q.C.</td>

    </tr>
    <tr>
        <td>FM-REG-SRE-<u>012</u>.Rev. 00</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>

    </tr>
    <tr>
        <td>Effective Date:March 12,2025</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>

    </tr>

    </tbody>
</table>

</body>
</html>
