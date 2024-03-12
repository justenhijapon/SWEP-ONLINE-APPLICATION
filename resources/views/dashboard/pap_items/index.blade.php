@extends('layouts.admin-master')

@section('content')

<section class="content-header">
    <h1>{{$pap->pap_code }} | <span style="font-size: 16px">{{$pap->pap_title}}</span></h1>
</section>
@endsection
@section('content2')

<section class="content">
    <div class="box box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">PAP Items</h3>
            <button class="pull-right btn btn-sm btn-primary" data-toggle="modal" data-target="#add_item_modal"><i class="fa fa-plus"></i> Add Item</button>
        </div>
        <div class="box-body">
            <table id="pap_items_table" class="table table-bordered table-condensed table-striped" style="width: 100%">
                <thead>
                <tr>
                    <th>Item No.</th>
                    <th>Item</th>
                    <th>Unit Cost</th>
                    <th>Qty</th>
                    <th>UOM</th>
                    <th>Total Budget</th>
                    <th>Action</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>

</section>


@endsection


@section('modals')
<div class="modal fade" id="add_item_modal" tabindex="-1" role="dialog" aria-labelledby="add_item_modal_label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form id="add_item_form">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">Item Details</h4>
          </div>
          <div class="modal-body">
              <div class="row">
                  {!! \App\Core\Helpers\__form2::textbox('item_no',[
                      'label' => 'Item No.',
                      'cols' => 3,
                  ]) !!}
                  {!! \App\Core\Helpers\__form2::textbox('item',[
                      'label' => 'Item',
                      'cols' => 9,
                  ]) !!}
              </div>
              <div class="row">
                  {!! \App\Core\Helpers\__form2::textbox('unit_cost',[
                      'label' => 'Unit Cost',
                      'cols' => 3,
                      'class' => 'autonum',
                  ]) !!}
                  {!! \App\Core\Helpers\__form2::textbox('qty',[
                      'label' => 'Qty.',
                      'cols' => 3,
                  ]) !!}
                  {!! \App\Core\Helpers\__form2::select('uom',[
                      'label' => 'UOM',
                      'cols' => 3,
                      'options' => \App\Core\Helpers\Arrays::unitsOfMeasurement(),
                  ]) !!}
                  {!! \App\Core\Helpers\__form2::textbox('total_budget',[
                      'label' => 'Total',
                      'cols' => 3,
                      'class' => 'autonum',
                  ]) !!}
              </div>
              <div class="row">
                  {!! \App\Core\Helpers\__form2::select('mop',[
                      'label' => 'Mode of Proc.',
                      'cols' => 6,
                      'options' => \App\Core\Helpers\Arrays::modesOfProcurement(),
                  ]) !!}
              </div>
          </div>
          <div class="modal-footer">
              <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-check"></i> Save changes</button>
          </div>
      </form>
    </div>
  </div>
</div>
    {!! \App\Core\ViewHelpers\__html::blank_modal('edit_item_modal','') !!}
@endsection

@section('scripts')
<script type="text/javascript">

    active = '';
    papItems_tbl = $("#pap_items_table").DataTable({
        'dom' : 'lBfrtip',
        "processing": true,
        "serverSide": true,
        "ajax" : '{{\Illuminate\Support\Facades\Request::getUri()}}',
        "columns": [
            { "data": "item_no" },
            { "data": "item" },
            { "data": "unit_cost" },
            { "data": "qty" },
            { "data": "uom" },
            { "data": "total_budget" },
            { "data": "action"}
        ],
        "buttons": [

        ],
        "columnDefs":[
            {
                "targets" : 6,
                "orderable" : false,
                "searchable": false,
                "class" : 'action4'
            },
            {
                targets: [2,5],
                class: 'text-right w-10p',
                render: $.fn.dataTable.render.number(',','.',3,''),
            },
            {
                targets: [0,4],
                class: 'w-6p',
            },
            {
                targets: 3,
                class: 'text-center w-10p',
            }

        ],
        "responsive": true,
        "initComplete": function( settings, json ) {
            // console.log(settings);
            setTimeout(function () {
                $("#filter_form select[name='is_active']").val('ACTIVE');
                $("#filter_form select[name='is_active']").trigger('change');
            },100);

            setTimeout(function () {
                // $('a[href="#advanced_filters"]').trigger('click');
                $('.advanced_filters_toggler').trigger('click');
            },1000);

            $('#tbl_loader').fadeOut(function(){
                $("#pap_items_table_container").fadeIn();
                if(find != ''){
                    papItems_tbl.search(find).draw();
                    setTimeout(function(){
                        active = '';
                    },3000);
                    window.history.pushState({}, document.title, "/dashboard/employee");
                }
            });
        },
        "language":
            {
                "processing": "<center><img style='width: 70px' src='http://hrrs.sra.gov.ph/images/loader.gif'></center>",
            },
        "drawCallback": function(settings){
            // console.log(papItems_tbl.page.info().page);
            $("#pap_items_table a[for='linkToEdit']").each(function () {
                let orig_uri = $(this).attr('href');
                $(this).attr('href',orig_uri+'?page='+papItems_tbl.page.info().page);
            });

            $('[data-toggle="tooltip"]').tooltip();
            $('[data-toggle="modal"]').tooltip();
            if(active != ''){
                $("#pap_items_table #"+active).addClass('success');
            }
        }
    })

    style_datatable("#pap_items_table");

    //Need to press enter to search
    $('#pap_items_table_filter input').unbind();
    $('#pap_items_table_filter input').bind('keyup', function (e) {
        if (e.keyCode == 13) {
            papItems_tbl.search(this.value).draw();
        }
    });


    $("#add_item_form").submit(function (e) {
        e.preventDefault()
        let form = $(this);
        loading_btn(form);
        $.ajax({
            url : '{{route("dashboard.pap_items.store",$pap->pap_code)}}',
            data : form.serialize(),
            type: 'POST',
            headers: {
                {!! __html::token_header() !!}
            },
            success: function (res) {
                active = res.slug;
                papItems_tbl.draw(false);
                succeed(form,true,false);
                notify('Item successfully added.','success');
            },
            error: function (res) {
                errored(form,res);
            }
        })
    })

    $("body").on("click",".edit_item_btn",function () {
        let btn = $(this);
        load_modal2(btn);
        let uri = '{{route("dashboard.pap_items.edit","slug")}}';
        uri = uri.replace('slug',btn.attr('data'));
        $.ajax({
            url : uri,
            type: 'GET',
            headers: {
                {!! __html::token_header() !!}
            },
            success: function (res) {
                populate_modal2(btn,res);
            },
            error: function (res) {
                populate_modal2_error(res);
            }
        })
    })
</script>
@endsection