<div class="th-menu-wrapper">
    <div class="th-menu-area text-center">
        <button class="th-menu-toggle"><i class="fal fa-times"></i></button>
        <div class="mobile-logo">
            <a href="{{ route('home') }}">
                <img src="{{ url('images/logo') }}/{{ AppLogo() }}" alt="{{ AppSeting('app_name') }}" style="width: 200px;">
            </a>
        </div>
        <div class="th-mobile-menu">
            @include('frontend.include.menu')
        </div>
    </div>
</div>