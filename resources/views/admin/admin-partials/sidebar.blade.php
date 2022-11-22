<aside class="sidbar-menu-nav">
    <div class="main-menu">
        <div class="main-inner-wrp">
            <a class="nav-button toggle-bar-btn" href="javascript:void(0);"><span id="nav-icon3"
                    class="toggle-btn-icon"><span></span><span></span><span></span><span></span></span></a>
            <div class="mobile-visible-block">
                <form action="">
                    <div class="col-md-12 pl-0 pr-0">
                        <div class="dropdown mob-profile-drop-down">
                            <div class="main-wrp">
                                <div class="left-block">
                                    <div class="profile-img">
                                        <img src="{{ asset('assets/admin/images/Profile-Picture-big.png') }}" alt="">

                                    </div>
                                </div>
                                <div class="right-block">
                                    <button class="btn  dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        User name
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="#">Edit Profile</a>
                                        <a class="dropdown-item" href="#">Help</a>
                                        <hr>
                                        <a class="dropdown-item" href="#">Sign out</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="cstm-hr">
                </form>
            </div>
            <ul class="menu-nv-list nav">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.dashboard.*') ? 'active' : '' }}" href="{{ route('admin.dashboard.index') }}">
                        <span class="icon-wrap">
                            <img src="{{ asset('assets/admin/images/icon-home.svg') }}" alt="">
                        </span> Dashboard </a>

                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.snapshot*') ? 'active' : '' }}" href="{{ route('admin.snapshots') }}"> <span class="icon-wrap">
                            <img src="{{ asset('assets/admin/images/icon-image-two.svg') }}" alt="">
                        </span> Seens </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.snapshot*') ? 'active' : '' }}" href="{{ route('admin.reviews') }}"> <span class="icon-wrap">
                            <img src="{{ asset('assets/admin/images/icon-review.svg') }}" alt="">
                        </span> Reviews </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.user*') ? 'active' : '' }}" href="{{ route('admin.users') }}"> <span class="icon-wrap">
                            <img src="{{ asset('assets/admin/images/icon-users.svg') }}" alt="">
                        </span> Users </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.categories*') ? 'active' : '' }}" href="{{ route('admin.categories') }}"> <span class="icon-wrap">
                            <img src="{{ asset('assets/admin/images/icon-categories.svg') }}" alt="">
                        </span> Categories </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link {{ request()->routeIs('admin.analytics*') ? 'active' : '' }}" href="{{ route('admin.analytics') }}"> <span class="icon-wrap">
                            <img src="{{ asset('assets/admin/images/icon-analytics.svg') }}" alt="">
                        </span> Analytics </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-outline {{ request()->routeIs('admin.settings*') ? 'active' : '' }}" href="{{ route('admin.settings') }}"> <span class="icon-wrap">
                            <img src="{{ asset('assets/admin/images/icon-settings.svg') }}" alt="">
                        </span> Settings </a>
                </li>
            </ul>

        </div>
    </div>
</aside>
