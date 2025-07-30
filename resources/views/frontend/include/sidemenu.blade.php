<div class="sidemenu-wrapper sidemenu-1 d-none d-md-block ">
    <div class="sidemenu-content">
        <button class="closeButton sideMenuCls"><i class="far fa-times"></i></button>
        <div class="widget  ">
            <div class="th-widget-about">
                <div class="about-logo">
                    <a href="{{ route('home') }}">
                        <img class="light-img" src="{{ url('images/logo') }}/{{ AppLogo() }}" alt="{{ AppSeting('app_name') }}">
                    </a>
                    <a href="{{ route('home') }}">
                        <img class="dark-img" src="{{ url('images/logo') }}/{{ AppLogo() }}" alt="{{ AppSeting('app_name') }}">
                    </a>
                </div>
                <p class="about-text">
                    {!! AppSeting('app_desc') !!}
                </p>
                <div class="th-social style-black">
                    <a target="_blank" href="{{ AppSeting('facebook_link') }}"><i class="fab fa-facebook-f"></i></a>
                    <a target="_blank" href="{{ AppSeting('instagram_link') }}"><i class="fab fa-instagram"></i></a>
                    <a target="_blank" href="{{ AppSeting('linkedin_link') }}"><i class="fab fa-linkedin-in"></i></a>
                    <a target="_blank" href="{{ AppSeting('whatsapp_link') }}"><i class="fab fa-whatsapp"></i></a>
                </div>
            </div>
        </div>
        
        <div class="widget newsletter-widget  ">
            <h3 class="widget_title">Subscribe</h3>
            <p class="footer-text">
                Daftar untuk mendapatkan informasi terbaru tentang kami. Jangan ragu, email Anda aman.
            </p>
            <form class="newsletter-form">
                <input class="form-control" type="email" placeholder="Enter Email" required="">
                <button type="submit" class="icon-btn"><i class="fa-solid fa-paper-plane"></i></button>
            </form>
            <div class="mt-30">
                <input type="checkbox" id="Agree2">
                <label for="Agree2">I have read and accept the <a href="{{ route('tos') }}" target="_blank">Terms & Policy</a></label>
            </div>
        </div>
    </div>
</div>