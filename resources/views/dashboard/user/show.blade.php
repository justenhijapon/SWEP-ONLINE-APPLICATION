<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal">&times;</button>
  <h4 class="modal-title">{{ $user->firstname }} {{ $user->lastname }}</h4>
</div>
<div class="modal-body">

  @php
        $submenus = [];
        $submenuData = [];

        foreach ($menus as $key => $sub) {
            $submenus[$sub->menu_id] = [
                'name' => $sub->name,
                'menu_id' => $sub->menu_id,
                'all_submenu' => count($sub->submenu),
                'submenus' => [],

            ];

            if ($sub->submenu->isNotEmpty()) {
                foreach ($sub->submenu as $key2 => $submenu) {
                    $submenus[$sub->menu_id]['submenus'][$submenu->submenu_id] = $submenu->name;
                }
            }
        }
        foreach ($userSubmenus as $userSubmenu) {
            $submenuData[] = [
                'submenu_id' => $userSubmenu->submenu_id,
            ];
        }

        $filteredSubmenus = [];
        foreach ($submenuData as $userSubmenu) {
            foreach ($submenus as $menu_id => $menu) {
                if (isset($menu['submenus'][$userSubmenu['submenu_id']])) {
                    if (!isset($filteredSubmenus[$menu_id])) {
                        $filteredSubmenus[$menu_id] = [
                            'name' => $menu['name'],
                            'menu_id' => $menu_id,
                            'submenus' => []
                        ];
                    }
                    $filteredSubmenus[$menu_id]['submenus'][$userSubmenu['submenu_id']] = $menu['submenus'][$userSubmenu['submenu_id']];
                }
            }
        }
//    foreach($user->userMenu as $menu){
//      if(!empty($menu->menu)){
//        foreach($user->userSubmenu as $submenu){
//          if(!empty($submenu->subMenuContent) && !empty($menu->menu)){
//            if($menu->menu->menu_id == $submenu->subMenuContent->menu_id){
//              if(isset($submenus[$menu->menu->menu_id]['submenus'][$submenu->subMenuContent->submenu_id])){
//                $submenus[$menu->menu->menu_id]['user_uses'] = $submenus[$menu->menu->menu_id]['user_uses'] +1;
//              }
//            }
//          }
//        }
//      }
//    }

  //print('<pre>'.print_r($submenus,true).'</pre>');
  @endphp
  <div class="row">
    <div class="col-md-3">
      <div class="well well-sm">
        <dl >
          <dt>Username:</dt>
          <dd>{{$user->username}}</dd>

          <dt>Last Name:</dt>
          <dd>{{$user->lastname}}</dd>

          <dt>First Name:</dt>
          <dd>{{$user->firstname}}</dd>

          <dt>Middle Name:</dt>
          <dd>{{$user->middlename}}</dd>

          <dt>Position:</dt>
          <dd>{{$user->position}}</dd>
          <hr class="sm-margin">

          <dt>Status:</dt>
          <dd>
            @if ($user->is_online == 1)
              <span class="label bg-green">ONLINE</span>
            @else
              <span class="label bg-gray">OFFLINE</span>
            @endif
          </dd>

          <dt>Account Status:</dt>
          <dd>
            @if ($user->is_active == 1)
              <span class="label bg-green">ACTIVE</span>
            @else
              <span class="label bg-red">INACTIVE</span>
            @endif
          </dd>
          <hr class="sm-margin">

          <dt>Last Login:</dt>
          <dd>{{date("M. d, Y | h:i A",strtotime($user->last_login_time))}}</dd>

          <dt>Last Login Machine:</dt>
          <dd>{{$user->last_login_machine}}</dd>
        </dl>
      </div>
    </div>
    <div class="col-md-9">
          <div class="panel panel-default">
              <div class="panel-heading">
                  User routes
              </div>
              <div class="panel-body">
                  @if(empty($filteredSubmenus))
                      <div class="alert alert-info">
                          No routes for this user.
                      </div>
                  @else
                      @foreach($filteredSubmenus as $menu_id => $menu)
                          <div class="row">
                              <div class="col-md-8">
                                  <label>
                                      {{ $menu['name'] }}
                                  </label>
                              </div>
                          </div>
                          <div class="row">
                              @foreach($menu['submenus'] as $submenu_id => $submenu_name)
                                  <div class="col-md-4">
                                      <li>
                                          {{ str_replace($menu['name'], '', $submenu_name) }}
                                      </li>
                                  </div>
                              @endforeach
                          </div>
                          <hr class="sm-margin">
                      @endforeach
                  @endif
              </div>
          </div>
      </div>

  </div>
</div>
<div class="modal-footer">
  <div class="row">
    {!! __html::timestamp($user ,"4") !!}
    <div class="col-md-4">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
  </div>
</div>