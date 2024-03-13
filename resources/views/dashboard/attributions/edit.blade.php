@php
    $rand = \Illuminate\Support\Str::random();
@endphp
<form id="edit_attributions_form_{{$rand}}" autocomplete="off">
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

        <div class="row">
            <div class="col-md-12">
                <div class="row">

                    {!! \App\Core\Helpers\__form2::textbox('activity',[
                        'label' => 'Activity:',
                        'cols' => 9,
                    ],$attributions ?? null) !!}

                    {!! \App\Core\Helpers\__form2::textbox('date',[
                    'label' => 'Date:',
                    'cols' => 3,
                    'type' => 'date',
                    ],$attributions ?? null) !!}

                </div>
                <div class="row">

                    {!! \App\Core\Helpers\__form2::select('project_code',[
                        'label' => 'Project Code:',
                        'cols' => 3,
                        'options' => \App\Core\Helpers\Arrays::projectCodes(),
                        'id' => 'project_code',
                    ],$attributions ?? null) !!}

                    {!! \App\Core\Helpers\__form2::textbox('utilized_fund',[
                        'label' => 'Utilized fund:',
                        'cols' => 3,
                        'class' => 'autonum',
                    ],$attributions ?? null) !!}

                    {!! \App\Core\Helpers\__form2::textbox('item',[
                        'label' => 'Item:',
                        'cols' => 3,
                    ],$attributions ?? null) !!}

                    {!! \App\Core\Helpers\__form2::textbox('venue',[
                        'label' => 'Venue:',
                        'cols' => 3,
                    ],$attributions ?? null) !!}

                </div>
                <div class="row">


                    {!! \App\Core\Helpers\__form2::textarea('details',[
                        'label' => 'Details:',
                        'cols' => 12,
                        'rows' => 2,

                    ],$attributions ?? null) !!}
                </div>

            </div>
        </div>

    </div>


    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn {!! __static::bg_color(Auth::user()->color) !!} pull-right update_attributions_btn"> <i class="fa fa-fw fa-save"></i> Save</button>
    </div>
</form>



<script type="text/javascript">

    autonum_settings = {
    currencySymbol : ' ₱',
    decimalCharacter : '.',
    digitGroupSeparator : ',',
};

$("#edit_attributions_form_{{$rand}} .autonum").each(function(){
    new AutoNumeric(this, autonum_settings);
})

$('#edit_attributions_form_{{$rand}} .select2').select2();

$("#edit_attributions_form_{{$rand}}").submit(function(e){
    let form = $(this);
    e.preventDefault();
    let uri = "{{ route('dashboard.attributions.update', 'slug') }}";
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
            attributions_table.draw(false);
            notify('Data successfully updated.','success');
        },
        error: function(res){
            errored(form,res);
        }
    })
})
</script>
