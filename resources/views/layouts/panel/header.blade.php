<header id="header" class="header">
    <div class="top-left">
        <div class="navbar-header">
            <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
        </div>
    </div>
    <div class="top-right">
        <div class="header-menu">

            <div class="user-area dropdown float-right">
                <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                   Login
                </a>
                <div class="user-menu dropdown-menu">
                    <a class="nav-link" href="#"><i class="fa fa-power -off"></i>Выход</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>

        </div>
    </div>
</header>