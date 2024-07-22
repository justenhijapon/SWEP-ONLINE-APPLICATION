<div class="btn-group">
    <button type="button" data="{{$data->slug}}" class="btn btn-default btn-sm print_official_reciepts_btn" onclick="printOfficialReceipt('{{$data->slug}}')" data-toggle="tooltip" title="Print" data-placement="top">
        <i class="fa fa-print"></i>
    </button>
    <button type="button" data="{{$data->slug}}" class="btn btn-default btn-sm edit_official_reciepts_btn" data-toggle="modal" data-target="#edit_official_reciepts_modal" title="Edit" data-placement="top">
        <i class="fa fa-edit"></i>
    </button>
    <button type="button" data="{{$data->slug}}" class="btn btn-sm btn-danger" onclick="delete_data('{{$data->slug}}','{{route('dashboard.official_reciepts.destroy',$data->slug)}}')" data-toggle="tooltip" title="Delete" data-placement="top">
        <i class="fa fa-trash"></i>
    </button>
</div>