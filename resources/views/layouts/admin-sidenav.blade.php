<aside class="main-sidebar">
  <section class="sidebar">
    <div class="user-panel">
      <div class="pull-left image">
        <img src="{!! __html::check_img(Auth::user()->image) !!}" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">

        @if(Auth::check())
          <p>{{ Auth::user()->firstname }}</p>
        @endif

        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <ul class="sidebar-menu" data-widget="tree">

      @if(Auth::check())
        @if(count($global_menu_tree) > 0)
          <li class="header">NAVIGATION</li>

            <li>
                <a href="{{route('dashboard.home')}}">
                    <i class="fa fa-home"></i>
                    <span>Home</span>
                </a>
            </li>
          @foreach($global_menu_tree as $user_menu)
            @if($user_menu['menu_obj']->is_dropdown == 0)
              <li>
                <a href="">
                  <i class="fa {{$user_menu['menu_obj']->icon}}"></i>
                  <span>{{$user_menu['menu_obj']->name}}</span>
                </a>
              </li>
            @else
            <li class="treeview" style="height: auto;">
                <a href="#">
                    <i class="fa {{$user_menu['menu_obj']->icon}}"></i>
                    <span>{{$user_menu['menu_obj']->name}}</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu" style="display: none;">
                    @foreach($user_menu['submenus'] as $submenu)
                        <li><a href="{{route($submenu['submenu_obj']->route)}}"><i class="fa fa-circle-o"></i>{{$submenu['submenu_obj']->nav_name}}</a></li>
                    @endforeach
                </ul>
            </li>

            @endif
          @endforeach
        @endif
      @endif

    </ul>
  </section>
</aside>

