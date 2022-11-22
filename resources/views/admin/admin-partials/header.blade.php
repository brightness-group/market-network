<header class="main-header header-light">
    <div class="navbar bg-dark box-shadow">
        <div class="container-fluid"> 
            <a href="{{ route('admin.dashboard.index') }}" class="navbar-brand d-flex align-items-center mr-seenuto">
                <img src="{{ asset('assets/admin/images/Seen-Logo-White.svg') }}" alt="">
            </a>
            <div class="ml-seenuto right-block-style">
                <div class="search-block">
                    <form action="" class="search-form">
                        <div class="from-group mb-0">
                            <div class="search-bar">
                                <input type="text" class="form-control" id="mobile-search" placeholder="What are you looking for?">
                                <span class="search-icon">
                                    <button type="button" id="headeSearcBtn" class="btn-icon search-btn"><img
                                            src="{{ asset('assets/admin/images/icon_search.svg') }}" alt=""></button>
                                </span>
                            </div>

                        </div>
                    </form>
                </div>
                <ul class=" list-unstyled right-ul-list mb-0">
                    <li>
                        <div class="dropdown notification-dropdown">
                            <button class="btn  dropdown-toggle" type="button" id="dropdownNotification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="{{ asset('assets/admin/images/notifications-outline.svg') }}" alt="">
                                <span class="badge badge-dark">2</span>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownNotification">
                                <div class="card">
                                    <div class="card-head">
                                        <div class="left-b">
                                            <h5 class="card-title">notifications</h5>
                                        </div>
                                        <div class="right-b">
                                            <a href="#" class="btn btn-rounded btn-gray"> clear</a>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <a href="#" class="msg-row">
                                            <div class="left-info">
                                                <div class="user-img">
                                                    <img src="{{ asset('assets/admin/images/Profile-Picture-7.png') }}" alt="user-img">
                                                </div>
                                                <div class="detail-wrp">
                                                    <p class="u-name">Shanice Williams</p>
                                                    <p class="p-text-wrp"> Added 2 new <span class="seen-img">Seen</span></p>
                                                </div>
                                            </div>
                                            <div class="right-info">
                                                <div class="time-txt">2h</div>

                                            </div>
                                        </a>
                                        <a href="#" class="msg-row unseen-msg">
                                            <div class="left-info">
                                                <div class="user-img">
                                                    <img src="{{ asset('assets/admin/images/Profile-Picture-19.png') }}" alt="user-img">
                                                </div>
                                                <div class="detail-wrp">
                                                    <p class="u-name">Raven West</p>
                                                    <p class="p-text-wrp"> <span class="heart-img">Loves</span> your Snapshot
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="right-info">
                                                <div class="time-txt">3h</div>
                                                <div class="msg-counter">1</div>
                                            </div>
                                        </a>
                                        <a href="#" class="msg-row unseen-msg">
                                            <div class="left-info">
                                                <div class="user-img">
                                                    <img src="{{ asset('assets/admin/images/Profile-Picture-5.png') }}" alt="user-img">
                                                </div>
                                                <div class="detail-wrp">
                                                    <p class="u-name">Allison Miller</p>
                                                    <p class="p-text-wrp"> <span class="heart-img">Loves</span> your Snapshot
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="right-info">
                                                <div class="time-txt">1d</div>
                                                <div class="msg-counter">1</div>
                                            </div>
                                        </a>
                                        <a href="#" class="msg-row">
                                            <div class="left-info">
                                                <div class="user-img">
                                                    <img src="{{ asset('assets/admin/images/Profile-Picture-18.png') }}" alt="user-img">
                                                </div>
                                                <div class="detail-wrp">
                                                    <p class="u-name">Emily King</p>
                                                    <p class="p-text-wrp">Started <span class="following-img">Following you</span></p>
                                                </div>
                                            </div>
                                            <div class="right-info">
                                                <div class="time-txt">1d</div>

                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="msg-li">
                        <a href="javascript:void(0);">
                            <img src="{{ asset('assets/admin/images/message-square.svg') }}" alt="">
                            <span class="badge badge-dark">2</span>
                        </a>
                    </li>
                    <li class="d-none d-lg-block">
                        <div class="dropdown profile-drop-down">
                            <button class="btn  dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                @if(Auth::User()->profile_photo_full_path)
                                <img src="{{  Auth::User()->profile_photo_full_path }}" alt="">
                                @else
                                <img src="{{ asset('assets/admin/images/Profile-Picture-1.png') }}" alt="">
                                @endif
                                <span class="user-name">{{ Auth::User()->name }}</span>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                                <a class="dropdown-item" href="javascript:void(0);">Edit Profile</a>
                                <a class="dropdown-item" href="#">Help</a>
                                <hr>
                                <form method="POST" action="{{ route('admin.logout') }}">
                                    @csrf
                                    <a class="dropdown-item" href="{{ route('admin.logout') }}"
                                            onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                        {{ __('Sign out') }}
                                    </a>
                                </form>

                            </div>
                        </div>
                    </li>
                </ul>
            </div>


        </div>
    </div>

    <!--Mobile Toggel Search -->
    <div class="w-100 d-lg-none d-block">
        <div class="mob-toggle-search-bar " style="display: none;">
            <hr class="cstm-hr">
            <div class="container-fluid">
                <div class="mob-search-bar">
                    <span class="search-icon">
                        <button type="button" class="btn-icon search-btn"></button>
                    </span>
                    <input type="text" class="form-control" id="search" placeholder="What are you looking for?">

                </div>
            </div>
        </div>
    </div>
    <!--Mobile Toggel Search End-->

    <!--main-menu end-->
</header>