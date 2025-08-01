<div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>

<div class="sticky">

    <aside class="app-sidebar sidebar-scroll">

        <div class="main-sidebar-header active">

            <a class="desktop-logo logo-light active" href="{{ route('dashboard.index') }}"><img
                    src="{{ url('/images/logo') }}/{{ AppLogo() }}" class="main-logo" alt="logo"></a>

            <a class="desktop-logo logo-dark active" href="{{ route('dashboard.index') }}"><img
                    src="{{ url('/images/logo') }}/{{ AppLogo() }}" class="main-logo" alt="logo"></a>

            <a class="logo-icon mobile-logo icon-light active" href="{{ route('dashboard.index') }}"><img
                    src="{{ url('/images/logo') }}/{{ AppLogo() }}" alt="logo"></a>

            <a class="logo-icon mobile-logo icon-dark active" href="{{ route('dashboard.index') }}"><img
                    src="{{ url('/images/logo') }}/{{ AppLogo() }}" alt="logo"></a>

        </div>

        <div class="main-sidemenu">

            <div class="app-sidebar__user">

                <div class="dropdown user-pro-body text-center">

                    <div class="user-pic">

                        <img src="{{ Auth::user()->images != '' ? asset('/images/users') . '/' . Auth::user()->images : asset('/images/no-user.jpg') }}"
                            alt="user-img" class="avatar-xl rounded-circle mb-1">

                    </div>

                    <div class="user-info text-center">

                        <?php

                        $user = auth()->user()->userDescription;

                        ?>

                        <h5 class=" mb-1 font-weight-bold">{{ $user->nama_depan . ' ' . $user->nama_belakang }}</h5>

                        <span
                            class="text-muted app-sidebar__user-name text-sm">{{ Auth::user()->roles[0]['name'] }}</span>

                    </div>

                </div>

            </div>

            <div class="slide-left disabled" id="slide-left"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191"
                    width="24" height="24" viewBox="0 0 24 24">
                    <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z" />
                </svg></div>

            <ul class="side-menu">

                @if (auth()->user()->can('dashboard-index'))
                <li class="slide">

                    <a class="side-menu__item @if ($controller === 'dashboard') active @endif"
                        href="{{ route('dashboard.index') }}">

                        <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">

                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>

                            <polyline points="9 22 9 12 15 12 15 22"></polyline>

                        </svg>

                        <span class="side-menu__label">Dashboard</span>

                    </a>

                </li>
                @endif





                @if (auth()->user()->can('inbox-index'))

                <li class="slide">

                    <a class="side-menu__item @if ($controller === 'inbox') active @endif"
                        href="{{ route('inbox.index') }}">
                        <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">

                            <path
                                d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H4.414A2 2 0 0 0 3 11.586l-2 2V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12.793a.5.5 0 0 0 .854.353l2.853-2.853A1 1 0 0 1 4.414 12H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z" />

                            <path
                                d="M3 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5M3 6a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 6m0 2.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5" />

                        </svg>

                        <span class="side-menu__label">Inbox</span>

                        @if (getCountInbox() >= 1)
                        <span class="badge bg-primary">{{ getCountInbox() }}</span>
                        @endif

                    </a>

                </li>

                @endif



                @if (auth()->user()->can('infobox-index'))
                <li class="slide">

                    <a class="side-menu__item @if ($controller === 'infobox') active @endif"
                        href="{{ route('infobox.index') }}">

                        <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path
                                d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z">
                            </path>
                            <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                            <line x1="12" y1="22.08" x2="12" y2="12"></line>
                        </svg>

                        <span class="side-menu__label">Box Welcome</span>

                    </a>

                </li>
                @endif









                @if (auth()->user()->can('slider-index') ||
                auth()->user()->can('news-index') ||
                auth()->user()->can('pages-index') ||
                auth()->user()->can('testimonial-index') ||
                auth()->user()->can('client-index') ||
                auth()->user()->can('tags-index') ||
                auth()->user()->can('category-index') ||
                auth()->user()->can('gallery-index')

                )

                <li class="slide @if (
                        $controller === 'slider' ||
                            $controller === 'news' ||
                            $controller === 'pages' ||
                            $controller === 'testimonial' ||
                            $controller === 'client' ||
                            $controller === 'tags' ||
                            $controller === 'category' ||
                            $controller === 'gallery') is-expanded @endif">

                    <a class="side-menu__item @if (
                            $controller === 'slider' ||
                                $controller === 'news' ||
                                $controller === 'pages' ||
                                $controller === 'testimonial' ||
                                $controller === 'client' ||
                                $controller === 'tags' ||
                                $controller === 'category' ||
                                $controller === 'gallery') active is-expanded @endif"
                        data-bs-toggle="slide" href="javascript:void(0)">

                        <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path
                                d="M2.5 3.5a.5.5 0 0 1 0-1h11a.5.5 0 0 1 0 1zm2-2a.5.5 0 0 1 0-1h7a.5.5 0 0 1 0 1zM0 13a1.5 1.5 0 0 0 1.5 1.5h13A1.5 1.5 0 0 0 16 13V6a1.5 1.5 0 0 0-1.5-1.5h-13A1.5 1.5 0 0 0 0 6zm1.5.5A.5.5 0 0 1 1 13V6a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5z" />
                        </svg>

                        <span class="side-menu__label">CMS System</span><i
                            class="angle fe fe-chevron-right"></i></a>

                    <ul class="slide-menu open">

                        @if (auth()->user()->can('slider-index'))
                        <li class="is-expanded">

                            <a href="{{ route('slider.index') }}"
                                class="slide-item @if ($controller === 'slider') active @endif">
                                Sliders
                            </a>

                        </li>
                        @endif

                        @if (auth()->user()->can('news-index'))
                        <li class="is-expanded">
                            <a href="{{ route('news.index') }}"
                                class="slide-item @if ($controller === 'news') active @endif">News /
                                Article </a>
                        </li>
                        @endif

                        @if (auth()->user()->can('pages-index'))
                        <li class="is-expanded">

                            <a href="{{ route('pages.index') }}"
                                class="slide-item @if ($controller === 'pages') active @endif">Pages</a>

                        </li>
                        @endif


                        @if (auth()->user()->can('gallery-index'))
                        <li class="is-expanded">
                            <a href="{{ route('gallery.index') }}"
                                class="slide-item @if ($controller === 'gallery') active @endif">Gallery</a>
                        </li>
                        @endif



                        @if (auth()->user()->can('category-index'))
                        <li>
                            <a href="{{ route('category.index') }}"
                                class="slide-item @if ($controller === 'category') active @endif">Category
                            </a>
                        </li>
                        @endif




                        @if (auth()->user()->can('tags-index'))
                        <li>

                            <a href="{{ route('tags.index') }}"
                                class="slide-item @if ($controller === 'tags') active @endif">Tags</a>

                        </li>
                        @endif



                        @if (auth()->user()->can('client-index'))
                        <li>

                            <a href="{{ route('client.index') }}"
                                class="slide-item @if ($controller === 'client') active @endif">Client /
                                Partnership</a>

                        </li>
                        @endif



                        @if (auth()->user()->can('testimonial-index'))
                        <li>

                            <a href="{{ route('testimonial.index') }}"
                                class="slide-item @if ($controller === 'testimonial') active @endif">Testimonial</a>

                        </li>
                        @endif

                    </ul>

                </li>

                @endif



                @if (auth()->user()->can('roles-index') ||
                auth()->user()->can('permissions-index') ||
                auth()->user()->can('users-index'))

                <li class="slide @if ($controller === 'users_pengguna' || $controller === 'permissions' || $controller === 'roles') is-expanded @endif">

                    <a class="side-menu__item @if ($controller === 'users_pengguna' || $controller === 'permissions' || $controller === 'roles') active is-expanded @endif"
                        data-bs-toggle="slide" href="javascript:void(0)">

                        <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>

                        <span class="side-menu__label">Users Management</span><i
                            class="angle fe fe-chevron-right"></i></a>

                    <ul class="slide-menu open">

                        @if (auth()->user()->can('users-index'))
                        <li class="is-expanded">

                            <a href="{{ route('users_pengguna.index') }}"
                                class="slide-item @if ($controller === 'users_pengguna') active @endif">User
                                Akses</a>

                        </li>
                        @endif

                        @if (auth()->user()->can('roles-index'))
                        <li class="is-expanded">

                            <a href="{{ route('roles.index') }}"
                                class="slide-item @if ($controller === 'roles') active @endif">Divisi &
                                Role </a>

                        </li>
                        @endif

                        @if (auth()->user()->can('permissions-index'))
                        <li class="is-expanded">

                            <a href="{{ route('permissions.index') }}"
                                class="slide-item @if ($controller === 'permissions') active @endif">Permission</a>

                        </li>
                        @endif

                    </ul>

                </li>

                @endif





                @if (auth()->user()->can('setting_general-index'))
                <li class="slide">

                    <a class="side-menu__item @if ($controller === 'setting_general') active @endif"
                        href="{{ route('setting_general.index') }}">

                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" class="side-menu__icon">
                            <line x1="4" y1="21" x2="4" y2="14"></line>
                            <line x1="4" y1="10" x2="4" y2="3"></line>
                            <line x1="12" y1="21" x2="12" y2="12"></line>
                            <line x1="12" y1="8" x2="12" y2="3"></line>
                            <line x1="20" y1="21" x2="20" y2="16"></line>
                            <line x1="20" y1="12" x2="20" y2="3"></line>
                            <line x1="1" y1="14" x2="7" y2="14"></line>
                            <line x1="9" y1="8" x2="15" y2="8"></line>
                            <line x1="17" y1="16" x2="23" y2="16"></line>
                        </svg>

                        <span class="side-menu__label">Config System</span>

                    </a>

                </li>
                @endif




                <!-- Menu Antrian -->               
                @if (auth()->user()->can('antrian_layanan_informasi-index') ||
                    auth()->user()->can('sesi_layanan_kunjungan-index') ||
                    auth()->user()->can('antrian_layanan_pengaduan-index'))

                <li class="slide @if ($controller === 'antrian_layanan_informasi' || $controller === 'sesi_layanan_kunjungan' || $controller === 'antrian_layanan_pengaduan') is-expanded @endif">

                    <a class="side-menu__item @if ($controller === 'antrian_layanan_informasi' || $controller === 'sesi_layanan_kunjungan' || $controller === 'antrian_layanan_pengaduan') active is-expanded @endif"
                        data-bs-toggle="slide" href="javascript:void(0)">

                        <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>

                        <span class="side-menu__label">Antrian</span><i
                            class="angle fe fe-chevron-right"></i></a>

                    <ul class="slide-menu open">

                        @if (auth()->user()->can('antrian_layanan_informasi-index'))
                        <li class="is-expanded">

                            <a href="/dashboard/antrian_layanan_informasi"
                                class="slide-item @if ($controller === 'antrian_layanan_informasi') active @endif">Antrian Informasi</a>

                        </li>
                        @endif

                        @if (auth()->user()->can('sesi_layanan_kunjungan-index'))
                        <li class="is-expanded">

                            <a href="/dashboard/sesi_layanan_kunjungan"
                                class="slide-item @if ($controller === 'sesi_layanan_kunjungan') active @endif">Antrian Kunjungan</a>

                        </li>
                        @endif

                        @if (auth()->user()->can('antrian_layanan_pengaduan-index'))
                        <li class="is-expanded">

                            <a href="/dashboard/antrian_layanan_pengaduan"
                                class="slide-item @if ($controller === 'antrian_layanan_pengaduan') active @endif">Antrian Pengaduan</a>

                        </li>
                        @endif

                    </ul>

                </li>

                @endif
                <!-- Menu Antrian -->


                <!-- Menu Antrian -->
                @if (auth()->user()->can('kelola_antrian_layanan_informasi-index') ||
                    auth()->user()->can('kelola_antrian_layanan_kunjungan-index') ||
                    auth()->user()->can('kelola_antrian_layanan_pengaduan-index'))

                <li class="slide @if ($controller === 'kelola_antrian_layanan_informasi' || $controller === 'kelola_antrian_layanan_kunjungan' || $controller === 'kelola_antrian_layanan_pengaduan') is-expanded @endif">

                    <a class="side-menu__item @if ($controller === 'kelola_antrian_layanan_informasi' || $controller === 'kelola_antrian_layanan_kunjungan' || $controller === 'kelola_antrian_layanan_pengaduan') active is-expanded @endif"
                        data-bs-toggle="slide" href="javascript:void(0)">

                        <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>

                        <span class="side-menu__label">Kelola Data Antrian</span><i
                            class="angle fe fe-chevron-right"></i></a>

                    <ul class="slide-menu open">

                        @if (auth()->user()->can('kelola_antrian_layanan_informasi-index'))
                        <li class="is-expanded">

                            <a href="/dashboard/kelola_antrian_layanan_informasi"
                                class="slide-item @if ($controller === 'kelola_antrian_layanan_informasi') active @endif">Antrian Informasi</a>

                        </li>
                        @endif

                        @if (auth()->user()->can('kelola_antrian_layanan_kunjungan-index'))
                        <li class="is-expanded">

                            <a href="/dashboard/kelola_antrian_layanan_kunjungan"
                                class="slide-item @if ($controller === 'kelola_antrian_layanan_kunjungan') active @endif">Antrian Kunjungan</a>

                        </li>
                        @endif

                        @if (auth()->user()->can('kelola_antrian_layanan_pengaduan-index'))
                        <li class="is-expanded">

                            <a href="/dashboard/kelola_antrian_layanan_pengaduan"
                                class="slide-item @if ($controller === 'kelola_antrian_layanan_pengaduan') active @endif">Antrian Pengaduan</a>

                        </li>
                        @endif

                    </ul>

                </li>

                @endif
                <!-- Menu Antrian -->



                @if (auth()->user()->can('acc_setting_menu-index'))
                <li class="slide">

                    <a class="side-menu__item @if ($controller === 'acc_setting_menu') active @endif"
                        href="{{ route('acc_setting_menu.index') }}">





                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            stroke="currentColor" class="side-menu__icon" viewBox="0 0 16 16">

                            <path
                                d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492M5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0" />

                            <path
                                d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115z" />

                        </svg>

                        <span class="side-menu__label">Setting</span>

                    </a>

                </li>
                @endif







            </ul>







            <div class="app-sidebar-help">

                <div class="dropdown text-center">

                    <div class="help d-flex">

                        <a href="javascript:void(0)" class="nav-link p-0 help-dropdown" data-bs-toggle="dropdown">

                            <span class="font-weight-bold">Help Info</span> <i class="fa fa-angle-down ms-2"></i>

                        </a>

                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow p-4">

                            <div class="sidebar-dropdown-divider pb-3">

                                <h4 class="font-weight-bold">Help</h4>

                                <a class="d-block" href="javascript:void(0)">Knowledge base</a>

                                <a class="d-block" href="javascript:void(0)">info@idetechno.co.id</a>

                                <a class="d-block" href="javascript:void(0)">+6287887177736</a>

                            </div>



                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>

                        </div>

                        <div class="ms-auto">

                            <a class="nav-link icon p-0" href="javascript:void(0)">

                                <svg class="header-icon" x="1008" y="1248" viewBox="0 0 24 24" height="100%"
                                    width="100%" preserveAspectRatio="xMidYMid meet" focusable="false">
                                    <path opacity=".3"
                                        d="M12 6.5c-2.49 0-4 2.02-4 4.5v6h8v-6c0-2.48-1.51-4.5-4-4.5z"></path>
                                    <path
                                        d="M12 22c1.1 0 2-.9 2-2h-4c0 1.1.9 2 2 2zm6-11c0-3.07-1.63-5.64-4.5-6.32V4c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5v.68C7.64 5.36 6 7.92 6 11v5l-2 2v1h16v-1l-2-2v-5zm-2 6H8v-6c0-2.48 1.51-4.5 4-4.5s4 2.02 4 4.5v6zM7.58 4.08L6.15 2.65C3.75 4.48 2.17 7.3 2.03 10.5h2a8.445 8.445 0 013.55-6.42zm12.39 6.42h2c-.15-3.2-1.73-6.02-4.12-7.85l-1.42 1.43a8.495 8.495 0 013.54 6.42z">
                                    </path>
                                </svg>

                                <span class="pulse "></span>

                            </a>

                        </div>

                    </div>

                </div>

            </div>

            <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191"
                    width="24" height="24" viewBox="0 0 24 24">
                    <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z" />
                </svg></div>

        </div>

    </aside>

</div>