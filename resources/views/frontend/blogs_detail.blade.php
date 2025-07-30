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
            <li><a href="{{ route('blogs') }}">Article</a></li>
            <li>{!! $title_page !!}</li>
        </ul>
    </div>
</div>

<section class="th-blog-wrapper blog-details space-top space-extra-bottom">
    <div class="container">
        <div class="row">
            <div class="col-xxl-9 col-lg-8">
                <div class="th-blog blog-single">
                    <a data-theme-color="#F8D104" href="#" class="category">ISO</a>
                    <h2 class="blog-title">
                        {{ $blogDescription->title }}
                    </h2>
                    <div class="blog-meta">
                        <a class="author" href="#"><i class="far fa-user"></i>By - Admin</a>
                        <a href="#">
                            <i class="fal fa-calendar-days"></i>
                            {{ arrMonth(LaravelLocalization::getCurrentLocale())[date('n', strtotime($blog->published_on))] }}
                            -
                            {{ date('d', strtotime($blog->published_on)) }} -
                            {{ date('Y', strtotime($blog->published_on)) }}
                        </a>
                        <span><i class="far fa-book-open"></i>5 Mins Read</span>
                    </div>
                    <div class="blog-img">
                        <img src="{{ URL::asset('/images/news') }}/{{ $blog->id }}/{{ $blog->image }}"
                            alt="{{ $blogDescription->title }}" style="width: 100%;">
                    </div>
                    <div class="blog-content-wrap">
                        <div class="share-links-wrap">
                            <div class="share-links">
                                <span class="share-links-title">Share Post:</span>
                                <div class="multi-social">
                                    <a href="https://facebook.com/" target="_blank"><i
                                            class="fab fa-facebook-f"></i></a>
                                    <a href="https://twitter.com/" target="_blank"><i class="fab fa-twitter"></i></a>
                                    <a href="https://linkedin.com/" target="_blank"><i
                                            class="fab fa-linkedin-in"></i></a>
                                    <a href="https://pinterest.com/" target="_blank"><i
                                            class="fab fa-pinterest-p"></i></a>
                                    <a href="https://instagram.com/" target="_blank"><i
                                            class="fab fa-instagram"></i></a>
                                </div><!-- End Social Share -->
                            </div>
                        </div>
                        <div class="blog-content">
                            <div class="blog-info-wrap">
                                <button class="blog-info print_btn">
                                    Print :
                                    <i class="fas fa-print"></i>
                                </button>

                                <button class="blog-info ms-sm-auto">15k <i class="fas fa-thumbs-up"></i></button>
                                <span class="blog-info">126k <i class="fas fa-eye"></i></span>
                                <span class="blog-info">12k <i class="fas fa-share-nodes"></i></span>
                            </div>
                            <div class="content">
                                {!! $blogDescription->description !!}
                            </div>
                            <div class="blog-tag">
                                <h6 class="title">Related Tag :</h6>
                                <div class="tagcloud">

                                    @php
                                        $tags_data = $blog->tags;
                                        $data_tags = unserialize($tags_data);
                                    @endphp
                                    @if ($data_tags !== false)
                                        <div class="tags mt-50 fs-13 gray9 normal ls-0">
                                            <!-- Tag links -->

                                            @foreach ($data_tags as $tag)
                                                @php
                                                    $tags_url = LaravelLocalization::getLocalizedURL(
                                                        LaravelLocalization::getCurrentLocale(),
                                                        URL::to('blogs?tags=' . $tag),
                                                    );
                                                @endphp
                                                <a href="{{ $tags_url }}">{{ $tag }}</a>
                                            @endforeach
                                        </div>
                                    @endif



                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="blog-navigation">
                    <div class="nav-btn prev">
                        <div class="img">
                            <img src="{{ asset('frontend') }}/img/blog/blog-nav-1.jpg" alt="blog img" class="nav-img">
                        </div>
                        <div class="media-body">
                            <h5 class="title">
                                <a class="hover-line" href="#">Game on! Embrace the spirit of sportsmanship</a>
                            </h5>
                            <a href="#" class="nav-text"><i class="fas fa-arrow-left me-2"></i>Prev</a>
                        </div>
                    </div>
                    <div class="divider"></div>
                    <div class="nav-btn next">
                        <div class="media-body">
                            <h5 class="title">
                                <a class="hover-line" href="#">Push your limits, redefine what's possible</a>
                            </h5>
                            <a href="#" class="nav-text">Next<i class="fas fa-arrow-right ms-2"></i></a>
                        </div>
                        <div class="img">
                            <img src="{{ asset('frontend') }}/img/blog/blog-nav-2.jpg" alt="blog img" class="nav-img">
                        </div>
                    </div>
                </div>
                <div class="blog-author">
                    <div class="auhtor-img">
                        <img src="{{ asset('frontend') }}/img/blog/blog-author.jpg" alt="Blog Author Image">
                    </div>
                    <div class="media-body">
                        <div class="author-top">
                            <div>
                                <h3 class="author-name"><a class="text-inherit" href="#">Ronald Richards</a></h3>
                                <span class="author-desig">Founder & CEO</span>
                            </div>
                            <div class="social-links">
                                <a href="https://facebook.com/" target="_blank"><i class="fab fa-facebook-f"></i></a>
                                <a href="https://twitter.com/" target="_blank"><i class="fab fa-twitter"></i></a>
                                <a href="https://linkedin.com/" target="_blank"><i
                                        class="fab fa-linkedin-in"></i></a>
                                <a href="https://instagram.com/" target="_blank"><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                        <p class="author-text">Adventurer and passionate travel blogger. With a backpack full of
                            stories and a camera in hand, she takes her readers on exhilarating journeys around the
                            world.</p>
                    </div>
                </div>
                <div class="th-comments-wrap ">
                    <h2 class="blog-inner-title h3">Comments </h2>

                </div> <!-- Comment end --> <!-- Comment Form -->

                <div class="related-post-wrapper pt-30 mb-30">
                    <div class="row align-items-center">
                        <div class="col">
                            <h2 class="sec-title has-line">Related Post</h2>
                        </div>
                        <div class="col-auto">
                            <div class="sec-btn">
                                <div class="icon-box">
                                    <button data-slick-prev="#related-post-slide" class="slick-arrow default"><i
                                            class="far fa-arrow-left"></i></button>
                                    <button data-slick-next="#related-post-slide" class="slick-arrow default"><i
                                            class="far fa-arrow-right"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row slider-shadow th-carousel" id="related-post-slide" data-slide-show="3"
                        data-lg-slide-show="2" data-md-slide-show="2" data-sm-slide-show="2">
                        <div class="col-sm-6 col-xl-4">
                            <div class="blog-style1">
                                <div class="blog-img">
                                    <img src="{{ asset('frontend') }}/img/blog/blog_1_1.jpg" alt="blog image">
                                    <a data-theme-color="#00D084" href="#" class="category">Lifestyle</a>
                                </div>
                                <h3 class="box-title-22"><a class="hover-line" href="#">Balance harmony and joy
                                        in Every lifestyle.</a></h3>
                                <div class="blog-meta">
                                    <a href="#"><i class="far fa-user"></i>By - Tnews</a>
                                    <a href="#"><i class="fal fa-calendar-days"></i>15 Mar, 2023</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xl-4">
                            <div class="blog-style1">
                                <div class="blog-img">
                                    <img src="{{ asset('frontend') }}/img/blog/blog_1_2.jpg" alt="blog image">
                                    <a data-theme-color="#FF9500" href="#" class="category">Politics</a>
                                </div>
                                <h3 class="box-title-22"><a class="hover-line" href="#">Power to the people for
                                        a Better future!</a></h3>
                                <div class="blog-meta">
                                    <a href="#"><i class="far fa-user"></i>By - Tnews</a>
                                    <a href="#"><i class="fal fa-calendar-days"></i>16 Mar, 2023</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xl-4">
                            <div class="blog-style1">
                                <div class="blog-img">
                                    <img src="{{ asset('frontend') }}/img/blog/blog_1_3.jpg" alt="blog image">
                                    <a data-theme-color="#E7473C" href="#" class="category">Fitness</a>
                                </div>
                                <h3 class="box-title-22"><a class="hover-line" href="#">Fitness the key to
                                        vitality and Well-being.</a></h3>
                                <div class="blog-meta">
                                    <a href="#"><i class="far fa-user"></i>By - Tnews</a>
                                    <a href="#"><i class="fal fa-calendar-days"></i>21 Mar, 2023</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xl-4">
                            <div class="blog-style1">
                                <div class="blog-img">
                                    <img src="{{ asset('frontend') }}/img/blog/blog_1_4.jpg" alt="blog image">
                                    <a data-theme-color="#00D084" href="#" class="category">Health</a>
                                </div>
                                <h3 class="box-title-22"><a class="hover-line" href="#">Embrace bump and
                                        Victory volleyball style.</a></h3>
                                <div class="blog-meta">
                                    <a href="#"><i class="far fa-user"></i>By - Tnews</a>
                                    <a href="#"><i class="fal fa-calendar-days"></i>14 Mar, 2023</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @include('frontend.include.blog_sidebar')
        </div>
    </div>
</section>
@endsection
