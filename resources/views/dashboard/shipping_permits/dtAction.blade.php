<div class="btn-group">
{{--    <button type="button" data="{{$data->slug}}" class="btn btn-default btn-sm print_shipping_permits_btn" onclick="window.location='{{route('printables.index',$data->slug)}}'" title="test" data-placement="top">--}}
{{--        <i class="fa fa-print"></i>--}}
{{--    </button>--}}
    <button type="button" data="{{$data->slug}}" class="btn btn-default btn-sm edit_shipping_permits_btn" data-toggle="modal" data-target="#edit_shipping_permits_modal" title="Edit" data-placement="top">
        <i class="fa fa-edit"></i>
    </button>
    <button type="button" data="{{$data->slug}}" class="btn btn-sm btn-danger" onclick="delete_data('{{$data->slug}}','{{route('dashboard.shipping_permits.destroy',$data->slug)}}')" data-toggle="tooltip" title="Delete" data-placement="top">
        <i class="fa fa-trash"></i>
    </button>
    <div class="btn-group">
        <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown">
            <span class="caret"></span></button>
        <ul class="dropdown-menu dropdown-menu-right" role="menu">
            <?php if($data->sp_status == 'PENDING'): ?>
            <li><a href="#" data="{{$data->slug}}"  name="{{strtoupper($data->sp_no)}}" class="psc" status="shipped" >Shipped</a>
            <li><a href="#" data="{{$data->slug}}"  name="{{strtoupper($data->sp_no)}}" class="psc" status="cancelled" >Cancelled</a>
            <?php elseif($data->sp_status == 'SHIPPED'): ?>
            <li><a href="#" data="{{$data->slug}}"  name="{{strtoupper($data->sp_no)}}" class="psc" status="pending" >Pending</a>
            <li><a href="#" data="{{$data->slug}}"  name="{{strtoupper($data->sp_no)}}" class="psc" status="cancelled" >Cancelled</a>
            <?php elseif($data->sp_status == 'CANCELLED'): ?>
            <li><a href="#" data="{{$data->slug}}"  name="{{strtoupper($data->sp_no)}}" class="psc" status="shipped" >Shipped</a>
            <li><a href="#" data="{{$data->slug}}"  name="{{strtoupper($data->sp_no)}}" class="psc" status="pending" >Pending</a>
            <?php endif; ?>
        </ul>
    </div>
</div>