<footer class="footer-wrapper footer-layout1" data-bg-src="{{ asset('frontend' )}}/img/bg/footer_bg_1.png">
    <div class="widget-area">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-md-6 col-xl-3">
                    <div class="widget footer-widget">
                        <div class="th-widget-about">
                            <div class="about-logo">
                                <a href="{{ route('home') }}">
                                    <img src="{{ url('images/logo') }}/{{ AppLogo() }}" alt="{{ AppSeting('app_name') }}">
                                </a>
                            </div>
                            <p class="about-text">
                                {{ AppSeting('app_desc') }}
                            </p>
                            <div class="th-social style-black">
                                <a href="{{ AppSeting('facebook_link') }}" target="_blank"><i class="fab fa-facebook-f"></i></a>
                                <a href="{{ AppSeting('instagram_link') }}" target="_blank"><i class="fab fa-instagram"></i></a>
                                <a href="{{ AppSeting('linkedin_link') }}" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                                <a href="{{ AppSeting('whatsapp_link') }}" target="_blank"><i class="fab fa-whatsapp"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-auto">
                    <div class="widget widget_nav_menu footer-widget">
                        <h3 class="widget_title">Categories</h3>
                        <div class="menu-all-pages-container">
                            <ul class="menu">

                                @foreach(getKategori() as $key => $value)
                                  @php
                                      $url_category = LaravelLocalization::getLocalizedURL(LaravelLocalization::getCurrentLocale(),URL::to('blogs?category='.$value->slug ));
                                  @endphp
                                <li>
                                    <a href="{{$url_category}}">{{ $value->name }}
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-auto">
                    <div class="widget footer-widget">
                        <h3 class="widget_title">Recent Posts</h3>
                        <div class="recent-post-wrap">
                            @foreach (Get_recent_post() as $key => $value)
                             @php
                                $blogsDescription = $value->description()->where('language_id',LaravelLocalization::getCurrentLocale())->first();
                                $blogUrl = LaravelLocalization::getLocalizedURL(LaravelLocalization::getCurrentLocale(),URL::to('blogs/'.$value->slug ));
                             @endphp
                            <div class="recent-post">
                                <div class="media-img">
                                    <a href="{{ $blogUrl }}">
                                        <img src="{{ URL::asset('/images/news')}}/{{ $value->id }}/{{ $value->image }}" alt="{!! $blogsDescription->title !!}" width="100">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h4 class="post-title"><a class="hover-line" href="{{ $blogUrl }}">{!! $blogsDescription->title !!}</a></h4>
                                    <div class="recent-post-meta">
                                        <a href="{{ $blogUrl }}"><i class="fal fa-calendar-days"></i>
                                            {{ arrMonth(LaravelLocalization::getCurrentLocale())[date('n', strtotime($value->published_on))] }} -
                                            {{ date('d', strtotime($value->published_on)) }} - 
                                            {{ date('Y', strtotime($value->published_on)) }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="widget widget_nav_menu footer-widget">
                        <h3 class="widget_title">Legal Aspek</h3>
                        <div class="menu-all-pages-container">
                            <ul class="menu">
                                @foreach(menu_aspek_hukum() AS $key => $value)
                                @php
                                    $pageMenu = $value->description()->where('language_id',LaravelLocalization::getCurrentLocale())->first();
                                    $pageUrl = LaravelLocalization::getLocalizedURL(LaravelLocalization::getCurrentLocale(),URL::to('pages/'.$value->slug ));
                                @endphp
                                    <li>
                                        <a class="@if($link_page === $value->slug ) text-primary @endif" href="{{ $pageUrl }}">{{ $pageMenu->name }}</a>
                                    </li>
                                @endforeach
                                <li><a href="{{ route('contact_us') }}">Kontak Kami</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright-wrap">
        <div class="container">
            <div class="row jusity-content-between align-items-center">
                <div class="col-lg-12">
                    <p class="copyright-text text-center">  
                        {{ AppSeting('footer_text') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>