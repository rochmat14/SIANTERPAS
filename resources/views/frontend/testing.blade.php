@section('sidebarActive', $controller)
@extends('layouts.template.frontend.app')
@section('content')

<!--End Page header-->
<div class="row">
    <div class="col-xl-8 col-md-4 col-lg-4">
        <img class="mx-auto w-100" id="foto-sampul" src="{{ asset('images/infobox/'.$infobox['image']) }}">  
    </div>

    <div class="col-xl-4 col-md-4 col-lg-4">
        <div class="row">
            <div class="col-xl-12 col-md-12 col-lg-12">
                <div class="card text-white" id="card_frontend1">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-lg-12">
                                <div class="d-block card-header border-0 text-center px-0">
                                    <h1 class="text-center mb-4">LAYANAN INFORMASI</h1>
                                    <h2>NOMOR ANTRIAN</h2>
                                </div>
                                <div class="row text-center">
                                    <div class="col-md-12">
                                        <h1 id="antrian_informasi">TUTUP</h1>
                                        <button href="#" class="btn btn-success fw-bold text_btn_atri">MEJA LAYANAN INFORMASI</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <div class="row">
            <div class="col-xl-12 col-md-12 col-lg-12">
                <div class="card text-white" id="card_frontend2">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-lg-12">
                                <div class="d-block card-header border-0 text-center px-0">
                                    <h1 class="text-center mb-4">LAYANAN PENGADUAN</h1>
                                    <h2>NOMOR ANTRIAN</h2>
                                </div>
                                <div class="row text-center">
                                    <div class="col-md-12">
                                        <h1 id="antrian_pengaduan">TUTUP</h1>
                                        <button href="#" class="btn btn-success fw-bold text_btn_atri">MEJA LAYANAN PENGADUAN</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-4 col-md-4 col-lg-4">
        <div class="row">
            <div class="col-xl-12 col-md-12 col-lg-12">
                <div class="card text-white" id="card_frontend3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-lg-12">
                                <div class="d-block card-header border-0 text-center px-0">
                                    <h2 class="text-center mb-4">LAYANAN KUNJUGAN SESI 1</h2>
                                    <h2>NOMOR ANTRIAN</h2>
                                </div>
                                <div class="row text-center">
                                    <div class="col-md-12">
                                        <h1 id="antrian_kunjungan1">TUTUP</h1>
                                        <button href="#" class="btn btn-success fw-bold text_btn_atri">MEJA LAYANAN KUNJUNGAN</button>
                                    </div>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-md-4 col-lg-4">
        <div class="row">
            <div class="col-xl-12 col-md-12 col-lg-12">
                <div class="card text-white" id="card_frontend4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-lg-12">
                                <div class="d-block card-header border-0 text-center px-0">
                                    <h3 class="text-center mb-4">LAYANAN KUNJUNGAN SESI 2</h3>
                                    <h2>NOMOR ANTRIAN</h2>
                                </div>
                                <div class="row text-center">
                                    <div class="col-md-12">
                                        <h1 id="antrian_kunjungan2">TUTUP</h1>
                                        <button href="#" class="btn btn-success fw-bold text_btn_atri">MEJA LAYANAN KUNJUNGAN</button>
                                    </div>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-md-4 col-lg-4">
        <div class="row">
            <div class="col-xl-12 col-md-12 col-lg-12">
                <div class="card text-white">
                    <div class="card-body" id="card_frontend5">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-lg-12">
                                <div class="d-block card-header border-0 text-center px-0">
                                    <h3 class="text-center mb-4">LAYANAN KUNJUNGAN SESI 3</h3>
                                    <h2>NOMOR ANTRIAN</h2>
                                </div>
                                <div class="row text-center">
                                    <div class="col-md-12">
                                        <h1 id="antrian_kunjungan3">TUTUP</h1>
                                        <button href="#" class="btn btn-success fw-bold text_btn_atri">MEJA LAYANAN KUNJUNGAN</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/app.js') }}"></script>
@endsection
