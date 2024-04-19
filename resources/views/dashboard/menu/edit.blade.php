@php
  $rand = \Illuminate\Support\Str::random();
@endphp
<form id="edit_menu_form_{{$rand}}" autocomplete="off">
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
        {!! \App\Core\Helpers\__form2::textbox('name',[
            'label' => 'Name:',
            'cols' => 12,
        ],$menu ?? null) !!}
        {!! \App\Core\Helpers\__form2::textbox('route',[
            'label' => 'Route:',
            'cols' => 12,
        ],$menu ?? null) !!}
        {!! \App\Core\Helpers\__form2::select('category',[
            'label' => 'Category:',
            'options' => ['SU' => 'SUPER USER','ADMIN' => 'ADMIN','U' => 'USER'],
            'cols' => 12,
        ],$menu ?? null) !!}
        {!! \App\Core\Helpers\__form2::textbox('icon',[
            'label' => 'Icon:',
            'cols' => 12,
        ],$menu ?? null) !!}

        {!! \App\Core\Helpers\__form2::select('is_menu',[
             'label' => 'Is Menu:',
             'options' => ['0' => 'No','1' => 'Yes'],
             'cols' => 12,
        ],$menu ?? null) !!}

        {!! \App\Core\Helpers\__form2::select('is_dropdown',[
             'label' => 'Is Dropdown:',
             'options' => ['0' => 'No','1' => 'Yes'],
             'cols' => 12,
        ],$menu ?? null) !!}

      </div>
    </div>

  </div>


  <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <button type="submit" class="btn {!! __static::bg_color(Auth::user()->color) !!} pull-right update_menu_btn"> <i class="fa fa-fw fa-save"></i> Save</button>
  </div>
</form>



<script type="text/javascript">

  autonum_settings = {
    currencySymbol : ' ₱',
    decimalCharacter : '.',
    digitGroupSeparator : ',',
  };

  $("#edit_menu_form_{{$rand}} .autonum").each(function(){
    new AutoNumeric(this, autonum_settings);
  })

  $('#edit_menu_form_{{$rand}} .select2').select2();

  $("#edit_menu_form_{{$rand}}").submit(function(e){
    let form = $(this);
    e.preventDefault();
    let uri = "{{ route('dashboard.menu.update', 'slug') }}";
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
        menu_tbl.draw(false);
        notify('Data successfully updated.','success');
      },
      error: function(res){
        errored(form,res);
      }
    })
  })

</script>


