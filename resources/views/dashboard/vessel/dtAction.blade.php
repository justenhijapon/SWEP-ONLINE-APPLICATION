<div class="btn-group">
    <button type="button" data="{{$data->slug}}" class="btn btn-default btn-sm edit_vessel_btn" data-toggle="modal" data-target="#edit_vessel_modal" title="Edit" data-placement="top">
        <i class="fa fa-edit"></i>
    </button>
    <button type="button" data="{{$data->slug}}" class="btn btn-sm btn-danger" onclick="delete_data('{{$data->slug}}','{{route('dashboard.vessel.destroy',$data->slug)}}')" data-toggle="tooltip" title="Delete" data-placement="top">
        <i class="fa fa-trash"></i>
    </button>
</div>