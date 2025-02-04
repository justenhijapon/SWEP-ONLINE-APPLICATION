<header class="main-header">
  <a href="#" class="logo">
    <span class="logo-mini">OA</span>
    <span class="logo-lg"><b>Online Application</b></span>
  </a>
  <nav class="navbar navbar-static-top">
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </a>
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <li class="dropdown tasks-menu inactive">
          <a href="{{ route('dashboard.shipping_permits.index') }}" >
            <i class="fa fa-calendar"></i> {{Carbon::now()->format('F d, Y')}}
          </a>
        </li>
        <li class="dropdown tasks-menu">
          <a href="{{ route('dashboard.home') }}">
            <i class="fa fa-home"></i> Home
          </a>
        </li>
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="{!! __html::check_img(Auth::user()->image) !!}" class="user-image" alt="User Image">
            @if(Auth::check())
              {{ __sanitize::html_encode(Auth::user()->firstname) }} {{ Auth::user()->lastname }}
            @endif
          </a>
          <ul class="dropdown-menu">

            <li class="user-header">
              <img src="{!! __html::check_img(Auth::user()->image) !!}" class="img-circle" alt="User Image">
              <p>
                @if(Auth::check())
                  {{ __sanitize::html_encode(Auth::user()->firstname) .' '. __sanitize::html_encode(Auth::user()->lastname) }}
                  <small>{{ __sanitize::html_encode(Auth::user()->position) }}</small>
                  <small>Last Login: {{ e(optional(Auth::user()->last_login_time)->format('F j, Y')) }} at {{ __sanitize::html_encode(Auth::user()->last_login_machine) }}</small>
                @endif

              </p>
            </li>
            <li class="user-footer">
              <div class="pull-left">
                <a href="{{ route('dashboard.profile.details') }}" class="btn btn-primary btn-flat">Profile</a>
              </div>
              <div class="pull-right">
                <a  href="{{ route('auth.logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();" class="btn btn-danger btn-flat">Log out</a>
              </div>
              <form id="frm-logout" action="{{ route('auth.logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
              </form>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</header>