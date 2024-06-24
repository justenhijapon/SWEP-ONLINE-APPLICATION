<div class="btn-group">
{{--    <button type="button" data="{{$data->slug}}" class="btn btn-default btn-sm print_shipping_permits_btn" onclick="printShippingPermits('{{$data->slug}}')" title="test" data-placement="top">--}}
{{--        <i class="fa fa-print"></i>--}}
{{--    </button>--}}
    <button type="button" data="{{$data->slug}}" class="btn btn-default btn-sm print_shipping_permits_btn" onclick="printShippingPermit('{{$data->slug}}')" data-toggle="tooltip" title="Print" data-placement="top">
        <i class="fa fa-print"></i>
    </button>
    <button type="button" data="{{$data->slug}}" class="btn btn-default btn-sm edit_shipping_permits_btn" data-toggle="modal" data-target="#edit_shipping_permits_modal" title="Edit" data-placement="top">
        <i class="fa fa-edit"></i>
    </button>
    <button type="button" data="{{$data->slug}}" class="btn btn-sm btn-danger" onclick="delete_data('{{$data->slug}}','{{route('dashboard.shipping_permits.destroy',$data->slug)}}')" data-toggle="tooltip" title="Delete" data-placement="top">
        <i class="fa fa-trash"></i>
    </button>
    <div class="btn-group">
        <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" title="Change Status">
            <span class="caret"></span></button>
        <ul class="dropdown-menu dropdown-menu-right" role="menu">
            <?php
            switch($data->sp_status) {
                case '114370':
                case '125093':
                ?>
            <li><a href="#" data="<?php echo $data->slug; ?>" name="<?php echo strtoupper($data->sp_no); ?>" class="psc" status="CANCELLATION">CANCELLATION</a></li>
            <li><a href="#" data="<?php echo $data->slug; ?>" name="<?php echo strtoupper($data->sp_no); ?>" class="psc" status="CANCELLED">CANCELLED</a></li>
            <li><a href="#" data="<?php echo $data->slug; ?>" name="<?php echo strtoupper($data->sp_no); ?>" class="psc" status="CANCELLED ERROR IN PRINT">CANCELLED ERROR IN PRINT</a></li>
            <li><a href="#" data="<?php echo $data->slug; ?>" name="<?php echo strtoupper($data->sp_no); ?>" class="psc" status="ISSUED">ISSUED</a></li>
            <li><a href="#" data="<?php echo $data->slug; ?>" name="<?php echo strtoupper($data->sp_no); ?>" class="psc" status="RETURN SHIPMENT">RETURN SHIPMENT</a></li>
            <li><a href="#" data="<?php echo $data->slug; ?>" name="<?php echo strtoupper($data->sp_no); ?>" class="psc" status="SHUT-OUT">SHUT-OUT</a></li>
            <li><a href="#" data="<?php echo $data->slug; ?>" name="<?php echo strtoupper($data->sp_no); ?>" class="psc" status="TRANSHIPMENT">TRANSHIPMENT</a></li>
            <li><a href="#" data="<?php echo $data->slug; ?>" name="<?php echo strtoupper($data->sp_no); ?>" class="psc" status="W/ TRANSHIPMENT">W/ TRANSHIPMENT</a></li>
                <?php
                break;
                case 'CANCELLATION':
                case 'CANCELLED':
                case 'CANCELLED ERROR IN PRINT':
                ?>

            <li><a href="#" data="<?php echo $data->slug; ?>" name="<?php echo strtoupper($data->sp_no); ?>" class="psc" status="114370">114370</a></li>
            <li><a href="#" data="<?php echo $data->slug; ?>" name="<?php echo strtoupper($data->sp_no); ?>" class="psc" status="125093">125093</a></li>
            <li><a href="#" data="<?php echo $data->slug; ?>" name="<?php echo strtoupper($data->sp_no); ?>" class="psc" status="ISSUED">ISSUED</a></li>
            <li><a href="#" data="<?php echo $data->slug; ?>" name="<?php echo strtoupper($data->sp_no); ?>" class="psc" status="RETURN SHIPMENT">RETURN SHIPMENT</a></li>
            <li><a href="#" data="<?php echo $data->slug; ?>" name="<?php echo strtoupper($data->sp_no); ?>" class="psc" status="SHUT-OUT">SHUT-OUT</a></li>
            <li><a href="#" data="<?php echo $data->slug; ?>" name="<?php echo strtoupper($data->sp_no); ?>" class="psc" status="TRANSHIPMENT">TRANSHIPMENT</a></li>
            <li><a href="#" data="<?php echo $data->slug; ?>" name="<?php echo strtoupper($data->sp_no); ?>" class="psc" status="W/ TRANSHIPMENT">W/ TRANSHIPMENT</a></li>
                <?php
                break;
                case 'ISSUED':
                case 'RETURN SHIPMENT':
                case 'SHUT-OUT':
                case 'TRANSHIPMENT':
                case 'W/ TRANSHIPMENT':
                ?>
            <li><a href="#" data="<?php echo $data->slug; ?>" name="<?php echo strtoupper($data->sp_no); ?>" class="psc" status="114370">114370</a></li>
            <li><a href="#" data="<?php echo $data->slug; ?>" name="<?php echo strtoupper($data->sp_no); ?>" class="psc" status="125093">125093</a></li>
            <li><a href="#" data="<?php echo $data->slug; ?>" name="<?php echo strtoupper($data->sp_no); ?>" class="psc" status="CANCELLATION">CANCELLATION</a></li>
            <li><a href="#" data="<?php echo $data->slug; ?>" name="<?php echo strtoupper($data->sp_no); ?>" class="psc" status="CANCELLED">CANCELLED</a></li>
            <li><a href="#" data="<?php echo $data->slug; ?>" name="<?php echo strtoupper($data->sp_no); ?>" class="psc" status="CANCELLED ERROR IN PRINT">CANCELLED ERROR IN PRINT</a></li>
                <?php
                break;
            default:
                ?>
            <li><a href="#" data="<?php echo $data->slug; ?>" name="<?php echo strtoupper($data->sp_no); ?>" class="psc" status="114370">114370</a></li>
            <li><a href="#" data="<?php echo $data->slug; ?>" name="<?php echo strtoupper($data->sp_no); ?>" class="psc" status="125093">125093</a></li>
            <li><a href="#" data="<?php echo $data->slug; ?>" name="<?php echo strtoupper($data->sp_no); ?>" class="psc" status="CANCELLATION">CANCELLATION</a></li>
            <li><a href="#" data="<?php echo $data->slug; ?>" name="<?php echo strtoupper($data->sp_no); ?>" class="psc" status="CANCELLED">CANCELLED</a></li>
            <li><a href="#" data="<?php echo $data->slug; ?>" name="<?php echo strtoupper($data->sp_no); ?>" class="psc" status="CANCELLED ERROR IN PRINT">CANCELLED ERROR IN PRINT</a></li>
            <li><a href="#" data="<?php echo $data->slug; ?>" name="<?php echo strtoupper($data->sp_no); ?>" class="psc" status="ISSUED">ISSUED</a></li>
            <li><a href="#" data="<?php echo $data->slug; ?>" name="<?php echo strtoupper($data->sp_no); ?>" class="psc" status="RETURN SHIPMENT">RETURN SHIPMENT</a></li>
            <li><a href="#" data="<?php echo $data->slug; ?>" name="<?php echo strtoupper($data->sp_no); ?>" class="psc" status="SHUT-OUT">SHUT-OUT</a></li>
            <li><a href="#" data="<?php echo $data->slug; ?>" name="<?php echo strtoupper($data->sp_no); ?>" class="psc" status="TRANSHIPMENT">TRANSHIPMENT</a></li>
            <li><a href="#" data="<?php echo $data->slug; ?>" name="<?php echo strtoupper($data->sp_no); ?>" class="psc" status="W/ TRANSHIPMENT">W/ TRANSHIPMENT</a></li>
                <?php
                break;
            }
            ?>


        </ul>
    </div>
</div>