<form id="edit_other_form" autocomplete="off" data="{{$other_activity->slug}}">
    @csrf
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"> {{$other_activity->activity}}</h4>
    </div>
    <div class="modal-body">
        <div class="row">
            {!! __form::textbox(
              '9 activity', 'activity', 'text', 'Activity *', 'Activity', $other_activity->activity, '', '', ''
            ) !!}

            {!! __form::textbox(
              '3 date', 'date', 'date', 'Date *', 'Date', $other_activity->date, '', '', ''
            ) !!}
        </div>
        <div class="row">
            @php
                $project_code = \App\Models\Projects::select(['project_code','activity'])->get();
            @endphp
            {!! __form::select_object_project_code(
              '3 project_code', 'project_code', 'Project Code', '', $project_code, $other_activity->project_code ,''
            ) !!}

            {!! __form::textbox(
              '3 utilized_fund', 'utilized_fund', 'text', 'Utilized Fund *', 'Utilized Fund', $other_activity->utilized_fund, '', '', '','autonum'
            ) !!}

            {!! __form::textbox(
              '3 item', 'item', 'text', 'Item *', 'Item', $other_activity->item, '', '', '',''
            ) !!}

            {!! __form::textbox(
              '3 venue', 'venue', 'text', 'Venue *', 'Venue', $other_activity->venue, '', '', ''
            ) !!}
        </div>
        <div class="row">
            {!! __form::native_textarea('12','details','Details',$other_activity->details,2,'') !!}
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="has_participants" value="1" {!! __form::markCheckBox($other_activity->has_participants) !!}> This activity involves participants
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

    $("#edit_other_form .autonum").each(function(){
        new AutoNumeric(this, autonum_settings);
    })

    $('#edit_other_form .select2').select2();
</script>