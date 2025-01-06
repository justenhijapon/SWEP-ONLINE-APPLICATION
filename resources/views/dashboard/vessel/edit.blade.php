@php
    $rand = \Illuminate\Support\Str::random();
@endphp
<form id="edit_vessel_form_{{$rand}}" autocomplete="off">
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
{{--                {!! \App\Core\Helpers\__form2::textbox('vessel_id',[--}}
{{--                    'label' => 'Vessel:',--}}
{{--                    'cols' => 6,--}}
{{--                    'type' => 'number'--}}
{{--                ],$vessel ?? null) !!}--}}
                {!! \App\Core\Helpers\__form2::textbox('vessel_description',[
                    'label' => 'Vessel:',
                    'cols' => 12,
                ],$vessel ?? null) !!}
                {!! \App\Core\Helpers\__form2::textbox('vessel_ship_operator',[
                    'label' => 'Ship Operator:',
                    'cols' => 12,
                ],$vessel ?? null) !!}


            </div>
        </div>

    </div>


    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn {!! __static::bg_color(Auth::user()->color) !!} pull-right update_vessel_btn"> <i class="fa fa-fw fa-save"></i> Save</button>
    </div>
</form>



<script type="text/javascript">

    autonum_settings = {
        currencySymbol : ' ₱',
        decimalCharacter : '.',
        digitGroupSeparator : ',',
    };

    $("#edit_vessel_form_{{$rand}} .autonum").each(function(){
        new AutoNumeric(this, autonum_settings);
    })

    $('#edit_vessel_form_{{$rand}} .select2').select2();

    $("#edit_vessel_form_{{$rand}}").submit(function(e){
        let form = $(this);
        e.preventDefault();
        let uri = "{{ route('dashboard.vessel.update', 'slug') }}";
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
                vessel_table.draw(false);
                notify('Data successfully updated.','success');
            },
            error: function(res){
                errored(form,res);
            }
        })
    })

</script>


