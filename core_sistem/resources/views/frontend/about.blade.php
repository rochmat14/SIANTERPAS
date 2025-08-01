@extends('layouts.frontend.smi')
@section('bodyClass', 'front preload')
@section('navActive', 'home')
@section('content')
@section('css_scripts')
@endsection
@section('js_scripts')
@endsection
<div class="breadcumb-wrapper">
    <div class="container">
        <ul class="breadcumb-menu">
            <li><a href="{{ route('home') }}">Home</a></li>
            <li>{{ $title_page }}</li>
        </ul>
    </div>
</div>
<!--==============================
About Area  
==============================-->
<div class="space2" id="about-sec">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-7 mb-30 mb-xl-0">
                
                <div class="img1">
                    <img src="{{ $url_future_image }}" alt="About" style="width: 100%;">
                </div>
            </div>
            <div class="col-xl-5">
                <div class="title-area mb-32">
                    <span class="sub-title">{{ $title_page }}</span>
                    {!! $pageDescription->description !!}
                    {{-- <h2 class="sec-title2">Over 25 years, we have been delivering real news</h2>
                    <p class="sec-text">Sugg</p> --}}
                </div>
                {{-- <div class="checklist mt-n2 mb-35">
                    <ul>
                        <li><i class="far fa-check-circle"></i> User experience</li>
                        <li><i class="far fa-check-circle"></i> Strategy and Art Direction</li>
                        <li><i class="far fa-check-circle"></i> Unique layouts Blocks</li>
                    </ul>
                </div>
                <a href="about.html" class="th-btn">About More<i class="fas fa-arrow-up-right ms-2"></i></a> --}}
            </div>
        </div>
    </div>
</div>
<!--==============================
Cta Area  
==============================-->
<section class="cta-sec-1" data-bg-src="{{ asset('frontend' )}}/img/bg/cta_bg_1.jpg">
    <div class="container space2">
        <div class="row text-center text-md-start align-items-center justify-content-md-between justify-content-center">
            <div class="col-lg-7 col-md-8 mb-40 mb-md-0">
                <div class="title-area mb-0">
                    <span class="sub-title">Get consulting</span>
                    <h2 class="sec-title2 h1 text-white">Experience excellence our magazine's</h2>
                </div>
            </div>
            <div class="col-md-auto">
                <a href="contact.html" class="th-btn style3">Contact Us<i class="fas fa-arrow-up-right ms-2"></i></a>
            </div>
        </div>
    </div>
</section><!--==============================
Counter Area  
==============================-->
<div class="counter-sec-1">
    <div class="container">
        <div class="counter-card-wrap">
            <div class="counter-card">
                <h2 class="counter-card_number"><span class="counter-number">25</span>+</h2>
                <span class="counter-card_text">Years Of Experience</span>
            </div>
            <div class="counter-card">
                <h2 class="counter-card_number"><span class="counter-number">86</span>+</h2>
                <span class="counter-card_text">Get Winning Award</span>
            </div>
            <div class="counter-card">
                <h2 class="counter-card_number"><span class="counter-number">149</span>+</h2>
                <span class="counter-card_text">Experience News Writer</span>
            </div>
            <div class="counter-card">
                <h2 class="counter-card_number"><span class="counter-number">15</span>+</h2>
                <span class="counter-card_text">Language Translator</span>
            </div>
        </div>
    </div>
</div>






@endsection