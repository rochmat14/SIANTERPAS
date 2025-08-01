@php 
    $assets = asset('frontend_assets');
@endphp
@extends('layouts.layout_login')
@section('bodyClass', 'front preload')
@section('navActive', 'home')
@section('content')



@section('css_scripts')
{{-- script js tambahan --}}


@endsection

@section('js_scripts')
{{-- script js tambahan --}}
@endsection




{{-- layouts core --}}

 <section class="contact-section section-padding">
    <div class="container">
        <div class="contact-wrapper form_login" style="padding:180px 20px;">
            <div class="section-title text-center">
                <img src="{{url('images/logo')}}/{{ AppSeting('logo') }}" alt="image" style="width:200px;"><br><br>
                <h4>
                    Login Authentication
                </h4>
            </div> <!-- section-title -->

            <div class="row">

               

                <div class="col-md-12">
                    <div class="form-section">

                        @if (session('status'))
                              <div class="alert alert-success">
                                  {{ session('status') }}
                              </div>
                        @endif


                        <form method="POST" action="{{ route('login') }}" class="contact-form">
                            @csrf
                            

                            <div class="form-group">
                                <input id="email" type="email" class="domainSearchBar form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="E-Mail">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            

                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Login</button>
                            </div>
                        </form>
                    </div> <!-- mail-section -->
                </div>

                
            </div>
        </div>
    </div>
</section> <!-- contact-section -->

@endsection