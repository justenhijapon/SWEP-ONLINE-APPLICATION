@php
    $rand = \Illuminate\Support\Str::random();
@endphp
<form id="edit_mill_form_{{$rand}}" autocomplete="off">
    @csrf
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Reciept Details</h4>
    </div>

    <div class="modal-body">
        @method('PUT')
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="row">

                        {!! \App\Core\Helpers\__form2::textbox('mill_code',[
                             'label' => 'Mill Code:',
                             'cols' => 6,
                         ],$mill ?? null) !!}
                        {!! \App\Core\Helpers\__form2::textbox('mill_name',[
                             'label' => 'Descriptive Name:',
                             'cols' => 12,
                         ],$mill ?? null) !!}
                        {!! \App\Core\Helpers\__form2::textbox('mill_address',[
                            'label' => 'Address:',
                            'cols' => 12,
                        ],$mill ?? null) !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p class="no-margin">
                                            <b>Add Item</b>
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <button id="add_row_item_edit_{{$rand}}" type="button" class="btn btn-xs btn-success pull-right">Add Item &nbsp;<i class="fa fw fa-plus"></i></button>
                                    </div>
                                </div>

                            </div>
                            <div class="panel-body">
                                <table class="table table-bordered" id="edit_utilization_table_{{$rand}}">

                                    <thead>
                                    <tr>
                                        <th style="width: 20%">Markings Code</th>
                                        <th style="width: 70%">Description</th>
                                        <th style="width: 10%"></th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($mill->millUtilization as $key => $millUtilization)
                                        <tr>
                                            <td>
                                                {!! \App\Core\Helpers\__form2::textboxOnly('items['.$millUtilization->mu_mill_code.'][mu_marking_code]',[
                                                    'label' => 'Marking Code:',
                                                ],$millUtilization->mu_marking_code ?? null) !!}
                                            </td>
                                            <td>{!! \App\Core\Helpers\__form2::textarea('items['.$millUtilization->mu_mill_code.'][mu_description]',[
                                                    'label' => 'Description:',
                                                 ],$millUtilization->mu_description ?? null) !!}
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-sm bg-red delete_row_item">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="submit" class="btn {!! __static::bg_color(Auth::user()->color) !!}"><i class="fa fa-save"></i> Save</button>
        </div>
    </div>
</form>




<script type="text/javascript">

    autonum_settings = {
        currencySymbol : ' ₱',
        decimalCharacter : '.',
        digitGroupSeparator : ',',
    };

    $("#edit_mill_form_{{$rand}} .autonum").each(function(){
        new AutoNumeric(this, autonum_settings);
    })

    $('#edit_mill_form_{{$rand}} .select2').select2();

    $("#edit_mill_form_{{$rand}}").submit(function(e){
        let form = $(this);
        e.preventDefault();
        let uri = "{{ route('dashboard.mill.update', 'slug') }}";
        uri = uri.replace('slug',id);
        let formData = new FormData(this);
        $.ajax({
            url: uri,
            data: formData,
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(res){
                succeed(form,true,true);

                active = res.slug;
                mill_table.draw(false);
                notify('Data successfully updated.','success');
            },
            error: function(res){
                errored(form,res);
            }
        })
    })

    $("#add_row_item_edit_{{$rand}}").click(function(){
        console.log(1);
        let rowTemplate = $("#item_template").html();
        let random = makeId(10);
        rowTemplate = rowTemplate.replaceAll('rand',random);

        $("#edit_utilization_table_{{$rand}} tbody").append(rowTemplate);
        $(".autonum_"+ random).each(function(){
            $(this).attr('autocomplete','off');
            new AutoNumeric(this, autonum_settings);
        });
    })

</script>


