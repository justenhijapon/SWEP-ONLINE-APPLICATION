<div class="btn-group">


    <button data="{{$data->slug}}" type="button"  class="btn btn-default btn-sm edit_item_btn" title="Edit" data-placement="top" data-toggle="modal" data-target="#edit_item_modal">
        <i class="fa fa-edit"></i>
    </button>
    <button type="button" data="Zrbvub2EJl9PCETv" onclick="delete_data('{{$data->slug}}','{{route('dashboard.pap_items.update',$data->slug)}}')" class="btn btn-sm btn-danger delete_jo_employee_btn" data-toggle="tooltip" title="" data-placement="top" data-original-title="Delete">
        <i class="fa fa-trash"></i>
    </button>

</div>