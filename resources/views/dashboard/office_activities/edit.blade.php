@php
    $rand = \Illuminate\Support\Str::random(10);
    $project_code = \App\Models\Projects::select(['project_code','activity'])->get();
@endphp
<form id="edit_other_form_{{$rand}}" autocomplete="off" data="{{$oa->slug}}">
    @csrf
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"> {{$oa->activity}}</h4>
    </div>
    <div class="modal-body">
        <div class="row">
            {!! __form::textbox(
              '9 activity', 'activity', 'text', 'Activity *', 'Activity', $oa->activity, '', '', ''
            ) !!}

            {!! __form::textbox(
              '3 date', 'date', 'date', 'Date *', 'Date', $oa->date, '', '', ''
            ) !!}
        </div>
        <div class="row">
            {!! __form::select_object_project_code(
              '4 project_code', 'project_code', 'Project Code', '', $project_code, $oa->project_code ,''
            ) !!}

            {!! __form::textbox(
              '4 utilized_fund', 'utilized_fund', 'text', 'Utilized Fund *', 'Utilized Fund', $oa->utilized_fund, '', '', '','autonum'
            ) !!}

            {!! __form::textbox(
              '4 venue', 'venue', 'text', 'Venue *', 'Venue', $oa->venue, '', '', ''
            ) !!}
        </div>
        <div class="row">
            {!! __form::native_textarea('12','details','Details',$oa->details,2,'') !!}
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="has_participants" value="1" {!! __form::markCheckBox($oa->has_participants) !!}> This activity involves participants
            </label>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button type="submit" class="btn {!! __static::bg_color(Auth::user()->color) !!}"> <i class="fa fa-check"></i> Save</button>
    </div>
</form>

<script type="text/javascript">
    autonum_settings = {
        currencySymbol : ' ₱',
        decimalCharacter : '.',
        digitGroupSeparator : ',',
    };

    $("#edit_other_form_{{$rand}} .autonum").each(function(){
        new AutoNumeric(this, autonum_settings);
    })

    $('#edit_other_form_{{$rand}} .select2').select2();

    $("#edit_other_form_{{$rand}}").submit(function(e){
        e.preventDefault();
        form = $(this)
        loading_btn(form);
        uri = "{{ route('dashboard.office_activities.update','slug') }}";
        uri = uri.replace('slug',form.attr('data'));
        $.ajax({
            url: uri,
            data: $(this).serialize(),
            type: 'PUT',
            dataType: 'json',
            success: function(response){
                succeed(form,true,true);
                active = response.slug
                office_activities_tbl.draw(false);
            },
            error: function(response){
                console.log(response);
                errored(form ,response);
            }

        })
    });
</script>