<header class="navbar pcoded-header navbar-expand-lg navbar-light header-blue">
    <div class="m-header">
      <a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
      <a href="{{ route('dashboard') }}" class="b-brand">
          <span class="text-xl font-weight-bolder">AL - MUHAJIRIN 3</span>
      </a>
      <a href="#!" class="mob-toggler">
        <i class="feather icon-more-vertical"></i>
      </a>
    </div>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <div class="search-bar">
            <input type="text" class="form-control border-0 shadow-none" placeholder="Search hear">
            <button type="button" class="close" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li>
          <div class="dropdown drp-user">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="feather icon-user"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right profile-notification">
              <div class="pro-head">
                <img src="{{asset('assets/images/user/avatar-user.webp')}}" class="img-radius" alt="User-Profile-Image">
                <span>{{auth()->user()->name}}</span>
              </div>
              <ul class="pro-body">
                <li><a href="{{ route('logout') }}" class="dropdown-item" 
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="feather icon-log-out"></i> Logout</a></li>
              </ul>
            </div>
          </div>
        </li>
      </ul>
    </div>
    
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
</header>