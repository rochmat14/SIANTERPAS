@extends('layouts.frontend.smi')
@section('bodyClass', 'front preload')
@section('navActive', 'contact')
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


<section class="th-blog-wrapper blog-details space-top space-extra-bottom">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 text-center">
                {{-- <a data-theme-color="#6234AC" href="blog.html" class="category">Technology</a> --}}
                <h2 class="blog-title">
                    {{ $title_page }}
                </h2>
                {{-- <div class="blog-meta">
                    <a class="author" href="author.html"><i class="far fa-user"></i>By - Tnews</a>
                    <a href="blog.html"><i class="fal fa-calendar-days"></i>21 June, 2023</a>
                    <a href="blog-details.html"><i class="far fa-comments"></i>Comments (3)</a>
                    <span><i class="far fa-book-open"></i>5 Mins Read</span>
                </div> --}}
                {{-- <div class="blog-img mb-40">
                    <img src="{{ $url_future_image }}" alt="{{$pageDescription->name}}">
                </div> --}}
            </div>
            <div class="col-xxl-9 col-lg-10">
                <div class="th-blog blog-single">
                    <div class="blog-content-wrap">
                        <div class="share-links-wrap">
                            <div class="share-links">
                                <span class="share-links-title">Share:</span>
                                <div class="multi-social">
                                    <a href="https://facebook.com/" target="_blank"><i class="fab fa-facebook-f"></i></a>
                                    <a href="https://twitter.com/" target="_blank"><i class="fab fa-twitter"></i></a>
                                    <a href="https://linkedin.com/" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                                    <a href="https://pinterest.com/" target="_blank"><i class="fab fa-pinterest-p"></i></a>
                                    <a href="https://instagram.com/" target="_blank"><i class="fab fa-instagram"></i></a>
                                </div><!-- End Social Share -->
                            </div>
                        </div>
                        <div class="blog-content">
                            <div class="blog-info-wrap">
                                <button class="blog-info print_btn">
                                    Print :
                                    <i class="fas fa-print"></i>
                                </button>
                                <a class="blog-info" href="mailto:">
                                    Email :
                                    <i class="fas fa-envelope"></i>
                                </a>
                                <button class="blog-info ms-sm-auto">15k <i class="fas fa-thumbs-up"></i></button>
                                <span class="blog-info">126k <i class="fas fa-eye"></i></span>
                                <span class="blog-info">12k <i class="fas fa-share-nodes"></i></span>
                            </div>
                            <div class="content">
                                {!! $pageDescription->description !!}
                            </div>
                            {{-- <div class="blog-tag">
                                <h6 class="title">Related Tag :</h6>
                                <div class="tagcloud">
                                    <a href="blog.html">Sports</a>
                                    <a href="blog.html">Politics</a>
                                    <a href="blog.html">Business</a>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
                
                
            </div>
        </div>
    </div>
</section>




@endsection