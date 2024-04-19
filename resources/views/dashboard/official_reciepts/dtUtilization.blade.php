<table style="font-size: 12px!important; width: 100%">

    <tbody>
    <tr>
        <td colspan="4" class="text-center text-strong">Shipping Permit No.:</td>
        <td colspan="4" class="text-center text-strong">Utilization:</td>


    </tr>

    <tr>
        <td colspan="4" class="text-center">
            @foreach($shippingpermit as $orhippingpermit)
                {{$orhippingpermit->sp_no}}<br>
            @endforeach
        </td>
        <td colspan="4" class="text-center">
            @foreach($utilization as $orUtilization)
                {{$orUtilization->oru_sp_no}}<br>
            @endforeach
        </td>
    </tr>

    </tbody>
</table>