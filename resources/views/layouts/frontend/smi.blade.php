<!doctype html>
<html class="no-js" data-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ $title === "" ? config('meta_title') : $title }}</title>
    <meta name="keywords" content="{{ $meta_keywords === "" ? config('meta_keywords') : $meta_keywords }}" />
    <meta name="description" content="{{ $meta_description === "" ? config('meta_description') : $meta_description }}" />
    <meta property="fb:app_id" content="idetechno"/>
    <meta property="og:type" content="website" />
    <meta property="og:title" content="{{ $title === "" ? config('meta_title') : $title }}"/>
    <meta property="og:description" content="{{ $meta_description === "" ? config('meta_description') : $meta_description }}" />
    <meta property="og:url" content="{{ $url }}"/>
    <meta property="og:image" content="{{ $url_future_image }}" />



    <!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta property="twitter:domain" content="beta.sistemmanajemen.id">
    <meta property="twitter:url" content="{{ $url }}">
    <meta name="twitter:title" content="{{ $title === "" ? config('meta_title') : $title }}">
    <meta name="twitter:description" content="{{ $meta_description === "" ? config('meta_description') : $meta_description }}">
    <meta name="twitter:image" content="{{ $url_future_image }}">

    <!-- Meta Tags Generated via https://www.opengraph.xyz -->


    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="msapplication-TileColor" content="#1A83FF">
    <meta name="msapplication-TileImage" content="{{ $url_future_image }}">
    <meta name="theme-color" content="#1A83FF">

    <link rel="icon" href="{{ url('images/logo') }}/{{ AppLogo() }}" type="image/x-icon"/>

    
    <!--==============================
	  Google Fonts
	============================== -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@300;400;500;600;700;800;900&family=Poppins:wght@100;200;300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!--==============================
	    All CSS File
	============================== -->
    <link rel="stylesheet" href="{{ asset('frontend' )}}/css/bootstrap.min.css">
    <!-- Fontawesome Icon -->
    <link rel="stylesheet" href="{{ asset('frontend' )}}/css/fontawesome.min.css">
    <!-- Magnific Popup -->
    <link rel="stylesheet" href="{{ asset('frontend' )}}/css/magnific-popup.min.css">
    <!-- Slick Slider -->
    <link rel="stylesheet" href="{{ asset('frontend' )}}/css/slick.min.css">
    <!-- Theme Custom CSS -->
    <link rel="stylesheet" href="{{ asset('frontend' )}}/css/style.css">
    <link rel="stylesheet" href="{{ asset('frontend' )}}/css/custom_style.css">

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-W6YZTVVMS9"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-W6YZTVVMS9');
    </script>

    @yield('css_scripts')

    
</head>

<body>
    <div class="preloader">
        <div class="preloader-inner">
            <span class="loader"></span>
        </div>
    </div>

    <div class="popup-subscribe-area hide">
        <div class="container">
            <div class="popup-subscribe" style="width: 320px; border-radius:3%;">
                <div class="box-img">
                    <a target="_blank" href="{{ infobox()->link }}">
                        <img src="{{ asset('images/infobox')}}/{{infobox()->image}}" alt="{{ infobox()->title }}" style="border-radius:3%;">
                    </a>
                    <button class="simple-icon popupClose"><i class="fal fa-times"></i></button>
                </div>
            </div>
        </div>
    </div>

    
    {{-- side menu --}}
    @include('frontend.include.sidemenu') 
    {{-- side menu --}}
    

    
    <div class="popup-search-box">
        <button class="searchClose"><i class="fal fa-times"></i></button>
        <form action="#">
            <input type="text" placeholder="What are you looking for?">
            <button type="submit"><i class="fal fa-search"></i></button>
        </form>
    </div>
    
    {{-- mobile menu --}}
    @include('frontend.include.mobile') 
    {{-- mobile menu --}}


    
    {{-- header --}}
    @include('frontend.include.header') 
    {{-- header --}}



    @yield('content')



    {{-- footer --}}
    @include('frontend.include.footer') 
    {{-- footer --}}


    <!-- Scroll To Top -->
    <div class="scroll-top">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" style="transition: stroke-dashoffset 10ms linear 0s; stroke-dasharray: 307.919, 307.919; stroke-dashoffset: 307.919;"></path>
        </svg>
    </div>

<!--
==============================
    All Js File
==============================
-->

    <!-- Jquery -->
    <script src="{{ asset('frontend' )}}/js/vendor/jquery-3.6.0.min.js"></script>
    <!-- Slick Slider -->
    <script src="{{ asset('frontend' )}}/js/slick.min.js"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('frontend' )}}/js/bootstrap.min.js"></script>
    <!-- Magnific Popup -->
    <script src="{{ asset('frontend' )}}/js/jquery.magnific-popup.min.js"></script>
    <!-- Counter Up -->
    <script src="{{ asset('frontend' )}}/js/jquery.counterup.min.js"></script>
    
    <script src="{{ asset('frontend' )}}/js/jquery-ui.min.js"></script>
    <!-- Isotope Filter -->
    <script src="{{ asset('frontend' )}}/js/imagesloaded.pkgd.min.js"></script>
    <script src="{{ asset('frontend' )}}/js/isotope.pkgd.min.js"></script>
    <!-- Vimeo Player -->
    <script src="{{ asset('frontend' )}}/js/vimeo_player.js"></script>

    <!-- Main Js File -->
    <script src="{{ asset('frontend' )}}/js/main.js"></script>

    @yield('js_scripts')


    <script>

    @if(infobox()->status =='on')
        // Fungsi untuk menutup popup
        function closePopup(popupBox, popupClose) {
            $(popupClose).on("click", function () {
                $(popupBox).addClass('hide');
            });
        }
        closePopup(".popup-subscribe-area", ".popupClose");

        // Fungsi untuk menghancurkan popup saat tombol destroy diklik
        $("#destroyPopup").on("click", function () {
            $(".popup-subscribe-area").addClass('hide');
            localStorage.setItem("popupDestroyed", "true");
        });

        // Menampilkan popup setelah 6 detik
        setTimeout(function() {
            $(".popup-subscribe-area").removeClass('hide'); // Tampilkan popup dengan menghapus kelas 'hide'
        }, 6000);  // 6000 ms = 6 detik
    @endif

    </script>
</body>

</html>