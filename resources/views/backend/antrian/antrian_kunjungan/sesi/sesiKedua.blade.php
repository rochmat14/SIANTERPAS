@php
$assets = asset('new_assets');
@endphp@section('sidebarActive', $controller)
@extends('layouts.template.app')
@section('vendor_css')
<link rel="stylesheet" href="{{ $assets }}/izitoast/css/iziToast.min.css">
@endsection
@section('css_scripts')
@endsection
@section('vendor_js')
<!-- ============================================================== -->
{{-- IziToast --}}
<script src="{{ $assets }}/izitoast/js/iziToast.min.js"></script>
{{-- datatables --}}
<script src="{{ $assets }}/plugins/datatable/js/jquery.dataTables.min.js"></script>
<script src="{{ $assets }}/plugins/datatable/js/dataTables.bootstrap5.js"></script>
<script src="{{ $assets }}/plugins/datatable/js/dataTables.buttons.min.js"></script>
<script src="{{ $assets }}/plugins/datatable/js/buttons.bootstrap5.min.js"></script>
<script src="{{ $assets }}/plugins/datatable/js/jszip.min.js"></script>
<script src="{{ $assets }}/plugins/datatable/pdfmake/pdfmake.min.js"></script>
<script src="{{ $assets }}/plugins/datatable/pdfmake/vfs_fonts.js"></script>
<script src="{{ $assets }}/plugins/datatable/js/buttons.html5.min.js"></script>
<script src="{{ $assets }}/plugins/datatable/js/buttons.print.min.js"></script>
<script src="{{ $assets }}/plugins/datatable/js/buttons.colVis.min.js"></script>
<script src="{{ $assets }}/plugins/datatable/dataTables.responsive.min.js"></script>
<script src="{{ $assets }}/plugins/datatable/responsive.bootstrap5.min.js"></script>
<script src="{{$assets}}/js/sweetalert.min.js"></script>
@endsection

@section('js_scripts')
  <script>
  </script>
@endsection

@section('content')

<!-- header dan link back -->
<div class="page-header">
  <div class="page-leftheader">
    <h4 class="page-title">{{ $title }}</h4>
  </div>
  <div class="page-rightheader ml-auto d-lg-flex d-none">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}" class="d-flex">
        <svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 3L2 12h3v8h6v-6h2v6h6v-8h3L12 3zm5 15h-2v-6H9v6H7v-7.81l5-4.5 5 4.5V18z"/><path d="M7 10.19V18h2v-6h6v6h2v-7.81l-5-4.5z" opacity=".3"/></svg>
        <span class="breadcrumb-icon"> Home</span></a>
      </li>
      <li class="breadcrumb-item"><a href="/dashboard/sesi_layanan_kunjungan">Pilih Sesi Kunjungan</a></li>
      <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
    </ol>
  </div>
</div>

    <section id="billboard" class="bg-light py-3">
        <div class="container text-center">
            <div class="row">
                <div class="col-xl-2 col-md-2 col-lg-2"></div>
                <div class="col-xl-8 col-md-8 col-lg-8">
                <a href="/dashboard/sesi_layanan_kunjungan" class="btn btn-danger btn-lg mb-2 col-md-12 offset-md-3x fw-bold">KEMBALI</a>

                <form action="{{ route('sesiKedua.store') }}" method="POST">
                    @csrf
                    <?php 
                    $count=0;
                    ;?>
                    @foreach($nomorAntrianSesiKedua as $data)
                    <div class="card">
                        <div class="card-body">
                            <h1>Nomor Urut Sesi Kedua</h1>
                            <h1>{{$data->nomor_urut}}</h1>
                            <input type="text" value="{{$data->nomor_urut}}" name="nomor_urut" hidden>
                        </div>
                    </div>
                    <?php $count++; ?>
                    @endforeach
                    
                    {{ $nomorAntrianSesiKedua->links() }} 
                    <br>

                    <button type="submit" class="btn btn-primary btn-lg col-xl-12 col-md-12 col-lg-12 mb-4 mr-3 fw-bold">TAMPILKAN DI MONITOR UTAMA</button>
                    <a onclick="lKunjungan2()" class="btn btn-primary btn-lg col-xl-12 col-md-12 col-lg-12 mb-4 fw-bold">PANGGIL</a>
                </form>
                </div>
                <div class="col-xl-2 col-md-2 col-lg-2"></div>
            </div>
        </div>
    </section>

    <script>
        function lKunjungan2(){
          var mp3 = <?php echo json_encode($data->audio); ?>;
          var audio = mp3.slice(0,3);
          var nomor_urut = <?php echo json_encode($data->nomor_urut); ?>;

          if(audio == nomor_urut) {
            var audio = new Audio("/audio/layanan_kunjungan/sesi_kedua/"+<?php echo json_encode($data->nomor_urut); ?>+".mp3");
            audio.play();
          }else{
            alert('Audio tidak ditemukan, silakan input audio yang sesuai');
          } 
        }
    </script>
@endsection