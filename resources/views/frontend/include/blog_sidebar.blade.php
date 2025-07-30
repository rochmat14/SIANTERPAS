<div class="col-xxl-3 col-lg-4 sidebar-wrap">
    <aside class="sidebar-area">
        <div class="widget widget_search  ">
            <form class="search-form"
                action="{{ LaravelLocalization::getLocalizedURL(LaravelLocalization::getCurrentLocale(), URL::to('blogs')) }}">
                <input type="text" placeholder="Enter Keyword" name="search" value="{{ $q }}">
                <button type="submit"><i class="far fa-search"></i></button>
            </form>
        </div>
        <div class="widget widget_categories  ">
            <h3 class="widget_title">Categories</h3>
            <ul>
                @foreach (getKategori() as $key => $value)
                    @php
                        $url_category = LaravelLocalization::getLocalizedURL(
                            LaravelLocalization::getCurrentLocale(),
                            URL::to('blogs?category=' . $value->slug),
                        );
                    @endphp
                    <li>
                        <a data-bg-src="{{ asset('frontend') }}/img/bg/category_bg_1_1.jpg"
                            href="{{ $url_category }}">{{ $value->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="widget  ">
            <h3 class="widget_title">Recent Posts</h3>
            <div class="recent-post-wrap">

                @foreach ($post_limit_sidebar as $key => $value)
                    @php
                        $blogsDescription = $value
                            ->description()
                            ->where('language_id', LaravelLocalization::getCurrentLocale())
                            ->first();
                        $blogUrl = LaravelLocalization::getLocalizedURL(
                            LaravelLocalization::getCurrentLocale(),
                            URL::to('blogs/' . $value->slug),
                        );
                    @endphp
                    <div class="recent-post">
                        <div class="media-img">
                            <a href="{{ $blogUrl }}">
                                <img src="{{ URL::asset('/images/news') }}/{{ $value->id }}/{{ $value->image }}"
                                    alt="{!! $blogsDescription->title !!}">
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="post-title">
                                <a class="hover-line" href="{{ $blogUrl }}">
                                    {!! $blogsDescription->title !!}
                                </a>
                            </h4>
                            <div class="recent-post-meta">
                                <a href="{{ $blogUrl }}"><i class="fal fa-calendar-days"></i>
                                    {{ arrMonth(LaravelLocalization::getCurrentLocale())[date('n', strtotime($value->published_on))] }}
                                    -
                                    {{ date('d', strtotime($value->published_on)) }} -
                                    {{ date('Y', strtotime($value->published_on)) }}
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="widget widget_tag_cloud  ">
            <h3 class="widget_title">Popular Tags</h3>
            <div class="tagcloud">
                @foreach ($tags as $key => $value)
                    @php
                        $url_tags = LaravelLocalization::getLocalizedURL(
                            LaravelLocalization::getCurrentLocale(),
                            URL::to('blogs?tags=' . $value->name),
                        );
                    @endphp
                    <a href="{{ $url_tags }}"
                        class="tag bg-gray2 bg-colored-hover white-hover">#{{ $value->name }}</a>
                @endforeach
            </div>
        </div>
    </aside>
</div>
