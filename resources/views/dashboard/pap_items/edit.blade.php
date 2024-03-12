@php
$rand = \Illuminate\Support\Str::random();
@endphp
@extends('layouts.modal-content2',['form_id' => 'edit_pap_item_form_'.$rand,'slug' => $pap_item->slug])

@section('modal-header')
    {{$pap_item->item}}
@endsection

@section('modal-body')
    <div class="row">
        {!! \App\Core\Helpers\__form2::textbox('item_no',[
            'label' => 'Item No.',
            'cols' => 3,
        ],$pap_item ?? null) !!}
        {!! \App\Core\Helpers\__form2::textbox('item',[
            'label' => 'Item',
            'cols' => 9,
        ],$pap_item ?? null) !!}
    </div>
    <div class="row">
        {!! \App\Core\Helpers\__form2::textbox('unit_cost',[
            'label' => 'Unit Cost',
            'cols' => 3,
            'class' => 'autonum',
        ],$pap_item ?? null) !!}
        {!! \App\Core\Helpers\__form2::textbox('qty',[
            'label' => 'Qty.',
            'cols' => 3,
        ],$pap_item ?? null) !!}
        {!! \App\Core\Helpers\__form2::textbox('uom',[
            'label' => 'UOM',
            'cols' => 3,
        ],$pap_item ?? null) !!}
        {!! \App\Core\Helpers\__form2::textbox('total_budget',[
            'label' => 'Total',
            'cols' => 3,
            'class' => 'autonum',
        ],$pap_item ?? null) !!}
    </div>
    <div class="row">
        {!! \App\Core\Helpers\__form2::textbox('mop',[
            'label' => 'Mode of Proc.',
            'cols' => 6,
        ],$pap_item ?? null) !!}
    </div>

@endsection

@section('modal-footer')
    <button class="btn btn-sm btn-primary" type="submit"><i class="fa fa-check"></i> Save</button>
@endsection

@section('scripts')
    <script type="text/javascript">
        $("#edit_pap_item_form_{{$rand}}").submit(function (e) {
            e.preventDefault();
            let form = $(this);
            let uri = '{{route("dashboard.pap_items.update","slug")}}';
            uri = uri.replace('slug',form.attr('data'));
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
                    active = res.slug;
                    papItems_tbl.draw(false);
                    toast('info','','Updated');
                },
                error: function (res) {
                    errored(form,res);
                }
            })
        
        })
    </script>
@endsection

