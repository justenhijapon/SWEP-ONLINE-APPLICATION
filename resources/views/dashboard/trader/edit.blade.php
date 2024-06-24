@php
    $rand = \Illuminate\Support\Str::random();
@endphp
<form id="edit_trader_form_{{$rand}}" autocomplete="off">
    @csrf
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit</h4>
    </div>

    <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <code class="pull-right">Fields with asterisks(*) are required</code>
            </div>
        </div>


        @method('PUT')

        <div class="col-md-12">
            <div class="row">
                {!! \App\Core\Helpers\__form2::textbox('trader_id',[
                    'label' => 'Trader ID:',
                    'cols' => 6,
                    'type' => 'number',
                ],$trader ?? null) !!}
                {!! \App\Core\Helpers\__form2::textbox('trader_name',[
                    'label' => 'Name:',
                    'cols' => 12,
                ],$trader ?? null) !!}
                {!! \App\Core\Helpers\__form2::textbox('trader_address',[
                    'label' => 'Business Address:',
                    'cols' => 12,
                ],$trader ?? null) !!}
                {!! \App\Core\Helpers\__form2::textbox('trader_tin',[
                    'label' => 'TIN:',
                    'cols' => 12,
                    'type' => 'number',
                ],$trader ?? null) !!}


            </div>
        </div>

    </div>


    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn {!! __static::bg_color(Auth::user()->color) !!} pull-right update_trader_btn"> <i class="fa fa-fw fa-save"></i> Save</button>
    </div>
</form>



<script type="text/javascript">

    autonum_settings = {
        currencySymbol : ' ₱',
        decimalCharacter : '.',
        digitGroupSeparator : ',',
    };

    $("#edit_trader_form_{{$rand}} .autonum").each(function(){
        new AutoNumeric(this, autonum_settings);
    })

    $('#edit_trader_form_{{$rand}} .select2').select2();

    $("#edit_trader_form_{{$rand}}").submit(function(e){
        let form = $(this);
        e.preventDefault();
        let uri = "{{ route('dashboard.trader.update', 'slug') }}";
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
                trader_table.draw(false);
                notify('Data successfully updated.','success');
            },
            error: function(res){
                errored(form,res);
            }
        })
    })

</script>


