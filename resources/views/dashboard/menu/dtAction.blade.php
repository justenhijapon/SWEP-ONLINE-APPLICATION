<div class="btn-group">
    <button type="button" class="btn btn-default btn-sm list_submenus_btn" data="{{$data->slug}}" data-toggle="modal" data-target ="#list_submenus" title="Submenus" data-placement="left">
        <i class="fa fa-list"></i>
    </button>
    <button type="button" data="{{$data->slug}}" class="btn btn-default btn-sm edit_menu_btn" data-toggle="modal" data-target="#edit_menu_modal" title="Edit" data-placement="top">
        <i class="fa fa-edit"></i>
    </button>
    <button type="button" data="{{$data->slug}}" class="btn btn-sm btn-danger "onclick="delete_data('{{$data->slug}}','{{route('dashboard.menu.destroy',$data->slug)}}')" data-toggle="tooltip" title="Delete" data-placement="top">
        <i class="fa fa-trash"></i>
    </button>
</div>
