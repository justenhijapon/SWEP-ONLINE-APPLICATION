<div class="btn-group">
    <button type="button" class="btn btn-default btn-sm view_seminar_btn" data="{{$data->slug}}" data-toggle="modal" data-target ="#view_seminar_modal" title="View more" data-placement="left">
        <i class="fa fa-file-text"></i>
    </button>
    <button type="button" data="{{$data->slug}}" class="btn btn-default btn-sm participant_btn" data-toggle="modal" data-target="#participant_modal" title="Participants" data-placement="top">
        <i class="fa fa-users"></i>
    </button>
    <button type="button" data="{{$data->slug}}" class="btn btn-default btn-sm edit_seminar_btn" data-toggle="modal" data-target="#edit_seminar_modal" title="Edit" data-placement="top">
        <i class="fa fa-edit"></i>
    </button>
    <button type="button" data="{{$data->slug}}" class="btn btn-sm btn-danger " onclick="delete_data('{{$data->slug}}','{{route('dashboard.seminar.destroy',$data->slug)}}')" data-toggle="tooltip" title="Delete" data-placement="top">
        <i class="fa fa-trash"></i>
    </button>
</div>