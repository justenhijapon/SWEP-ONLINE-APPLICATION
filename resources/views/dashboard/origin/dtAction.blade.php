<div class="btn-group">
    <button type="button" data="{{$data->slug}}" class="btn btn-default btn-sm edit_origin_btn" data-toggle="modal" data-target="#edit_origin_modal" title="Edit" data-placement="top">
        <i class="fa fa-edit"></i>
    </button>
    <button type="button" data="{{$data->slug}}" class="btn btn-sm btn-danger" onclick="delete_data('{{$data->slug}}','{{route('dashboard.origin.destroy',$data->slug)}}')" data-toggle="tooltip" title="Delete" data-placement="top">
        <i class="fa fa-trash"></i>
    </button>
</div>