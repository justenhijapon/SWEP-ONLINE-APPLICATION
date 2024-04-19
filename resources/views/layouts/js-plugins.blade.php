

<script type="text/javascript" src="{{ asset('template/bower_components/jquery/dist/jquery.min.js') }}"></script>  

<script type="text/javascript" src="{{ asset('template/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('template/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('template/bower_components/fastclick/lib/fastclick.js') }}"></script>

<script type="text/javascript" src="{{ asset('template/bower_components/select2/dist/js/select2.full.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('template/bower_components/ckeditor/ckeditor.js') }}"></script>

<script type="text/javascript" src="{{ asset('template/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>





<script type="text/javascript" src="{{ asset('template/plugins/pjax/jquery.pjax.js') }}"></script>

<script type="text/javascript" src="{{ asset('template/plugins/toast/jquery.toast.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('template/plugins/price-format/jquery.priceformat.min.js') }}"></script>

{{-- <script type="text/javascript" src="{{ asset('template/plugins/icheck/icheck.js') }}"></script> --}}

<script type="text/javascript" src="{{ asset('template/plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('template/plugins/bootstrap-fileinput/js/fileinput.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('template/dist/js/adminlte.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>


{{-- Charts --}}
<script type="text/javascript" src="{{ asset('template/bower_components/Flot/jquery.flot.js') }}"></script>

<script type="text/javascript" src="{{ asset('template/bower_components/Flot/jquery.flot.resize.js') }}"></script>

<script type="text/javascript" src="{{ asset('template/bower_components/Flot/jquery.flot.pie.js') }}"></script>

<script type="text/javascript" src="{{ asset('template/bower_components/Flot/jquery.flot.categories.js') }}"></script>


<script type="text/javascript" src="{{ asset('template/plugins/chartjs/dist/Chart.min.js') }}"></script>




{{-- Notify --}}
<script type="text/javascript" src="{{ asset('template/plugins/bootstrap-notify/bootstrap-notify.min.js') }}"></script>

{{-- DataTable --}}
<script type="text/javascript" src="{{asset('template/plugins/DataTables/datatables.min.js')}}"></script>

<script src="{{asset('template/plugins/DataTables/Buttons-1.6.1/js/buttons.bootstrap.min.js')}}"></script>
<script src="{{asset('template/plugins/DataTables/Buttons-1.6.1/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('template/plugins/DataTables/Buttons-1.6.1/js/buttons.print.min.js')}}"></script>
<script src="{{asset('template/plugins/DataTables/Buttons-1.6.1/js/buttons.colVis.min.js')}}"></script>
<script src="{{asset('template/plugins/DataTables/JSZip-2.5.0/jszip.min.js')}}"></script>
<script src="{{asset('template/plugins/DataTables/pdfmake-0.1.36/pdfmake.min.js')}}"></script>
<script src="{{asset('template/plugins/DataTables/pdfmake-0.1.36/vfs_fonts.js')}}"></script>
<script src="{{asset('template/plugins/DataTables/Select-1.3.1/js/dataTables.select.min.js')}}"></script>
<script src="{{asset('template/plugins/DataTables/RowGroup-1.1.1/js/dataTables.rowGroup.min.js')}}"></script>

{{-- Moment --}}
<script type="text/javascript" src="{{asset('template/plugins/moment/moment.js')}}"></script>

{{-- Date Range --}}
<script type="text/javascript" src="{{ asset('template/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>



{{-- DataTable Date Render --}}
<script type="text/javascript" src="{{asset('template/plugins/dataTables-date/dt-date.js')}}"></script>

{{-- JQuery Confirm --}}
<script type="text/javascript" src="{{asset('template/plugins/jquery-confirm/js/jquery-confirm.js')}}"></script>

{{-- AutoNumeric --}}
<script type="text/javascript" src="{{asset('template/plugins/autonum/main.js')}}"></script>

{{-- Pace --}}
<script type="text/javascript" src="{{asset('template/bower_components/PACE/pace.min.js')}}"></script>

{{-- Draggable --}}
<script type="text/javascript" src="{{asset('template/plugins/jquery-sortable/source/js/jquery-sortable-min.js')}}"></script>

{{--  EXCEL EDITABLE --}}
{{-- <script type="text/javascript" src="{{asset('template/plugins/excel-editable/dist/js/excel-table.js')}}"></script> --}}

{{--  TYPEAHEAD --}}
<script type="text/javascript" src="{{asset('template/plugins/typeahead/js/bootstrap-typeahead.min.js')}}"></script>

{{--  Cropper --}}
<script type="text/javascript" src="{{asset('template/plugins/cropperjs/dist/cropper.js')}}"></script>

{{-- SWAL2 --}}
<script type="text/javascript" src="{{asset('template/plugins/swal2/dist/sweetalert2.all.min.js')}}"></script>

<script type="text/javascript">
    $(document).ready(function () {


        $('.select2').select2();


    })

    var link = window.location.href;
    var href  = $("a[href='"+link+"']");
    if(href.hasClass('btn') == false){
        href.closest('li').addClass('active');
        href.closest('ul').css('display','block');
        href.closest('.treeview').addClass('menu-open');
    }

</script>

{{-- BS MODAL --}}
{{-- <script type="text/javascript" src="{{asset('template/plugins/bootstrap-modal/js/bootstrap-modal.js')}}"></script>
<script type="text/javascript" src="{{asset('template/plugins/bootstrap-modal/js/bootstrap-modalmanager.js')}}"></script> --}}
