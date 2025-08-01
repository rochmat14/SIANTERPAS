<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>

    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1" />
    <meta name='robots' content='index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1' />
    <title>{{ $title === "" ? config('meta_title') : $title }}</title>
    <meta name="keywords" content="{{ $meta_keywords === "" ? config('meta_keywords') : $meta_keywords }}" />
    <meta name="description" content="{{ $meta_description === "" ? config('meta_description') : $meta_description }}" />
    <meta property="fb:app_id" content="idetechno"/>
    <meta property="og:type" content="website" />
    <meta property="og:title" content="{{ $title === "" ? config('meta_title') : $title }}"/>
    <meta property="og:description" content="{{ $meta_description === "" ? config('meta_description') : $meta_description }}" />
    <meta property="og:url" content="{{ $url }}"/>
    <meta property="og:image" content="{{ $url_future_image }}" />
    
    <!-- Title -->
    <title>{{ $title === "" ? config('meta_title') : $title }}</title>
    
    <!-- Favicon -->
    <link rel="icon" href="{{ url('images/logo') }}/{{ AppLogo() }}" type="image/x-icon"/>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('frontend' )}}/css/plugins.css?v=3.0"/>
    <!-- Punch Navigation Stylesheet -->
    <link rel="stylesheet" href="{{ asset('frontend' )}}/css/components/quadra/gold.punch.navigation.css"/>
    <!-- Theme Styles -->
    <link rel="stylesheet" href="{{ asset('frontend' )}}/css/theme.css?v=3.0"/>
    <!-- Demo Styles -->
    <link rel="stylesheet" href="{{ asset('frontend' )}}/content/everest/css/everest.css?v=3.0" />
    <!-- Color Scheme -->
    <link id="changeable_color" rel="stylesheet" href="{{ asset('frontend' )}}/css/skins/skin-everest.css" />
    <!-- End Page Styles -->

    @yield('vendor_css')
    @yield('css_scripts')
    


    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-Y1K8K2D5P6"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'G-Y1K8K2D5P6');
    </script>

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-HGFQ9S5RZP"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'G-HGFQ9S5RZP');
    </script>

</head>

<!-- BODY START -->
<body class="c-dot hover-cursor">

    <!-- Loader -->
    {{-- <div class="page-loader bg-white">
        <div class="loader-square bg-colored3"></div>
    </div> --}}

    <div class="loader-signal">
        <div class="loader__figure b-colored"></div>
    </div>

    <!-- Start Navigation -->
    <nav id="navigation" class="modern-nav fixed capitalize fs-16 details-dark link-hover-01 normal nav-white nav-xl dropdown-radius" data-offset="0">
        <!-- Navigation container - You can chnage container type and paddding value -->
        <div class="container-fluid nav-container pr-0">
            <!-- Row for cols in the nav -->
            <div class="row nav-wrapper mr-0">
                <!-- Column for logo -->
                <div class="col-auto mr-50">
                    <a href="{{ url('/') }}" class="logo">
                        <img src="{{ url('images/logo') }}/{{ AppLogo() }}" alt="website logo" class="logo-white">
                        <img src="{{ url('images/logo') }}/{{ AppLogo() }}" alt="website logo" class="logo-dark">
                    </a>
                </div>
                <!-- Column for Navigation -->
                <div class="col nav-menu">
                    <!-- Navigation links, you can add nav-links-centered class for centered links -->
                    <ul class="nav-links justify-content-start">
                        <!-- Logo for mobile navigation -->
                        <li class="logo-for-mobile-navigation"><img src="{{ url('images/logo') }}/{{ AppLogo() }}" alt="website logo" class="logo-white"></li>
                        <!-- Links -->
                        <li class="active"><a href="{{ url('/') }}#home" class="nav-link">Welcome</a></li>
                        <li><a href="{{ url('/') }}#about" class="nav-link">Tentang Kami</a></li>
                        <li><a href="{{ url('/') }}#service-kami" class="nav-link">Services</a></li>
                        <li><a href="{{ url('/') }}/projects" class="nav-link">Projects</a></li>
                        <li><a href="{{ url('blogs') }}" class="nav-link">Tips & Trick</a></li>
                    </ul>
                </div>
                <!-- Column for Navigation -->
                <div class="col pr-0">
                    <!-- Navigation links, you can add nav-links-centered class for centered links -->
                    <ul class="nav-links justify-content-end">
                        <!-- Extra Links -->
                        <li class="extra-links pr-0">
                            <a href="#" class="punch-nav-trigger fullheight nav-button width-120 visible-lg bg-colored3 white fs-11 uppercase bold slow hover-cursor" title="Buy Quadra Now">
                                <div class="hamburger-menu">
                                    <div class="top-bun bg-white"></div>
                                    <div class="meat bg-white"></div>
                                    <div class="bottom-bun bg-white"></div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- Mobile Nav Button -->
                <div class="mobile-nb">
                    <div class="hamburger-menu">
                        <div class="top-bun"></div>
                        <div class="meat"></div>
                        <div class="bottom-bun"></div>
                    </div>
                </div>
            </div>
            <!-- End Row for cols in the nav -->
        </div>
        <!-- End Navigation container -->
        <div class="mobile-nav-bg"></div>
    </nav>
    <!-- End Navigation -->
    <!-- Punch Navigation -->
    <nav id="punch-nav" class="punch-nav">
        <!-- Container for all -->
        <div class="container-fluid height-85vh height-auto-sm">
            <!-- Row for inner elements -->
            <div class="row">
                <!-- Col for logo and close buttons -->
                <div class="col-12 absolute height-100 px-50 left-0 top-0 zi-5 d-flex align-items-center animate" data-animation="fadeIn" data-animation-delay="700">
                    <div class="row">
                        <!-- Logo column -->
                        <div class="col d-flex justify-content-start align-items-center">
                            <img src="{{ url('images/logo') }}/{{ AppLogo() }}" alt="navigation logo" class="height-40 block" title="Quadra Premium Template">
                        </div>
                        <!-- Close SVG button -->
                        <div class="col d-flex justify-content-end align-items-center">
                            <a href="#" class="close block">
                                <svg width="33px" height="31px" viewBox="0 0 33 31" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" stroke-linecap="square">
                                        <path d="M31.5693018,0.430698159 L1.36523438,30.6347656" stroke="#525252" transform="translate(16.500000, 15.500000) rotate(-270.000000) translate(-16.500000, -15.500000) "></path>
                                        <path d="M31.5693018,0.430698159 L1.36523438,30.6347656" stroke="#525252" transform="translate(16.500000, 15.500000) rotate(-180.000000) translate(-16.500000, -15.500000) "></path>
                                    </g>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- End col for logo and close buttons -->
                <!-- Punch navigation col - links -->
                <div class="col-lg col-12-sm punch-nav-col bg-white d-flex align-items-center">
                    <ul class="m-0 pl-60 pl-30-sm pt-150-sm pb-70-sm inline-block-links fs-45 fs-30-sm black lh-md">

                    

                        <li>
                            <a href="{{ url('/') }}#home" class="underline-hover-slide underline-slide animate" data-animation="fadeInDown" data-animation-delay="800">
                                Welcome
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/') }}#about" class="underline-hover-slide underline-slide animate" data-animation="fadeInDown" data-animation-delay="900">
                                Tentang Kami
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/') }}#service-kami" class="underline-hover-slide underline-slide animate" data-animation="fadeInDown" data-animation-delay="1000">  Services
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/projects') }}" class="underline-hover-slide underline-slide animate" data-animation="fadeInDown" data-animation-delay="1100">
                                Projects
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('blogs') }}" target="_blank" class="underline-hover-slide underline-slide animate" data-animation="fadeInDown" data-animation-delay="1300">Tips & Trick</a>
                        </li>
                    </ul>
                </div>
                <!-- End punch navigation col -->
                <!-- Punch navigation col - right content -->
                <div class="col-lg col-12-sm pb-70-sm punch-nav-col bg-white d-flex align-items-center">
                    <!-- Keeper for content -->
                    <div class="t-left animate pl-30-sm" data-animation="fadeIn" data-animation-delay="1300">
                        <!-- Title and mail -->
                        <h4 class="fs-24 fs-18-sm gray7 light" >Talk to us about something.</h4>
                        <a href="mailto:{!! config('email_link') !!}" class="inline-block mt-5 light fs-36 lh-50 fs-24-sm dark3 underline-hover-slide underline-slide">
                            {!! config('email_link') !!}
                        </a>
                        <!-- Address boxes -->
                        <div class="row pt-10 gray5 fs-22 fs-18-sm lh-35 lh-30-sm light">
                            <div class="col-lg-6 col-12 mt-30 pl-0">
                                <h5 class="fs-16 dark3 mb-10">Alamat Kami</h5>
                                <address class="m-0">{!! config('office_address') !!}</address>
                            </div>
                        </div>
                        <!-- Social buttons -->
                        <div class="mt-40">
                            <ul class="d-flex m-0">
                                <li><a href="{!! config('facebook_link') !!}" target="_blank" class="underline-slide underline-gray fs-16 gray5 lh-25 mr-20 inline-block">Facebook</a></li>
                                <li><a href="{!! config('linkedin_link') !!}" target="_blank" class="underline-slide underline-gray fs-16 gray5 lh-25 mr-20 inline-block">Linkedin</a></li>
                                <li><a href="{!! config('instagram_link') !!}" target="_blank" class="underline-slide underline-gray fs-16 gray5 lh-25 mr-20 inline-block">Instagram</a></li>
                                <li><a href="{!! config('whatsapp_link') !!}" target="_blank" class="underline-slide underline-gray fs-16 gray5 lh-25 mr-20 inline-block">WhatsApp</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- End keeper for content -->
                </div>
                <!-- End punch navigation col -->
            </div>
            <!-- End row for inner elements -->
        </div>
        <!-- End container for all -->
    </nav>
    <!-- End punch Navigation -->

    {{-- konten --}}
    @yield('content')

    <footer id="footer-09" class="mt-70 o-visible relative bg-colored3 b-0">
        <!-- Top waves -->
        <div class="section-waves waves-top" data-bg="url({{ asset('frontend' )}}/images/waves/top_02.svg)"></div>
        <!-- Keeper for all footer -->
        <div class="relative pt-200 pt-120-sm">
            <!-- Container for footer -->
            <div class="container-lg">
                <!-- Row for footer cols -->
                <div class="row">
                    <!-- Column -->
                    <div class="col-12 mt-50 t-center">
                        <h5 class="bold fs-12 uppercase ls-3 ls-0-sm white">{!! config('app_name') !!}</h5>
                        <h2 class="white lh-45 lh-35-sm medium ls--1 ls-0-sm mt-10">
                            {!! config('app_desc') !!}
                        </h2>
                    </div>
                    <!-- End column -->
                </div>
                <!-- End row for footer cols -->
            </div>
            <!-- Container for footer -->
            <!-- Footer Bottom - copyright and privacy-terms -->
            <div class="relative py-25 lh-normal mt-120 mt-70-sm">
                <hr class="fullwidth top-0 left-0 height-1 bg-white opacity-1 absolute m-0">
                <div class="container-lg">
                    <div class="row align-items-center">
                        <div class="col-lg col-sm-12 t-left t-center-sm">
                            <p class="white fs-14 mt-5 mt-10-sm medium">{!! config('footer_text') !!}</p>
                        </div>
                        <div class="col-lg col-sm-12 mt-10-sm white fs-14 t-right t-center-sm">
                            <a href="{!! config('linkedin_link') !!}" target="_blank" class="icon-xs width-40 height-40 bg-linkedin-hover bg-soft-white2 circle white slow-sm ml-10 mx-5-sm"><i class="fab fa-linkedin"></i></a>
                            <a href="{!! config('facebook_link') !!}" target="_blank" class="icon-xs width-40 height-40 bg-facebook-hover bg-soft-white2 circle white slow-sm ml-10 mx-5-sm"><i class="fab fa-facebook"></i></a>
                            <a href="{!! config('instagram_link') !!}" target="_blank" class="icon-xs width-40 height-40 bg-instagram-hover bg-soft-white2 circle white slow-sm ml-10 mx-5-sm"><i class="fab fa-instagram"></i></a>
                            <a href="{!! config('whatsapp_link') !!}" target="_blank" class="icon-xs width-40 height-40 bg-whatsapp-hover bg-soft-white2 circle white slow-sm ml-10 mx-5-sm"><i class="fab fa-whatsapp"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End footer Bottom -->
        </div>
        <!-- End keeper for all footer -->
    </footer>
    <!-- Back To Top -->
    <a id="back-to-top" href="#top" class="btt circle width-60 width-50-sm height-60 height-50-sm bg-white b-1 b-gray2 gray7 t-left">
        <i class="ti-angle-up fs-18"></i>
    </a>


    <div id='whatsapp-chat' class='hide'>
      <div class='header-chat'>
        <div class='head-home'>
          <div class='info-avatar'><img src='{{ asset('frontend' )}}/images/avatar.png'/></div>
          <p><span class="whatsapp-name">IdeTechno</span><br><small>IT Digital Solution</small></p>

        </div>
        <div class='get-new hide'>
          <div id='get-label'></div>
          <div id='get-nama'></div>
        </div>
      </div>
      <div class='home-chat'>

      </div>
      <div class='start-chat'>
        <div pattern="https://elfsight.com/assets/chats/patterns/whatsapp.png" class="WhatsappChat__Component-sc-1wqac52-0 whatsapp-chat-body">
          <div class="WhatsappChat__MessageContainer-sc-1wqac52-1 dAbFpq">
            <div style="opacity: 0;" class="WhatsappDots__Component-pks5bf-0 eJJEeC">
              <div class="WhatsappDots__ComponentInner-pks5bf-1 hFENyl">
                <div class="WhatsappDots__Dot-pks5bf-2 WhatsappDots__DotOne-pks5bf-3 ixsrax"></div>
                <div class="WhatsappDots__Dot-pks5bf-2 WhatsappDots__DotTwo-pks5bf-4 dRvxoz"></div>
                <div class="WhatsappDots__Dot-pks5bf-2 WhatsappDots__DotThree-pks5bf-5 kXBtNt"></div>
              </div>
            </div>
            <div style="opacity: 1;" class="WhatsappChat__Message-sc-1wqac52-4 kAZgZq">
              <div class="WhatsappChat__Author-sc-1wqac52-3 bMIBDo colored">IdeTechno</div>
              <div class="WhatsappChat__Text-sc-1wqac52-2 iSpIQi">Hallo 👋<br><br>Jangan sungkan untuk bertanya disini ?</div>
              <div class="WhatsappChat__Time-sc-1wqac52-5 cqCDVm">{{ date('h:i') }}</div>
            </div>
          </div>
        </div>

        <div class='blanter-msg'>
          <textarea id='chat-input' placeholder='Ketik pesan disini...' maxlength='120' row='1'></textarea>
          <a href='javascript:void;' id='send-it'><svg viewBox="0 0 448 448"><path d="M.213 32L0 181.333 320 224 0 266.667.213 416 448 224z"/></svg></a>

        </div>
      </div>
      <div id='get-number'></div><a class='close-chat' href='javascript:void'>×</a>
    </div>
    <a class='blantershow-chat' href='javascript:void' title='Show Chat'><svg width="20" viewBox="0 0 24 24"><defs/><path fill="#eceff1" d="M20.5 3.4A12.1 12.1 0 0012 0 12 12 0 001.7 17.8L0 24l6.3-1.7c2.8 1.5 5 1.4 5.8 1.5a12 12 0 008.4-20.3z"/><path fill="#4caf50" d="M12 21.8c-3.1 0-5.2-1.6-5.4-1.6l-3.7 1 1-3.7-.3-.4A9.9 9.9 0 012.1 12a10 10 0 0117-7 9.9 9.9 0 01-7 16.9z"/><path fill="#fafafa" d="M17.5 14.3c-.3 0-1.8-.8-2-.9-.7-.2-.5 0-1.7 1.3-.1.2-.3.2-.6.1s-1.3-.5-2.4-1.5a9 9 0 01-1.7-2c-.3-.6.4-.6 1-1.7l-.1-.5-1-2.2c-.2-.6-.4-.5-.6-.5-.6 0-1 0-1.4.3-1.6 1.8-1.2 3.6.2 5.6 2.7 3.5 4.2 4.2 6.8 5 .7.3 1.4.3 1.9.2.6 0 1.7-.7 2-1.4.3-.7.3-1.3.2-1.4-.1-.2-.3-.3-.6-.4z"/></svg> Chat with Us</a>

    <!-- jQuery -->
    <script src="{{ asset('frontend' )}}/js/jquery.min.js?v=3"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('frontend' )}}/js/bs.js?v=5.1.3"></script>
    <!-- Punch Navigation Scripts -->
    <script src="{{ asset('frontend' )}}/js/components/quadra/gold.punch.navigation.js"></script>
    <!-- MAIN SCRIPTS - Classic scripts for all theme -->
    <script src="{{ asset('frontend' )}}/js/scripts.js?v=3.0"></script>
    <!-- PAGE OPTIONS - You can find special scripts for Antares -->
    <script src="{{ asset('frontend' )}}/content/everest/js/plugins.js?v=3"></script>
    <!-- END JS FILES -->
    @yield('js_scripts')

    <script type="text/javascript">
        /* Whatsapp Chat Widget by https://codepen.io/vishwaoffl/*/
        $(document).on("click", "#send-it", function() {
          var a = document.getElementById("chat-input");
          if ("" != a.value) {
            var b = $("#get-number").text(),
              c = document.getElementById("chat-input").value,
              d = "https://web.whatsapp.com/send",
              e = b,
              f = "&text=" + c;
            if (
              /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(
                navigator.userAgent
              )
            )
              var d = "whatsapp://send";
            var g = d + "?phone=+6287887177736" + e + f;
            window.open(g, "_blank");
          }
        }),
          $(document).on("click", ".informasi", function() {
            (document.getElementById("get-number").innerHTML = $(this)
              .children(".my-number")
              .text()),
              $(".start-chat,.get-new")
                .addClass("show")
                .removeClass("hide"),
              $(".home-chat,.head-home")
                .addClass("hide")
                .removeClass("show"),
              (document.getElementById("get-nama").innerHTML = $(this)
                .children(".info-chat")
                .children(".chat-nama")
                .text()),
              (document.getElementById("get-label").innerHTML = $(this)
                .children(".info-chat")
                .children(".chat-label")
                .text());
          }),
          $(document).on("click", ".close-chat", function() {
            $("#whatsapp-chat")
              .addClass("hide")
              .removeClass("show");
          }),
          $(document).on("click", ".blantershow-chat", function() {
            $("#whatsapp-chat")
              .addClass("show")
              .removeClass("hide");
          });

    </script>
</body>
<!-- Body End -->
</html>
