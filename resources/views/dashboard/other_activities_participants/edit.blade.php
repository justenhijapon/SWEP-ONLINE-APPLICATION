@php($rand = \Illuminate\Support\Str::random(10))
@extends('layouts.modal-content')
@section('form-open')
    <form id="edit_aop_form_{{$rand}}" data="{{$oap->slug}}">
@endsection
@section('title')
    {{$oap->lastname}}, {{$oap->firstname}}
@endsection

@section('body')
    <div class="row">
        {!! __form::textbox(
          '4 firstname', 'firstname', 'text', 'First Name *', 'First Name', $oap->firstname, '', '', ''
        ) !!}

        {!! __form::textbox(
          '4 middlename', 'middlename', 'text', 'Middle Name', 'Middle Name', $oap->middlename, '', '', ''
        ) !!}

        {!! __form::textbox(
          '4 lastname', 'lastname', 'text', 'Last Name *', 'Last Name', $oap->lastname, '', '', ''
        ) !!}
    </div>
    <div class="row">
        {!! __form::select_static(
            '4 sex', 'sex', 'Sex: *', $oap->sex , [
                'MALE' => 'MALE',
                'FEMALE' => 'FEMALE',
            ] , '', '', '', ''
          ) !!}

        {!! __form::textbox(
          '4 age', 'age', 'number', 'Age *', 'Age', $oap->age, '', '', ''
        ) !!}

        {!! __form::select_static(
            '4 group', 'group', 'Group: *', $oap->group , [
                'SC' => 'SC',
                'PWD' => 'PWD',
                'IP' => 'IP',
            ] , '', '', '', ''
          ) !!}
    </div>
@endsection

@section('footer')
    <button class="btn btn-primary" type="submit"><i class="fa fa-check"></i> Save</button>
@endsection

@section('form-close')
    </form>
@endsection

@section('script')
    <script type="text/javascript">
        $("#edit_aop_form_{{$rand}}").submit(function (e) {
            e.preventDefault();
            var form = $(this);
            var uri = "{{route('dashboard.other_activities_participants.update','slug')}}";
            var uri = uri.replace('slug','{{$oap->slug}}');
            loading_btn(form);
            $.ajax({
                url : uri,
                data : form.serialize(),
                type: 'PATCH',
                headers: {
                    {!! __html::token_header() !!}
                },
                success: function (res) {
                    succeed(form,true,true);
                   oa_participants_active = res.slug
                    oa_participants_tbl.draw(false);
                },
                error: function (res) {
                    errored(form,res);
                    console.log(res);
                }
            })
        })
    </script>
@endsection

