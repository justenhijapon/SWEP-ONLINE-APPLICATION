<div class="btn-group">
    <button type="button" class="btn btn-default btn-sm participants_btn" data="{{$data->slug}}" data-toggle="modal" data-target ="#participants_modal" title="Participants" data-placement="left">
        <i class="fa fa-users"></i>
    </button>
    <button type="button" class="btn btn-default btn-sm show_other_btn" data="{{$data->slug}}" data-toggle="modal" data-target ="#show_scholars_modal" title="View more" data-placement="left">
        <i class="fa fa-file-text"></i>
    </button>
    <button type="button" data="{{$data->slug}}" class="btn btn-default btn-sm edit_other_btn" data-toggle="modal" data-target="#edit_other_modal" title="Edit" data-placement="top">
        <i class="fa fa-edit"></i>
    </button>
    <button type="button" data="{{$data->slug}}" class="btn btn-sm btn-danger" onclick="delete_data('{{$data->slug}}','{{route('dashboard.other_activities.destroy',$data->slug)}}')" data-toggle="tooltip" title="Delete" data-placement="top">
        <i class="fa fa-trash"></i>
    </button>
</div>