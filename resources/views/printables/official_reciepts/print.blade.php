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
        <td>{{ $print->or_no }}</td>
    </tr>

    </tbody>
</table>
</body>
</html>
