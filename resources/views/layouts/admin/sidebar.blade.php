<nav class="pcoded-navbar menu-light ">
    <div class="navbar-wrapper  ">
        <div class="navbar-content scroll-div ">

            <div class="">
                <div class="main-menu-header">
                    <img class="img-radius" src="{{asset('assets/images/user/avatar-user.webp')}}"
                        alt="User-Profile-Image">
                        <p>{{auth()->user()->name}}</p>
                </div>
                <div class="collapse" id="nav-user-link">
                    <ul class="list-unstyled">
                        <li class="list-group-item"><a href="user-profile.html"><i
                                    class="feather icon-user m-r-5"></i>View Profile</a></li>
                        <li class="list-group-item"><a href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                                    class="feather icon-log-out m-r-5"></i>Logout</a></li>
                    </ul>
                </div>
            </div>

            <ul class="nav pcoded-inner-navbar ">
                @role(config('constant.role.admin'))
                <li class="nav-item pcoded-menu-caption">
                    <label>Admin</label>
                </li>
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link "><span class="pcoded-micon"><i
                                class="feather icon-home"></i></span><span class="pcoded-mtext">Dashboard</span></a>
                </li>
                <li class="nav-item pcoded-menu-caption">
                    <label>Master</label>
                </li>
                <li class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link "><span class="pcoded-micon"><i
                                class="feather icon-list"></i></span><span class="pcoded-mtext">Master Data</span></a>
                    <ul class="pcoded-submenu">
                        <li><a href="{{ route('barang.index') }}">Barang</a></li>
                        <li><a href="{{ route('perusahaan.index') }}">Perusahaan</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('transaksi.index') }}" class="nav-link "><span class="pcoded-micon"><i
                                class="feather icon-shopping-cart"></i></span><span class="pcoded-mtext">Transaksi</span></a>
                </li>
                @endrole
            </ul>

        </div>
    </div>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
</nav>