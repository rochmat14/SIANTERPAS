@extends('layouts.frontend.smi')
@section('bodyClass', 'front preload')
@section('navActive', 'about')
@section('content')
@section('css_scripts')
@endsection
@section('js_scripts')
@endsection

<div class="th-hero-wrapper hero-1" id="hero">
    <div class="hero-slider-1 th-carousel" data-fade="true" data-slide-show="1" data-md-slide-show="1" data-adaptive-height="true">

        @foreach($slide as $key => $value)


        <div class="th-hero-slide">
            <div class="th-hero-bg" data-overlay="black" data-opacity="6" data-bg-src="{{ asset('images/slideshow' )}}/{{ $value->image }}"></div>
            <div class="container">
                <div class="blog-bg-style1">

                    

                    <a data-theme-color="#1A83FF" data-ani="slideinup" data-ani-delay="0.1s" href="#" class="category">Case Study</a>
                    <h3 data-ani="slideinup" data-ani-delay="0.3s" class="box-title-50">
                        @if($value->url != '#')
                        @php
                            if($value->target ==2){
                            $target ="_blank";
                            }else{
                            $target ="_self";
                            }
                        @endphp
                       
                        <a class="hover-line" href="{{ $value->url }}" target="{{ $target }}">
                            {!! $value->title !!}
                        </a>
                        @endif
                    </h3>
                   
                    <p class="blog-text" data-ani="slideinup" data-ani-delay="0.7s">
                        {!! $value->subtitle !!}
                    </p>
                </div>
            </div>

        </div>

        @endforeach
        
    </div>
    <div class="hero-tab-area">
        <div class="container">
            <div class="hero-tab" data-asnavfor=".hero-slider-1">

                @foreach($slide as $key => $value)
                <div class="tab-btn active">
                    <img src="{{ asset('images/slideshow' )}}/{{ $value->image_mobile }}" alt="Image">
                </div>
                @endforeach
               
            </div>
        </div>
    </div>
</div>

<!--==============================
Blog Area  
==============================-->
<section class="space">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 mb-4 mb-xl-0">
                <div class="row gy-4">
                    <div class="dark-theme img-overlay2">
                        <div class="blog-style3">
                            <div class="blog-img">
                                <img src="{{ asset('frontend' )}}/img/blog/blog_5_7.jpg" alt="blog image">
                            </div>
                            <div class="blog-content">
                                <a data-theme-color="#007BFF" href="blog.html" class="category">Fashion</a>
                                <h3 class="box-title-30"><a class="hover-line" href="blog-details.html">Fashion-forward Where trends and Confidence collide</a></h3>
                                <div class="blog-meta">
                                    <a href="author.html"><i class="far fa-user"></i>By - Tnews</a>
                                    <a href="blog.html"><i class="fal fa-calendar-days"></i>20 Mar, 2023</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-xl-6">
                <div class="row gy-4">
                    <div class="col-xl-6 col-md-6 dark-theme img-overlay2">
                        <div class="blog-style3">
                            <div class="blog-img">
                                <img src="{{ asset('frontend' )}}/img/blog/blog_5_2_1.jpg" alt="blog image">
                            </div>
                            <div class="blog-content">
                                <a data-theme-color="#E8137D" href="blog.html" class="category">Music</a>
                                <h3 class="box-title-18"><a class="hover-line" href="blog-details.html">Music the key to unlock Your Emotions</a></h3>
                                <div class="blog-meta">
                                    <a href="author.html"><i class="far fa-user"></i>By - Tnews</a>
                                    <a href="blog.html"><i class="fal fa-calendar-days"></i>29 Mar, 2023</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-md-6 dark-theme img-overlay2">
                        <div class="blog-style3">
                            <div class="blog-img">
                                <img src="{{ asset('frontend' )}}/img/blog/blog_5_2_2.jpg" alt="blog image">
                            </div>
                            <div class="blog-content">
                                <a data-theme-color="#007BFF" href="blog.html" class="category">Travel</a>
                                <h3 class="box-title-18"><a class="hover-line" href="blog-details.html">Discover wonders Travel With an open heart.</a></h3>
                                <div class="blog-meta">
                                    <a href="author.html"><i class="far fa-user"></i>By - Tnews</a>
                                    <a href="blog.html"><i class="fal fa-calendar-days"></i>19 Mar, 2023</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-md-6 dark-theme img-overlay2">
                        <div class="blog-style3">
                            <div class="blog-img">
                                <img src="{{ asset('frontend' )}}/img/blog/blog_5_2_3.jpg" alt="blog image">
                            </div>
                            <div class="blog-content">
                                <a data-theme-color="#8750A6" href="blog.html" class="category">Fitness</a>
                                <h3 class="box-title-18"><a class="hover-line" href="blog-details.html">Inspire change, embrace Your fitness journey.</a></h3>
                                <div class="blog-meta">
                                    <a href="author.html"><i class="far fa-user"></i>By - Tnews</a>
                                    <a href="blog.html"><i class="fal fa-calendar-days"></i>24 Mar, 2023</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-md-6 dark-theme img-overlay2">
                        <div class="blog-style3">
                            <div class="blog-img">
                                <img src="{{ asset('frontend' )}}/img/blog/blog_5_2_4.jpg" alt="blog image">
                            </div>
                            <div class="blog-content">
                                <a data-theme-color="#4E4BD0" href="blog.html" class="category">Fashion</a>
                                <h3 class="box-title-18"><a class="hover-line" href="blog-details.html">Life is journey, find your Unique rhythm.</a></h3>
                                <div class="blog-meta">
                                    <a href="author.html"><i class="far fa-user"></i>By - Tnews</a>
                                    <a href="blog.html"><i class="fal fa-calendar-days"></i>12 Mar, 2023</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><!--==============================
Blog Area  
==============================-->
<section class="">
    <div class="container">
        <div class="row">
            <div class="col-xl-8">
                <h2 class="sec-title has-line">Trending News</h2>
            </div>
            <div class="col-xl-4">
                <div class="d-none d-xl-block">
                    <h2 class="sec-title has-line">Trending This Week</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-3">
                <div class="row gy-4">
                    <div class="col-xl-12 col-sm-6 border-blog">
                        <div class="blog-style1">
                            <div class="blog-img">
                                <img src="{{ asset('frontend' )}}/img/blog/blog_1_15.jpg" alt="blog image">
                                <a data-theme-color="#00D084" href="blog.html" class="category">Lifestyle</a>
                            </div>
                            <h3 class="box-title-22"><a class="hover-line" href="blog-details.html">Balance harmony and joy in Every lifestyle.</a></h3>
                            <div class="blog-meta">
                                <a href="author.html"><i class="far fa-user"></i>By - Tnews</a>
                                <a href="blog.html"><i class="fal fa-calendar-days"></i>26 Mar, 2023</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12 col-sm-6 border-blog">
                        <div class="blog-style1">
                            <div class="blog-img">
                                <img src="{{ asset('frontend' )}}/img/blog/blog_1_16.jpg" alt="blog image">
                                <a data-theme-color="#00D084" href="blog.html" class="category">Lifestyle</a>
                            </div>
                            <h3 class="box-title-22"><a class="hover-line" href="blog-details.html">Design a lifestyle that the radiates Happiness.</a></h3>
                            <div class="blog-meta">
                                <a href="author.html"><i class="far fa-user"></i>By - Tnews</a>
                                <a href="blog.html"><i class="fal fa-calendar-days"></i>13 Mar, 2023</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-5 mt-4 mt-xl-0">
                <div class="">
                    <div class="blog-style1 style-big">
                        <div class="blog-img">
                            <img src="{{ asset('frontend' )}}/img/blog/blog_2_3.jpg" alt="blog image">
                            <a data-theme-color="#FF9500" href="blog.html" class="category">Business</a>
                        </div>
                        <h3 class="box-title-30"><a class="hover-line" href="blog-details.html">Following the Moon, they are in Close space. choose the best</a></h3>
                        <div class="blog-meta">
                            <a href="author.html"><i class="far fa-user"></i>By - Tnews</a>
                            <a href="blog.html"><i class="fal fa-calendar-days"></i>23 Mar, 2023</a>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-xl-4 mt-35 mt-xl-0">
                <div class="d-block d-xl-none">
                    <h2 class="sec-title has-line">Trending This Week</h2>
                </div>
                <div class="row gy-4">
                    <div class="col-xl-12 col-md-6 border-blog">
                        <div class="blog-style2">
                            <div class="blog-img">
                                <img src="{{ asset('frontend' )}}/img/blog/blog_3_2_1.jpg" alt="blog image">
                            </div>
                            <div class="blog-content">
                                <a data-theme-color="#4E4BD0" href="blog.html" class="category">Sports</a>
                                <h3 class="box-title-20"><a class="hover-line" href="blog-details.html">Fast breaks, slam dunks Basketball thrills.</a></h3>
                                <div class="blog-meta">
                                    <a href="blog.html"><i class="fal fa-calendar-days"></i>13 Mar, 2023</a>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-xl-12 col-md-6 border-blog">
                        <div class="blog-style2">
                            <div class="blog-img">
                                <img src="{{ asset('frontend' )}}/img/blog/blog_3_2_2.jpg" alt="blog image">
                            </div>
                            <div class="blog-content">
                                <a data-theme-color="#00D084" href="blog.html" class="category">Health</a>
                                <h3 class="box-title-20"><a class="hover-line" href="blog-details.html">Life, a canvas, paint your Masterpiece.</a></h3>
                                <div class="blog-meta">
                                    <a href="blog.html"><i class="fal fa-calendar-days"></i>21 Mar, 2023</a>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-xl-12 col-md-6 border-blog">
                        <div class="blog-style2">
                            <div class="blog-img">
                                <img src="{{ asset('frontend' )}}/img/blog/blog_3_2_3.jpg" alt="blog image">
                            </div>
                            <div class="blog-content">
                                <a data-theme-color="#E7473C" href="blog.html" class="category">Fitness</a>
                                <h3 class="box-title-20"><a class="hover-line" href="blog-details.html">Fuel your fire, embrace Fitness goals.</a></h3>
                                <div class="blog-meta">
                                    <a href="blog.html"><i class="fal fa-calendar-days"></i>27 Mar, 2023</a>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-xl-12 col-md-6 border-blog">
                        <div class="blog-style2">
                            <div class="blog-img">
                                <img src="{{ asset('frontend' )}}/img/blog/blog_3_2_4.jpg" alt="blog image">
                            </div>
                            <div class="blog-content">
                                <a data-theme-color="#59C2D6" href="blog.html" class="category">Fashion</a>
                                <h3 class="box-title-20"><a class="hover-line" href="blog-details.html">Fashion is an art, express Yourself beautifully</a></h3>
                                <div class="blog-meta">
                                    <a href="blog.html"><i class="fal fa-calendar-days"></i>10 Mar, 2023</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="container space-top">
    <a href="https://themeforest.net/user/themeholy/portfolio">
        <img src="{{ asset('frontend' )}}/img/ads/ads_1.jpg" alt="ads" class="w-100">
    </a>
</div><!--==============================
Blog Area  
==============================-->
<section class="space">
    <div class="container">
        <div class="row align-items-center">
            <div class="col">
                <h2 class="sec-title has-line">Today Trending</h2>
            </div>
            <div class="col-auto">
                <div class="sec-btn">
                    <div class="filter-menu filter-menu-active">
                        <button data-filter="*" class="tab-btn active" type="button">ALL</button>
                        <button data-filter=".cat1" class="tab-btn" type="button">Fashion</button>
                        <button data-filter=".cat2" class="tab-btn" type="button">Fitness</button>
                        <button data-filter=".cat3" class="tab-btn" type="button">Travel</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row gy-30 filter-active">
            <div class="col-lg-6 two-column filter-item cat1">
                <div class="blog-style4">
                    <div class="blog-img">
                        <img src="{{ asset('frontend' )}}/img/blog/blog_6_2_1.jpg" alt="blog image">
                    </div>
                    <div class="blog-content">
                        <a data-theme-color="#59C2D6" href="blog.html" class="category">Fashion</a>
                        <h3 class="box-title-22"><a class="hover-line" href="blog-details.html">Fashion that defines your Unique style and personality</a></h3>
                        <div class="blog-meta">
                            <a href="author.html"><i class="far fa-user"></i>By - Tnews</a>
                            <a href="blog.html"><i class="fal fa-calendar-days"></i>12 Mar, 2023</a>
                        </div>
                        <a href="blog-details.html" class="th-btn style2">Read More</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 two-column filter-item cat2">
                <div class="blog-style4">
                    <div class="blog-img">
                        <img src="{{ asset('frontend' )}}/img/blog/blog_6_2_2.jpg" alt="blog image">
                    </div>
                    <div class="blog-content">
                        <a data-theme-color="#8750A6" href="blog.html" class="category">Fitness</a>
                        <h3 class="box-title-22"><a class="hover-line" href="blog-details.html">Cycle your worries away, find Tranquility in motion</a></h3>
                        <div class="blog-meta">
                            <a href="author.html"><i class="far fa-user"></i>By - Tnews</a>
                            <a href="blog.html"><i class="fal fa-calendar-days"></i>16 Mar, 2023</a>
                        </div>
                        <a href="blog-details.html" class="th-btn style2">Read More</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 two-column filter-item cat3">
                <div class="blog-style4">
                    <div class="blog-img">
                        <img src="{{ asset('frontend' )}}/img/blog/blog_6_2_3.jpg" alt="blog image">
                    </div>
                    <div class="blog-content">
                        <a data-theme-color="#007BFF" href="blog.html" class="category">Travel</a>
                        <h3 class="box-title-22"><a class="hover-line" href="blog-details.html">Travel far, travel wide, let the World inspire you</a></h3>
                        <div class="blog-meta">
                            <a href="author.html"><i class="far fa-user"></i>By - Tnews</a>
                            <a href="blog.html"><i class="fal fa-calendar-days"></i>27 Mar, 2023</a>
                        </div>
                        <a href="blog-details.html" class="th-btn style2">Read More</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 two-column filter-item cat2">
                <div class="blog-style4">
                    <div class="blog-img">
                        <img src="{{ asset('frontend' )}}/img/blog/blog_6_2_4.jpg" alt="blog image">
                    </div>
                    <div class="blog-content">
                        <a data-theme-color="#8750A6" href="blog.html" class="category">Fitness</a>
                        <h3 class="box-title-22"><a class="hover-line" href="blog-details.html">Embrace fitness with dancing find tranquility motion</a></h3>
                        <div class="blog-meta">
                            <a href="author.html"><i class="far fa-user"></i>By - Tnews</a>
                            <a href="blog.html"><i class="fal fa-calendar-days"></i>22 Mar, 2023</a>
                        </div>
                        <a href="blog-details.html" class="th-btn style2">Read More</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 two-column filter-item cat3">
                <div class="blog-style4">
                    <div class="blog-img">
                        <img src="{{ asset('frontend' )}}/img/blog/blog_6_2_5.jpg" alt="blog image">
                    </div>
                    <div class="blog-content">
                        <a data-theme-color="#007BFF" href="blog.html" class="category">Travel</a>
                        <h3 class="box-title-22"><a class="hover-line" href="blog-details.html">Fashion is an art, express Yourself beautifully</a></h3>
                        <div class="blog-meta">
                            <a href="author.html"><i class="far fa-user"></i>By - Tnews</a>
                            <a href="blog.html"><i class="fal fa-calendar-days"></i>24 Mar, 2023</a>
                        </div>
                        <a href="blog-details.html" class="th-btn style2">Read More</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 two-column filter-item cat1">
                <div class="blog-style4">
                    <div class="blog-img">
                        <img src="{{ asset('frontend' )}}/img/blog/blog_6_2_6.jpg" alt="blog image">
                    </div>
                    <div class="blog-content">
                        <a data-theme-color="#59C2D6" href="blog.html" class="category">Fashion</a>
                        <h3 class="box-title-22"><a class="hover-line" href="blog-details.html">Watch for fashion intersection of style timekeeping</a></h3>
                        <div class="blog-meta">
                            <a href="author.html"><i class="far fa-user"></i>By - Tnews</a>
                            <a href="blog.html"><i class="fal fa-calendar-days"></i>12 Mar, 2023</a>
                        </div>
                        <a href="blog-details.html" class="th-btn style2">Read More</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<div class="space dark-theme bg-title-dark" data-bg-src="{{ asset('frontend' )}}/img/bg/blog_bg_1.jpg">
    <div class="container">
        <h2 class="sec-title has-line text-center">Editor Choice</h2>
        <div class="row gy-4 mb-4">
            <div class="col-lg-6">
                <div class="blog-style3">
                    <div class="blog-img">
                        <img src="{{ asset('frontend' )}}/img/blog/blog_5_5.jpg" alt="blog image">
                    </div>
                    <div class="blog-content">
                        <a data-theme-color="#4E4BD0" href="blog.html" class="category">Fashion</a>
                        <h3 class="box-title-30"><a class="hover-line" href="blog-details.html">Adventure awaits, let your Wanderlust guide you</a></h3>
                        <div class="blog-meta">
                            <a href="author.html"><i class="far fa-user"></i>By - Tnews</a>
                            <a href="blog.html"><i class="fal fa-calendar-days"></i>24 Mar, 2023</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="blog-style3">
                    <div class="blog-img">
                        <img src="{{ asset('frontend' )}}/img/blog/blog_5_6.jpg" alt="blog image">
                    </div>
                    <div class="blog-content">
                        <a data-theme-color="#019D9E" href="blog.html" class="category">Travel</a>
                        <h3 class="box-title-30"><a class="hover-line" href="blog-details.html">Find your bliss, carve Memories on skis friends.</a></h3>
                        <div class="blog-meta">
                            <a href="author.html"><i class="far fa-user"></i>By - Tnews</a>
                            <a href="blog.html"><i class="fal fa-calendar-days"></i>13 Mar, 2023</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row gy-4">
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="blog-style1">
                    <div class="blog-img">
                        <img src="{{ asset('frontend' )}}/img/blog/blog_1_11.jpg" alt="blog image">
                        <a data-theme-color="#019D9E" href="blog.html" class="category">Travels</a>
                    </div>
                    <h3 class="box-title-22"><a class="hover-line" href="blog-details.html">Leadership for the People By the people</a></h3>
                    <div class="blog-meta">
                        <a href="author.html"><i class="far fa-user"></i>By - Tnews</a>
                        <a href="blog.html"><i class="fal fa-calendar-days"></i>12 Mar, 2023</a>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="blog-style1">
                    <div class="blog-img">
                        <img src="{{ asset('frontend' )}}/img/blog/blog_1_12.jpg" alt="blog image">
                        <a data-theme-color="#8750A6" href="blog.html" class="category">Fitness</a>
                    </div>
                    <h3 class="box-title-22"><a class="hover-line" href="blog-details.html">Leadership for the People By the people</a></h3>
                    <div class="blog-meta">
                        <a href="author.html"><i class="far fa-user"></i>By - Tnews</a>
                        <a href="blog.html"><i class="fal fa-calendar-days"></i>24 Mar, 2023</a>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="blog-style1">
                    <div class="blog-img">
                        <img src="{{ asset('frontend' )}}/img/blog/blog_1_13.jpg" alt="blog image">
                        <a data-theme-color="#019D9E" href="blog.html" class="category">Travels</a>
                    </div>
                    <h3 class="box-title-22"><a class="hover-line" href="blog-details.html">Leadership for the People By the people</a></h3>
                    <div class="blog-meta">
                        <a href="author.html"><i class="far fa-user"></i>By - Tnews</a>
                        <a href="blog.html"><i class="fal fa-calendar-days"></i>23 Mar, 2023</a>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="blog-style1">
                    <div class="blog-img">
                        <img src="{{ asset('frontend' )}}/img/blog/blog_1_14.jpg" alt="blog image">
                        <a data-theme-color="#019D9E" href="blog.html" class="category">Travels</a>
                    </div>
                    <h3 class="box-title-22"><a class="hover-line" href="blog-details.html">Leadership for the People By the people</a></h3>
                    <div class="blog-meta">
                        <a href="author.html"><i class="far fa-user"></i>By - Tnews</a>
                        <a href="blog.html"><i class="fal fa-calendar-days"></i>17 Mar, 2023</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!--==============================
Blog Area  
==============================-->
<section class="space">
    <div class="container">
        <div class="row">
            <div class="col-xl-8">
                <h2 class="sec-title has-line">International News</h2>
                <div class="row gy-4">
                    <div class="col-sm-6 border-blog two-column">
                        <div class="blog-style1">
                            <div class="blog-img">
                                <img src="{{ asset('frontend' )}}/img/blog/blog_4_5.jpg" alt="blog image">
                                <a data-theme-color="#019D9E" href="blog.html" class="category">Travels</a>
                            </div>
                            <h3 class="box-title-24"><a class="hover-line" href="blog-details.html">Relaxation redefined, your beach Resort sanctuary</a></h3>
                            <div class="blog-meta">
                                <a href="author.html"><i class="far fa-user"></i>By - Tnews</a>
                                <a href="blog.html"><i class="fal fa-calendar-days"></i>12 Mar, 2023</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 border-blog two-column">
                        <div class="blog-style1">
                            <div class="blog-img">
                                <img src="{{ asset('frontend' )}}/img/blog/blog_4_6.jpg" alt="blog image">
                                <a data-theme-color="#59C2D6" href="blog.html" class="category">Fashion</a>
                            </div>
                            <h3 class="box-title-24"><a class="hover-line" href="blog-details.html">Fashion fuels dreams, defines Your identity.</a></h3>
                            <div class="blog-meta">
                                <a href="author.html"><i class="far fa-user"></i>By - Tnews</a>
                                <a href="blog.html"><i class="fal fa-calendar-days"></i>26 Mar, 2023</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 border-blog two-column">
                        <div class="blog-style1">
                            <div class="blog-img">
                                <img src="{{ asset('frontend' )}}/img/blog/blog_4_7.jpg" alt="blog image">
                                <a data-theme-color="#00D084" href="blog.html" class="category">Lifestyle</a>
                            </div>
                            <h3 class="box-title-24"><a class="hover-line" href="blog-details.html">Life, a canvas, paint your goal Masterpiece.</a></h3>
                            <div class="blog-meta">
                                <a href="author.html"><i class="far fa-user"></i>By - Tnews</a>
                                <a href="blog.html"><i class="fal fa-calendar-days"></i>29 Mar, 2023</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 border-blog two-column">
                        <div class="blog-style1">
                            <div class="blog-img">
                                <img src="{{ asset('frontend' )}}/img/blog/blog_4_8.jpg" alt="blog image">
                                <a data-theme-color="#59C2D6" href="blog.html" class="category">Fashion</a>
                            </div>
                            <h3 class="box-title-24"><a class="hover-line" href="blog-details.html">Fashion speaks volumes, wear Your confidence.</a></h3>
                            <div class="blog-meta">
                                <a href="author.html"><i class="far fa-user"></i>By - Tnews</a>
                                <a href="blog.html"><i class="fal fa-calendar-days"></i>11 Mar, 2023</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 border-blog two-column">
                        <div class="blog-style1">
                            <div class="blog-img">
                                <img src="{{ asset('frontend' )}}/img/blog/blog_4_9.jpg" alt="blog image">
                                <a data-theme-color="#4E4BD0" href="blog.html" class="category">Sports</a>
                            </div>
                            <h3 class="box-title-24"><a class="hover-line" href="blog-details.html">Embrace the challenge, conquer Sports goals.</a></h3>
                            <div class="blog-meta">
                                <a href="author.html"><i class="far fa-user"></i>By - Tnews</a>
                                <a href="blog.html"><i class="fal fa-calendar-days"></i>23 Mar, 2023</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 border-blog two-column">
                        <div class="blog-style1">
                            <div class="blog-img">
                                <img src="{{ asset('frontend' )}}/img/blog/blog_4_10.jpg" alt="blog image">
                                <a data-theme-color="#E8137D" href="blog.html" class="category">Music</a>
                            </div>
                            <h3 class="box-title-24"><a class="hover-line" href="blog-details.html">Soulful symphony, music speaks Volume of music.</a></h3>
                            <div class="blog-meta">
                                <a href="author.html"><i class="far fa-user"></i>By - Tnews</a>
                                <a href="blog.html"><i class="fal fa-calendar-days"></i>15 Mar, 2023</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 mt-35 mt-xl-0 sidebar-wrap mb-10">
                <h2 class="sec-title has-line">Popular News</h2>
                <div class="sidebar-area">
                    <div class="mb-30">
                        <div class="dark-theme img-overlay2">
                            <div class="blog-style3">
                                <div class="blog-img">
                                    <img src="{{ asset('frontend' )}}/img/blog/blog_5_2_5.jpg" alt="blog image">
                                </div>
                                <div class="blog-content">
                                    <a data-theme-color="#4E4BD0" href="blog.html" class="category">Fashion</a>
                                    <h3 class="box-title-24"><a class="hover-line" href="blog-details.html">Control conquer your day with smart watch</a></h3>
                                    <div class="blog-meta">
                                        <a href="author.html"><i class="far fa-user"></i>By - Tnews</a>
                                        <a href="blog.html"><i class="fal fa-calendar-days"></i>28 Mar, 2023</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row gy-4">
                        <div class="col-xl-12 col-md-6 border-blog">
                            <div class="blog-style2">
                                <div class="blog-img">
                                    <img src="{{ asset('frontend' )}}/img/blog/blog_3_2_5.jpg" alt="blog image">
                                </div>
                                <div class="blog-content">
                                    <a data-theme-color="#E8137D" href="blog.html" class="category">Sports</a>
                                    <h3 class="box-title-20"><a class="hover-line" href="blog-details.html">Tune in, turn up, and let the Music speak</a></h3>
                                    <div class="blog-meta">
                                        <a href="blog.html"><i class="fal fa-calendar-days"></i>13 Mar, 2023</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-xl-12 col-md-6 border-blog">
                            <div class="blog-style2">
                                <div class="blog-img">
                                    <img src="{{ asset('frontend' )}}/img/blog/blog_3_2_6.jpg" alt="blog image">
                                </div>
                                <div class="blog-content">
                                    <a data-theme-color="#59C2D6" href="blog.html" class="category">Fashion</a>
                                    <h3 class="box-title-20"><a class="hover-line" href="blog-details.html">Score big with the Latest sports news.</a></h3>
                                    <div class="blog-meta">
                                        <a href="blog.html"><i class="fal fa-calendar-days"></i>25 Mar, 2023</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-xl-12 col-md-6 border-blog">
                            <div class="blog-style2">
                                <div class="blog-img">
                                    <img src="{{ asset('frontend' )}}/img/blog/blog_3_2_7.jpg" alt="blog image">
                                </div>
                                <div class="blog-content">
                                    <a data-theme-color="#E8137D" href="blog.html" class="category">Sports</a>
                                    <h3 class="box-title-20"><a class="hover-line" href="blog-details.html">Ride to thrive the latest cycling news</a></h3>
                                    <div class="blog-meta">
                                        <a href="blog.html"><i class="fal fa-calendar-days"></i>16 Mar, 2023</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-xl-12 col-md-6 border-blog">
                            <div class="blog-style2">
                                <div class="blog-img">
                                    <img src="{{ asset('frontend' )}}/img/blog/blog_3_2_8.jpg" alt="blog image">
                                </div>
                                <div class="blog-content">
                                    <a data-theme-color="#019D9E" href="blog.html" class="category">Travel</a>
                                    <h3 class="box-title-20"><a class="hover-line" href="blog-details.html">Discovering destinations latest travel spot</a></h3>
                                    <div class="blog-meta">
                                        <a href="blog.html"><i class="fal fa-calendar-days"></i>14 Mar, 2023</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="space-bottom">
    <div class="container">
        <div class="row align-items-center">
            <div class="col">
                <h2 class="sec-title has-line">Favorite this Week</h2>
            </div>
            <div class="col-auto">
                <div class="sec-btn">
                    <div class="icon-box">
                        <button data-slick-prev="#blog-slide4" class="slick-arrow default"><i class="far fa-arrow-left"></i></button>
                        <button data-slick-next="#blog-slide4" class="slick-arrow default"><i class="far fa-arrow-right"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row th-carousel" id="blog-slide4" data-slide-show="4" data-lg-slide-show="3" data-md-slide-show="2" data-sm-slide-show="2">
            <div class="col-sm-6 col-lg-4 col-xl-3">
                <div class="blog-style1">
                    <div class="blog-img">
                        <img src="{{ asset('frontend' )}}/img/blog/blog_1_16.jpg" alt="blog image">
                        <a data-theme-color="#00D084" href="blog.html" class="category">Lifestyle</a>
                    </div>
                    <h3 class="box-title-22"><a class="hover-line" href="blog-details.html">Design a lifestyle that the radiates Happiness.</a></h3>
                    <div class="blog-meta">
                        <a href="author.html"><i class="far fa-user"></i>By - Tnews</a>
                        <a href="blog.html"><i class="fal fa-calendar-days"></i>13 Mar, 2023</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4 col-xl-3">
                <div class="blog-style1">
                    <div class="blog-img">
                        <img src="{{ asset('frontend' )}}/img/blog/blog_1_17.jpg" alt="blog image">
                        <a data-theme-color="#019D9E" href="blog.html" class="category">Travel</a>
                    </div>
                    <h3 class="box-title-22"><a class="hover-line" href="blog-details.html">Find your bliss, carve memories on skis.</a></h3>
                    <div class="blog-meta">
                        <a href="author.html"><i class="far fa-user"></i>By - Tnews</a>
                        <a href="blog.html"><i class="fal fa-calendar-days"></i>12 Mar, 2023</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4 col-xl-3">
                <div class="blog-style1">
                    <div class="blog-img">
                        <img src="{{ asset('frontend' )}}/img/blog/blog_1_18.jpg" alt="blog image">
                        <a data-theme-color="#59C2D6" href="blog.html" class="category">Fashion</a>
                    </div>
                    <h3 class="box-title-22"><a class="hover-line" href="blog-details.html">Express yourself, let fashion be your canvas.</a></h3>
                    <div class="blog-meta">
                        <a href="author.html"><i class="far fa-user"></i>By - Tnews</a>
                        <a href="blog.html"><i class="fal fa-calendar-days"></i>16 Mar, 2023</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4 col-xl-3">
                <div class="blog-style1">
                    <div class="blog-img">
                        <img src="{{ asset('frontend' )}}/img/blog/blog_1_19.jpg" alt="blog image">
                        <a data-theme-color="#8750A6" href="blog.html" class="category">Animal</a>
                    </div>
                    <h3 class="box-title-22"><a class="hover-line" href="blog-details.html">From jungles to oceans animals amaze.</a></h3>
                    <div class="blog-meta">
                        <a href="author.html"><i class="far fa-user"></i>By - Tnews</a>
                        <a href="blog.html"><i class="fal fa-calendar-days"></i>25 Mar, 2023</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4 col-xl-3">
                <div class="blog-style1">
                    <div class="blog-img">
                        <img src="{{ asset('frontend' )}}/img/blog/blog_1_20.jpg" alt="blog image">
                        <a data-theme-color="#FF9500" href="blog.html" class="category">Politics</a>
                    </div>
                    <h3 class="box-title-22"><a class="hover-line" href="blog-details.html">From advocacy to policy fuels societal change.</a></h3>
                    <div class="blog-meta">
                        <a href="author.html"><i class="far fa-user"></i>By - Tnews</a>
                        <a href="blog.html"><i class="fal fa-calendar-days"></i>14 Mar, 2023</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!--==============================
Newsletter Area  
==============================-->
<div class="bg-smoke py-lg-4">
    <div class="container">
        <div class="row flex-row-reverse justify-content-center justify-content-lg-between align-items-center">
            <div class="col-lg-5 mb-n3 mb-lg-0">
                <div class="text-center text-lg-end pt-4 pt-lg-0">
                    <img src="{{ asset('frontend' )}}/img/bg/newsletter_img.png" alt="icon">
                </div>
            </div>
            <div class="col-lg-7 py-4 text-center text-lg-start">
                <h2 class="box-title-30 mb-30">Join Our Newsletter to receive <br> Daily Update News</h2>
                <form class="newsletter-form width2">
                    <input class="form-control" type="email" placeholder="Enter Email" required="">
                    <button type="submit" class="th-btn">Subscribe</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection