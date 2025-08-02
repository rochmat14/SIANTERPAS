@php

    $assets = asset('new_assets');

@endphp

<!DOCTYPE html>

<html lang="en" dir="ltr">



<head>



    <!-- Meta data -->

    <meta charset="UTF-8">

    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>

    <meta content="{{ AppName() }}" name="description">

    <meta content="IE Indonesia" name="author">

    <meta name="keywords" content="{{ AppName() }}" />

    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- Title -->

    <title>{{ AppName() }}</title>

    <link rel="icon" href="{{ url('/images/logo') }}/{{ AppLogo() }}" type="image/x-icon" />





    <!-- Bootstrap css -->

    <link id="style" href="{{ $assets }}/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />



    <!-- Style css -->

    <link href="{{ $assets }}/css/style.css" rel="stylesheet" />



    <!-- Plugin css -->

    <link href="{{ $assets }}/css/plugin.css" rel="stylesheet" />



    <!-- Animate css -->

    <link href="{{ $assets }}/css/animated.css" rel="stylesheet" />



    <!---Icons css-->

    <link href="{{ $assets }}/plugins/web-fonts/icons.css" rel="stylesheet" />

    <link href="{{ $assets }}/plugins/web-fonts/font-awesome/font-awesome.min.css" rel="stylesheet">

    <link href="{{ $assets }}/plugins/web-fonts/plugin.css" rel="stylesheet" />

    @yield('vendor_css')

    @yield('css_scripts')

</head>



<body class="main-body app sidebar-mini" id="body_frontend">

    <!---Global-loader-->

    <div id="global-loader">

        <img src="{{ $assets }}/images/svgs/loader.svg" alt="loader">

    </div>





    <div class="page">
        <div class="page-main">          
            <div class="app-content" id="body_layout_antrian">

                <div class="side-app">
                    {{-- content --}}

                    @yield('content')

                </div>
            </div><!-- end app-content-->
        </div>
    </div>





    <!-- Back to top -->

    <a href="#top" id="back-to-top">

        <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
            <path d="M0 0h24v24H0V0z" fill="none" />
            <path d="M4 12l1.41 1.41L11 7.83V20h2V7.83l5.58 5.59L20 12l-8-8-8 8z" />
        </svg>

    </a>



    <!-- Jquery js-->

    <script src="{{ $assets }}/js/vendors/jquery.min.js"></script>

    <!-- Bootstrap5 js-->

    <script src="{{ $assets }}/plugins/bootstrap/js/popper.min.js"></script>

    <script src="{{ $assets }}/plugins/bootstrap/js/bootstrap.min.js"></script>

    <!--Othercharts js-->

    <script src="{{ $assets }}/plugins/othercharts/jquery.sparkline.min.js"></script>

    <!-- Circle-progress js-->

    <script src="{{ $assets }}/js/vendors/circle-progress.min.js"></script>

    <!-- Jquery-rating js-->

    <script src="{{ $assets }}/plugins/rating/jquery.rating-stars.js"></script>

    <!-- P-scroll js-->

    <script src="{{ $assets }}/plugins/p-scrollbar/p-scrollbar.js"></script>

    <!--Sidemenu js-->

    <script src="{{ $assets }}/plugins/sidemenu/sidemenu.js"></script>

    <!-- Sticky js -->

    <script src="{{ $assets }}/js/sticky.js"></script>

    <!-- Color Theme js -->

    <script src="{{ $assets }}/js/themeColors.js"></script>

    <!-- Switcher-Styles js -->

    <script src="{{ $assets }}/js/switcher-styles.js"></script>

    <!-- Custom js-->

    <script src="{{ $assets }}/js/custom.js"></script>

    @yield('vendor_js')

    @yield('js_scripts')

</body>



</html>
