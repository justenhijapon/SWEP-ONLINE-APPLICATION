<div class="btn-group">
    <a type="button" class="btn btn-default btn-sm" href="{{route('dashboard.pap_items.index',$data->pap_code)}}" title="" data-placement="left" data-original-title="View items">
        <i class="fa fa-file-text"></i>
    </a>

    <a href="http://hrrs.sra.gov.ph/dashboard/employee/Zrbvub2EJl9PCETv/edit?page=0" for="linkToEdit" type="button" data="Zrbvub2EJl9PCETv" class="btn btn-default btn-sm edit_jo_employee_btn" title="Edit" data-placement="top">
        <i class="fa fa-edit"></i>
    </a>
    <button type="button" data="Zrbvub2EJl9PCETv" onclick="delete_data('Zrbvub2EJl9PCETv','http://hrrs.sra.gov.ph/dashboard/employee/slug')" class="btn btn-sm btn-danger delete_jo_employee_btn" data-toggle="tooltip" title="" data-placement="top" data-original-title="Delete">
        <i class="fa fa-trash"></i>
    </button>
    <div class="btn-group btn-group-sm" role="group">
        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu dropdown-menu-right">
            <li><a href="#" data-toggle="modal" data-target="#service_records_modal" class="service_records_btn" data="Zrbvub2EJl9PCETv" data-original-title="" title=""><i class="fa icon-service-record"></i> Service Records</a></li>
            <li><a href="#" data-toggle="modal" data-target="#trainings_modal" class="trainings_btn" data="Zrbvub2EJl9PCETv" data-original-title="" title=""><i class="fa icon-seminar"></i> Trainings</a></li>
            <li><a href="#" data-toggle="modal" data-target="#credentials_modal" class="credentials_btn" data="Zrbvub2EJl9PCETv" data-original-title="" title=""><i class="fa swep-certificate"></i> Credentials</a></li>
            <li><a href="#" data-toggle="modal" data-target="#matrix_modal" class="matrix_btn" data="Zrbvub2EJl9PCETv" data-original-title="" title=""><i class="fa fa-dashboard"></i> Matrix</a></li>
            <li><a href="#" uri="http://hrrs.sra.gov.ph/dashboard/file201" data-toggle="modal" data-target="#file201_modal" class="file201_btn" data="Zrbvub2EJl9PCETv" data-original-title="" title=""><i class="fa fa-folder"></i> 201 File</a></li>
            <li><a href="#" employee="ABACAN, LEILANI" class="bm_uid_btn" data="Zrbvub2EJl9PCETv" bm_uid="0"><i class="fa icon-ico-fingerprint"></i> Biometric User ID</a></li>
            <li><a href="#" data-toggle="modal" data-target="#other_hr_actions_modal" class="other_actions_btn" data="Zrbvub2EJl9PCETv" data-original-title="" title=""><i class="fa icon-service-record"></i> Other HR Actions</a></li>
            <li><a target="_blank" href="http://hrrs.sra.gov.ph/dashboard/employee/Zrbvub2EJl9PCETv/qr" class="other_actions_btn" data="Zrbvub2EJl9PCETv"><i class="fa fa-qrcode"></i> Get QR Code</a></li>
        </ul>
    </div>
</div>