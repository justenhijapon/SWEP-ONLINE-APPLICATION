<aside class="main-sidebar">
  <section class="sidebar">
    <div class="user-panel">
      <div class="pull-left image">
        <img src="{!! __html::check_img(Auth::user()->image) !!}" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">

        @if(Auth::check())
          <p>{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</p>
        @endif

        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
      <div class="sidebar-form">
          <div class="input-group">
              <input type="text" id="menu-search" placeholder="Search menu..." class="form-control">
              <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                    </button>
                </span>
          </div>
      </div>
    <ul class="sidebar-menu" data-widget="tree">

      @if(Auth::check())
        @if(count($global_menu_tree) > 0)
            <li id="home-nav">
                <a href="{{route('dashboard.home')}}">
                    <i class="fa fa-home"></i>
                    <span>Home</span>
                </a>
            </li>


                @php
                    $superuserHeaderDisplayed = false;
                    $userHeaderDisplayed = false;
                    $adminHeaderDisplayed = false;
                @endphp

                @foreach($global_menu_tree as $user_menu)
                    @if($user_menu['menu_obj']->category == 'SU')
                        @if(!$superuserHeaderDisplayed)
                            <li class="header">SUPER USER</li>
                            @php
                                $superuserHeaderDisplayed = true;
                            @endphp
                        @endif
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
                    @endif
                @endforeach

                @foreach($global_menu_tree as $user_menu)
                    @if($user_menu['menu_obj']->category == 'U')
                        @if(!$userHeaderDisplayed)
                            <li class="header">USER</li>
                            @php
                                $userHeaderDisplayed = true;
                            @endphp
                        @endif
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
                    @endif
                @endforeach



                @foreach($global_menu_tree as $user_menu)
                    @if($user_menu['menu_obj']->category == 'ADMIN')
                        @if(!$adminHeaderDisplayed)
                            <li class="header">DATA INPUT</li>
                            @php
                                $adminHeaderDisplayed = true;
                            @endphp
                        @endif
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
                    @endif
                @endforeach




        @endif
      @endif

    </ul>
  </section>
</aside>
{{--@section('scripts')--}}
{{--<script>--}}
{{--    $(document).ready(function() {--}}
{{--        // Initialize SlimScroll on the main sidebar--}}
{{--        $('.main-sidebar').slimScroll({--}}
{{--            height: '100%', // Set the height as desired--}}
{{--            railVisible: true, // Show the scrollbar rail--}}
{{--            alwaysVisible: true, // Keep scrollbar always visible--}}
{{--            wheelStep: 10 // Scroll amount on mouse wheel--}}
{{--        });--}}
{{--    });--}}
{{--</script>--}}
{{--@endsection--}}

