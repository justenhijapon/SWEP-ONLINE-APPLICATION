<table class="dt-table" style="width: 100%">
    <tbody>
    <tr>
        <td>
            Volume:
        </td>
        <td>
            {{$data->sp_volume ?? null}}
        </td>
    </tr>
    <tr>
        <td>
            OR Number:
        </td>
        <td>
            {{$data->sp_or_no ?? null}}
        </td>
    </tr>
    <tr>
        <td>
            EDD/ETD:
        </td>
        <td>
            {{$data->sp_edd_etd ?? null}}
        </td>
    </tr>
    <tr>
        <td>
            EDA/ETA:
        </td>
        <td>
            {{$data->sp_eda_eta ?? null}}
        </td>
    </tr>
    <tr>
        <td>
            Sugar Class:
        </td>
        <td>
            {{$data->sp_sugar_class ?? null}}
        </td>
    </tr>
    <tr>
        <td>
            Vessel:
        </td>
        <td>
            {{$data->sp_vessel ?? null}}
        </td>
    </tr>
    <tr>
        <td>
            Ship Operator:
        </td>
        <td>
            {{$data->sp_ship_operator ?? null}}
        </td>
    </tr>
    </tbody>
</table>