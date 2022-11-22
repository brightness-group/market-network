<header class="main-header header-light">
        <div class="navbar  bg-dark box-shadow">
            <div class="container">
                <a class="nav-button toggle-bar-btn" href="javascript:void(0);"><span id="nav-icon3"
                        class="toggle-btn-icon"><span></span><span></span><span></span><span></span></span></a>
                <a href="{{ route('home') }}" class="navbar-brand d-flex align-items-center mr-seenuto">
                    <img src="{{ asset('assets/images/Seen-Logo-White.svg') }}" alt="">
                </a>
                <div class="ml-seenuto right-block-style">
                    <div class="search-block">
                        <form class="search-form" method="GET" action="{{ route('search') }}">
                            <div class="from-group mb-0">
                                @if(Route::current()->getName() == 'login' || Route::current()->getName() == 'registration')
                                <div class="dropdown custom-dropdown">
                                    <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Categories
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenu2"> 
                                        @foreach ($globalcategories as $category)
                                        <a href="{{ route('search') }}?category_id={{ $category->id }}" class="dropdown-item" type="button">{{ $category->display_name }}</a>
                                        @endforeach                                        
                                    </div>
                                </div>
                                @endif

                                <div class="search-bar">
                                        <input type="text" class="form-control" name="query" id="query" value="{{ request()->query('query') == 'recommended' ? '' : request()->query('query') }}" placeholder="What are you looking for?">
                                        <span class="search-icon">
                                            <button type="submit" id="headeSearcBtn" class="btn-icon search-btn"><img
                                                    src="{{ asset('assets/images/icon_search.svg') }}" alt=""></button>
                                        </span>
                                </div>

                            </div>
                        </form>
                    </div>

                    @if(Auth::user())
                    @php
                        $cart = \App\Models\Cart::where(['user_id' => Auth::user()->id, 'is_deleted' => 0])->first('items_count');
                        $itemsCount = $cart ? $cart->items_count : '';
                    @endphp
                    <ul class="list-unstyled cart-list mb-0">
                        <li class="cart-li">
                            <a href="{{ route('cart') }}"><img src="{{ asset('assets/images/cart.svg') }}" alt=""><span class="badge badge-dark cart-item-count">{{ $itemsCount }}</span></a>
                        </li>
                    </ul>
                    @endif
                    <ul class=" list-unstyled right-ul-list mb-0">
                        @if(Auth::user())
                        <li>
                            <div class="dropdown notification-dropdown">
                                <button class="btn  dropdown-toggle" type="button" id="dropdownNotification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img src="{{ asset('assets/images/notifications-outline.svg') }}" alt="">
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
                                                        <img src="{{ asset('assets/images/Profile-Picture-7.png') }}" alt="user-img">
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
                                                        <img src="{{ asset('assets/images/Profile-Picture-19.png') }}" alt="user-img">
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
                                                        <img src="{{ asset('assets/images/Profile-Picture-5.png') }}" alt="user-img">
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
                                                        <img src="{{ asset('assets/images/Profile-Picture-18.png') }}" alt="user-img">
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
                        <li>
                            <a href="javascript:void(0);">
                                <img src="{{ asset('assets/images/message-square.svg') }}" alt="">
                            </a>
                        </li>
                        @endif
                        @if(!Auth::user())
                        <li class="btn-li"><a href="{{ route('login') }}" class="btn btn-link btn-sm signin-btn">Sign
                                in</a></li>
                       <li class="btn-li"><a href="{{ route('registration') }}" class="btn btn-light btn-sm signup-btn">Sign
                                up</a></li>
                        @endif

                        @if(Auth::user())
                        <li class="d-none d-lg-block">
                            <div class="dropdown profile-drop-down">
                                <button class="btn  dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    @if(Auth::User()->profile_photo_full_path)
                                    <img src="{{  Auth::User()->profile_photo_full_path }}" alt="">
                                    @else
                                    <img src="{{ asset('assets/images/Profile-Picture-1.png') }}" alt="">
                                    @endif
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a href="{{ route('snaps.create') }}" class="btn btn-dark upload-snp-btn">Upload Seen</a>
                                    <a class="dropdown-item" href="{{ route('profile') }}">Seen Profile</a>
                                    <a class="dropdown-item" href="{{ route('account.settings') }}">Account Settings</a>
                                    <hr>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                                            {{ __('Log Out') }}
                                        </a>
                                    </form>
                                </div>
                            </div>
                        </li>
                        @endif
                    </ul>
                </div>


            </div>
        </div>
        <!--navbar end-->


        <!--Mobile Toggel Search -->
        <div class="w-100 d-lg-none d-block">
            <div class="mob-toggle-search-bar " style="display: none;">
                <hr class="cstm-hr">
                <div class="container">
                    <div class="mob-search-bar">
                        <span class="search-icon">
                            <button type="button" class="btn-icon search-btn"></button>
                        </span>
                        <input type="text" class="form-control" id="m-query" placeholder="What are you looking for?">

                    </div>
                </div>
            </div>
        </div>
        <!--Mobile Toggel Search End-->
        <div class="fixed-top main-menu">
            <div class="main-inner-wrp">
                <div class="mobile-visible-block">
                    <form action="">
                        <div class="container">
                            <div class="mob-search-bar">
                                <span class="search-icon">
                                    <button type="button" class="btn-icon search-btn"></button>
                                </span>
                                <input type="text" class="form-control" id="m-query-search" placeholder="What are you looking for?">

                            </div>
                        </div>

                        <hr class="cstm-hr">
                        <div class="container">
                            <div class="col-md-12 pl-0 pr-0">
                                <div class="dropdown mob-profile-drop-down">
                                    <div class="main-wrp">
                                        <div class="left-block">
                                            <div class="profile-img">
                                                <img src="{{ asset('assets/images/Profile-Picture-big.png') }}" alt="">
                                            </div>
                                        </div>
                                        <div class="right-block">
                                            <button class="btn  dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                View Seen Profile
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="#">Seen Profile</a>
                                                <a class="dropdown-item" href="#">Account Settings</a>
                                                <hr>
                                                <form method="POST" action="{{ route('logout') }}">
                                                    @csrf
                                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                                            onclick="event.preventDefault();
                                                                    this.closest('form').submit();">
                                                        {{ __('Log Out') }}
                                                    </a>
                                                </form>
                                            </div>
                                            <a href="#" class="btn btn-outline-light upload-snp-btn">Upload Snapshot</a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="cstm-hr">
                    </form>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="p-0 cstm-pl">
                                <ul class="big-nv-list flex-column nav">
                                    @foreach ($globalcategories as $category)
                                        <li class="nav-item delay-1"><a class="nav-link text-outline " href="{{ route('search') }}?category_id={{ $category->id }}">{{ $category->display_name }} <span
                                                    class="overlay-txt">{{ $category->display_name }}</span>
                                                <span class="coming-soon-txt"></span></a>
                                        </li>
                                    @endforeach
                                </ul>

                                <ul class="nav flex-column small-nav-list">
                                    <li class="nav-item delay-5"><a class="nav-link" href="#">About</a></li>
                                    <li class="nav-item delay-6"><a class="nav-link" href="#">How it works</a></li>
                                    <li class="nav-item delay-8"><a class="nav-link" href="#">Contact</a></li>
                                </ul>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="dark-light-mode">
                                            <a href="javascript:void(0);" class="lightdarkswitch">
                                                <div class="dark-d"><i class="fa fa-adjust"></i> Dark Mode</div>
                                                <div class="light-d" style="display: none;"><i class="fa fa-adjust"></i> Light Mode</div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row footer">
                        <div class="col-lg-2 col-6 col-md-6 order-lg-2 order-md-1  order-1">
                            <p class="copyright">
                                <strong class="logo-nm">© Seen 2021</strong>
                            </p>
                        </div>
                        <div class="col-lg-8 col-md-12 order-lg-2 order-md-3 order-3 pr-lg-3 pr-md-0 pr-0 ">
                            <div class="d-block d-lg-none">
                                <div class="dropdown footer-nav-drop-down ">
                                    <button class="btn  dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Terms of use
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="#">Seen Community</a>
                                        <a class="dropdown-item" href="#">Help Centre</a>
                                        <a class="dropdown-item" href="#">Terms and Privacy</a>

                                    </div>


                                </div>

                            </div>
                            <ul class="list-unstyled quick-link-list d-none d-lg-flex">
                                <li><a href="javascript:void(0);">Seen Community</a></li>
                                <li><a href="javascript:void(0);">Help Centre</a></li>
                                <li><a href="javascript:void(0);">Terms and Privacy</a></li>
                            </ul>
                        </div>
                        <div class="col-lg-2 col-6 col-md-6 pr-0 order-lg-2 order-md-2 order-2">
                            <ul class="list-unstyled socail-link-list">
                                <li><a href="javascript:void(0);" title="Twitter"><i class="fab fa-twitter"></i> </a>
                                </li>
                                <li><a href="javascript:void(0);" title="Instagram"><i class="fab fa-instagram"></i>
                                    </a>
                                </li>
                                <li><a href="javascript:void(0);" title="Linkedin"><i
                                            class="fab fa-linkedin-in"></i></a>
                                </li>

                            </ul>
                        </div>

                    </div>
                </div>

            </div>

        </div>
        <!--main-menu end-->
    </header>
