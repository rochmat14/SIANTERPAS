@extends('layouts.frontend.smi')
@section('bodyClass', 'front preload')
@section('navActive', 'home')
@section('content')
@section('css_scripts')

<style>


#tagcloud-ctg {
    display: flex;
    flex-wrap: wrap;
    gap: 1px;
    text-align: left;
    overflow: hidden;
}

#tagcloud-ctg a {
    display: inline-block;
    padding: 7px 5px;
    margin: 5px;
    font-size: 10px;
    color: #000;
    white-space: nowrap;
    text-align: center;
    line-height: 1.5;
}

#tagcloud-ctg a:nth-child(n+11) {
    display: none; /* Sembunyikan tag setelah 8 */
}

</style>
@endsection
@section('js_scripts')

<script>
   

    $(document).ready(function() {
        var totalTags = $('#tagcloud-ctg a').length;

        // Tampilkan tombol Expand More jika ada lebih dari 8 tag
        if (totalTags > 8) {
            $('#expandMore').show();
        }

        var isExpanded = false; // Untuk melacak apakah sudah di-expand atau tidak

        // Ketika tombol 'Expand More' atau 'Collapse' diklik
        $('#expandMore').click(function() {
            if (!isExpanded) {
                // Expand: Tampilkan semua tag
                $('#tagcloud-ctg a').show();
                $(this).text('Collapse'); // Ubah teks tombol menjadi 'Collapse'
                isExpanded = true; // Set status menjadi expanded
            } else {
                // Collapse: Sembunyikan kembali tag ke lebih dari 8
                $('#tagcloud-ctg a:nth-child(n+9)').hide();
                $(this).text('More..'); // Ubah teks tombol menjadi 'Expand More'
                isExpanded = false; // Set status menjadi collapsed
            }
        });
    });
</script>
@endsection

<div class="breadcumb-wrapper">
    <div class="container">
        <ul class="breadcumb-menu">
            <li><a href="{{ route('home') }}">Home</a></li>
            <li>{!! $title_page !!}</li>
        </ul>
    </div>
</div>
<section class="space-top space-extra-bottom">
    <div class="container">
        <div class="row">

            

           
            

            <div class="col-xxl-9 col-lg-8">
                <div class="mb-30">

                    @if (count($blogs))
                        @foreach ($blogs as $index => $blog)
                            @php
                                $blogsDescription = $blog
                                    ->description()
                                    ->where('language_id', LaravelLocalization::getCurrentLocale())
                                    ->first();
                                $blogUrl = LaravelLocalization::getLocalizedURL(
                                    LaravelLocalization::getCurrentLocale(),
                                    URL::to('blogs/' . $blog->slug),
                                );

                                $author_name = getUserName($blog->created_by)->nama_depan;
                                $authorUrl = LaravelLocalization::getLocalizedURL(
                                    LaravelLocalization::getCurrentLocale(),
                                    URL::to('author/' . $blog->created_by.'/'.$author_name),
                                );

                                $tags_data = $blog->tags;
                                $data_tags = unserialize($tags_data);

                                $url_category = LaravelLocalization::getLocalizedURL(
                                    LaravelLocalization::getCurrentLocale(),
                                    URL::to('blogs?category=' . getKategoriId($blog->id_category)->slug),
                                );
                            @endphp
                            <div class="border-blog2">
                                <div class="blog-style4">
                                    <div class="blog-img w-386">
                                        <img src="{{ URL::asset('/images/news') }}/{{ $blog->id }}/{{ $blog->image }}"
                                            alt="{!! $blogsDescription->title !!}">
                                    </div>
                                    <div class="blog-content">
                                       
                                            
                                        <a data-theme-color="#F8D104" href="{{ $url_category }}" class="category">{{ getKategoriId($blog->id_category)->name }}</a>
                                        

                                        <h3 class="box-title-30">
                                            <a class="hover-line" href="{{ $blogUrl }}">
                                                {!! $blogsDescription->title !!}
                                            </a>
                                        </h3>
                                        <p class="blog-text">
                                            {!! substr(strip_tags($blogsDescription->description), 0, 100) !!}
                                        </p>
                                        <div class="blog-meta">
                                            <a href="{{ $authorUrl }}"><i class="far fa-user"></i>
                                                By - {{ $author_name }}
                                            </a>
                                            <a href="{{ $blogUrl }}">
                                                <i class="fal fa-calendar-days"></i>
                                                {{ arrMonth(LaravelLocalization::getCurrentLocale())[date('n', strtotime($blog->published_on))] }}
                                                - {{ date('d', strtotime($blog->published_on)) }} -
                                                {{ date('Y', strtotime($blog->published_on)) }}
                                            </a>
                                            <br>
                                            @foreach ($data_tags as $tag)
                                                @php
                                                    $tags_url = LaravelLocalization::getLocalizedURL(
                                                        LaravelLocalization::getCurrentLocale(),
                                                        URL::to('blogs?tags=' . $tag),
                                                    );
                                                @endphp
                                                <a href="{{ $tags_url }}"
                                                    class="categorys">#{{ $tag }}</a>
                                            @endforeach
                                        </div>
                                        <a href="{{ $blogUrl }}" class="th-btn style2 bg-primary btn-sm">Read More<i
                                                class="fas fa-arrow-up-right ms-2"></i></a>
                                    </div>

                                </div>
                            </div>
                        @endforeach
                    @endif

                </div>

                {{ $blogs->appends(['q' => $q])->render('custom_pagination') }}
                {{-- <div class="th-pagination mt-40">
                    <ul>
                        <li><a href="blog.html">01</a></li>
                        <li><a href="blog.html">02</a></li>
                        <li><a href="blog.html">03</a></li>
                        <li><a href="blog.html"><i class="fas fa-arrow-right"></i></a></li>
                    </ul>
                </div> --}}

                <div class="col-xxl-12 col-lg-12">
                    <div class="widget widget_tag_cloud">
                        <div class="tagcloud" id="tagcloud-ctg">
                            <a href="{{ url('blogs') }}"
                                class="tag bg-gray2 bg-colored-hover white-hover" style="font-size: 10px; padding:7px 5px; color:#000">All</a>
                            @foreach ($sub_category as $key => $value)
                                @php
                                    $url = LaravelLocalization::getLocalizedURL(
                                        LaravelLocalization::getCurrentLocale(),
                                        URL::to('blogs?subcategory=' . $value->slug),
                                    );
                                @endphp
                                <a href="{{ $url }}"
                                    class="tag bg-gray2 bg-colored-hover white-hover" 
                                    style="font-size: 10px; padding:7px 5px; color:#000">{{ $value->name_en }}</a>
                            @endforeach
                        </div>
                        <a id="expandMore" class="btn btn-outline-primary btn-sm mt-3" style="display: none;">More...</a>
                        <h3 class="widget_title text-center">&nbsp;</h3>
                    </div>
                </div>
            </div>


            @include('frontend.include.blog_sidebar')

            
        </div>
    </div>
</section>


@endsection
