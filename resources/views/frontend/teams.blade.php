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


<div class="space2" id="about-sec">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-7 mb-30 mb-xl-0">
                <div class="img-boxxx1">
                    <div class="img1">
                        <img src="{{ $url_future_image }}" alt="{{ $team->name }}">
                    </div>
                </div>
            </div>
            <div class="col-xl-5">
                <div class="title-area mb-32">
                    <span class="sub-title">{{ $team->divisi_name }}</span>
                    <h2 class="sec-title2">{{ $team->name }}</h2>
                    
                </div>
                <div class="checklist mt-n2 mb-35">
                    <ul>
                        <li><i class="far fa-check-circle"></i> The card you scanned belongs to PT Era Kualitas Informasi</li>
                        <li><i class="far fa-check-circle"></i> Employees are required to use an IDCard while on duty both inside and outside the company.</li>
                        <li><i class="far fa-check-circle"></i> If you find this IDCard due to the negligence of the IDCard holder, please contact/submit it to us:</li>
                    </ul>
                </div>
                @if($team->status_active =='active')
                    <a data-theme-color="#00D084" href="#" class="category">Active</a>
                @else
                    <a data-theme-color="#FF1D50" href="#" class="category">Non-Active</a>
                @endif
                <hr>


                <a href="{{ route('contact_us') }}" class="th-btn center">Contact Now<i class="fas fa-arrow-up-right ms-2"></i></a>
            </div>
        </div>
    </div>
</div>






@endsection