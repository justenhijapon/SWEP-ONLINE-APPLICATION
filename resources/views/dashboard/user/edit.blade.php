<form id="edit_user_form" data="{{ $user->slug}}">

  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">{{ $user->lastname }}, {{ $user->firstname }}</h4>
  </div>
  <div class="modal-body">
   @php
      $this_user_has = [];
      foreach ($user->userSubmenu as $menu) {
          array_push($this_user_has, $menu->submenu_id);
       
      }
      //print_r($this_user_has);
      $this_user_has = collect($this_user_has);

    @endphp

    <div class="box-body">                  
      

      <div class="row">
          {!! __form::textbox(
            '4 firstname', 'firstname', 'text', 'Firstname *', 'Firstname', $user->firstname, 'e_firstname', '', ''
          ) !!}

          {!! __form::textbox(
            '4 middlename', 'middlename', 'text', 'Middlename *', 'Middlename',  $user->middlename, 'e_middlename', '', ''
          ) !!}

          {!! __form::textbox(
            '4 lastname', 'lastname', 'text', 'Lastname *', 'Lastname',  $user->lastname, 'e_lastname', '', ''
          ) !!}

      </div>

      <div class="row">
          {!! __form::textbox(
            '6 email', 'email', 'email', 'Email *', 'Email', $user->email, 'e_email', '', ''
          ) !!}

          {!! __form::textbox(
            '6 position', 'position', 'text', 'Position *', 'Position',  $user->position, 'e_position', '', ''
          ) !!}
      </div>



      <div class="row">
        <div class="col-sm-12">
          <h4 style="font-weight: bold">User Menu
            <span class="pull-right ">
              <small class="text-info">You can use CTRL & SHIFT keys for multiple selection. CTRL+A to select all.</small>
            </span>
           </h4>
          <hr style="margin: 0 0 10px 0">
        </div>

        @php
          $menusByCategory = $menus->groupBy('category');
        @endphp

        @foreach ($menusByCategory as $category => $submenus)
          <div class="col-md-12">
            @switch($category)
              @case('SU')
                <h4>Super User</h4>
                <hr style="margin: 0 0 10px 0">
                @break
              @case('U')
                <h4>User</h4>
                <hr style="margin: 0 0 10px 0">
                @break
              @case('ADMIN')
                <h4>Admin</h4>
                <hr style="margin: 0 0 10px 0">
                @break
              @default
                <h4>{{ $category }}</h4>
                <hr style="margin: 0 0 10px 0">
            @endswitch
          <div class="row">
            @foreach ($submenus as $key => $sub)
              <div class="col-md-4">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <i class="fa {{ $sub->icon }}"></i>
                    {{ $sub->name }}
                    <div class="pull-right">
                      <button class="btn btn-xs btn-default clear_btn" type="button">Clear</button>
                    </div>
                  </div>
                  <div class="panel-body" style="min-height: 180px">
                    <div class="row">
                      <div class="col-sm-12">
                        @if($sub->submenu->isEmpty())
                          <center>
                            <label>No submenu found for this Menu</label>
                          </center>
                        @else
                          <select multiple name="submenus[]" class="form-control select_multiple" size="6">
                            @foreach($sub->submenu as $key2 => $submenu)
                              <option value="{{$submenu->submenu_id}}" @if ($this_user_has->contains($submenu->submenu_id)) selected @endif>
                                {{ str_replace($sub->name,'', $submenu->name) }}
                              </option>
                            @endforeach
                          </select>
                          <span class="help-block">No module selected</span>
                        @endif
                      </div>
                    </div>
                    @if($sub->submenu->isNotEmpty())
                      <div class="progress xs">
                        <div class="progress-bar {{__static::bg_color(Auth::user()->color)}}" style="width: 0%;" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    @endif
                  </div>
                </div>
              </div>
            @endforeach
          </div>
      </div>
        @endforeach
      </div>
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
    <button type="submit" class="btn {!! __static::bg_color(Auth::user()->color) !!} update_user_btn"><i class="fa fa-save fa-fw"></i> Save</button>
  </div>
</form>