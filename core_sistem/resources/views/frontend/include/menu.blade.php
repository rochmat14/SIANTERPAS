<ul>
    <li><a href="{{ route('home') }}">Home</a></li>
    <!-- Contoh HTML untuk Mega Menu -->
    <li class="nav-item dropdown-mega position-static menu-item-has-children th-item-has-children-custom">
        <a class="nav-link" href="#" data-bs-toggle="dropdown" data-bs-auto-close="outside">About Us</a>
        <div class="dropdown-menu shadow sub-menu">
            <div class="mega-content px-4">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-4 col-lg-4 py-2">
                            <a href="{{ url('pages/about-us') }}">
                                <img class="img-fluid py-2" src="{{ url('images/logo') }}/{{ AppLogo() }}" alt="{{ AppSeting('app_name') }}" style="width: 200px;">
                            </a>
                            <p class="card-text">
                               <a href="{{ url('pages/about-us') }}"> {!! AppSeting('app_desc') !!}</a>
                            </p>
                        </div>
                        <div class="col-12 col-sm-12 col-md-4 col-lg-4 py-2">
                            <h5>Legal Aspek</h5>
                            <div class="list-group">

                                @foreach(menu_aspek_hukum() AS $key => $value)
                                    @php
                                        $pageMenu = $value->description()->where('language_id',LaravelLocalization::getCurrentLocale())->first();
                                        $pageUrl = LaravelLocalization::getLocalizedURL(LaravelLocalization::getCurrentLocale(),URL::to('pages/'.$value->slug ));
                                    @endphp
                                        <a class="list-group-item @if($link_page === $value->slug ) text-primary @endif" href="{{ $pageUrl }}">
                                            {{ $pageMenu->name }}
                                        </a>
                                    @endforeach
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-4 col-lg-4 py-2">
                            <h5> Tentang Kami</h5>
                            <div class="list-group">
                                <a class="list-group-item" href="{{ route('contact_us') }}"><span class="icon"> </span> Kontak Kami </a>
                                <a class="list-group-item" href="{{ route('karir') }}"><span class="icon"> </span> Karir</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </li>

    <li class="nav-item dropdown-mega position-static menu-item-has-children th-item-has-children-custom">
        <a class="nav-link" href="#" data-bs-toggle="dropdown" data-bs-auto-close="outside">Learn</a>
        <div class="dropdown-menu shadow sub-menu">
            <div class="mega-content px-4">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-4 col-lg-4 py-2">
                            <h5>Resources</h5>

                            <div class="list-group">

                                @foreach(getKategori() as $key => $value)
                                  @php
                                      $url_category = LaravelLocalization::getLocalizedURL(LaravelLocalization::getCurrentLocale(),URL::to('blogs?category='.$value->slug ));
                                  @endphp
                                    <a class="list-group-item" href="{{$url_category}}">
                                        {{ $value->name }}
                                    </a>
                                @endforeach

                                
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-4 col-lg-4 py-2">
                            <h5>Rekomendasi</h5>
                            <div class="list-group">
                                <a class="list-group-item" href="{{ route('perusahaan-sertifikasi') }}">Perusahaan Sertifikasi</a>
                                <a class="list-group-item" href="{{ route('perusahaan-konsultasi') }}">Perusahaan Konsultasi</a>
                                <a class="list-group-item" href="{{ route('auditor') }}">Auditor</a>
                                <a class="list-group-item" href="{{ route('training') }}">Training</a>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-4 col-lg-4 py-2">
                            <h5>Dokumen</h5>
                            <div class="list-group">
                                <a class="list-group-item" href="{{ route('peraturan-pemerintah') }}">Peraturan Pemerintah</a>
                                <a class="list-group-item" href="{{ route('template-document') }}">Template Dokumen</a>
                                <a class="list-group-item" href="{{ route('ebook') }}">E-Book</a>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </li>
    <li><a href="{{ route('calendars') }}">Calendars</a></li>
    <li><a href="{{ route('consult') }}" data-theme-color="#6234AC">Consult now</a></li>






  


    
</ul>