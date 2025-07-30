<header class="th-header header-layout2 dark-theme">
    <div class="header-top">
        <div class="container">
            <div class="row justify-content-center justify-content-md-between align-items-center gy-2">
                <div class="col-auto d-none d-md-inline-block">
                    <div class="header-icon">
                        <a href="#" class="simple-icon sideMenuToggler"><i class="far fa-bars"></i></a>
                    </div>
                    <div class="header-links">
                        <ul>
                            <li><i class="fal fa-calendar-days"></i>
                                <a href="{{ route('blogs') }}">{{ date('D, d-M-Y') }}</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-auto d-none d-lg-inline-block">
                    <div class="header-logo">
                        <a href="{{ url('/') }}">
                            <img src="{{ url('images/logo') }}/{{ AppLogo() }}" alt="{{ AppSeting('app_name') }}" style="width: 180px;">
                        </a>
                    </div>
                </div>
                <div class="col-auto text-center text-md-end">
                    <div class="header-icon">
                        <div class="theme-switcher">
                            <button>
                                <span class="dark"><i class="fas fa-moon"></i></span>
                                <span class="light"><i class="fas fa-sun-bright"></i></span>
                            </button>
                        </div>
                    </div>
                    <div class="header-links">
                        <ul>
                            <li><a href="{{ route('privacy') }}">Privacy Policy</a></li>
                            <li><a href="{{ route('tos') }}">Terms & Conditions</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="sticky-wrapper">
        <!-- Main Menu Area -->
        <div class="menu-area">
            <div class="container">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto d-lg-none d-block">
                        <div class="header-logo">
                            <a href="{{ url('/') }}">
                                <img src="{{ url('images/logo') }}/{{ AppLogo() }}" alt="{{ AppSeting('app_name') }}" style="width: 180px;">
                            </a>
                        </div>
                    </div>
                    <div class="col-auto">
                        <nav class="main-menu d-none d-lg-inline-block">
                            @include('frontend.include.menu') 
                        </nav>
                    </div>
                    <div class="col-auto">
                        <div class="header-button">
                            <button type="button" class="simple-icon searchBoxToggler"><i class="far fa-search"></i></button>
                            
                            <button type="button" class="th-menu-toggle d-block d-lg-none"><i class="far fa-bars"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

