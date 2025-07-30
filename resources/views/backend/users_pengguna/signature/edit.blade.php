@php
$assets = asset('new_assets');
@endphp@section('sidebarActive', $controller)
@extends('layouts.template.app')
@section('vendor_css')
<link rel="stylesheet" href="{{ $assets }}/izitoast/css/iziToast.min.css">
@endsection
@section('css_scripts')
<style type="text/css">
.signature-pad {
    border: 1px solid #ccc;
    border-radius: 5px;
    width: 100%;
    height: 260px;
}

</style>
@endsection
@section('vendor_js')
<script src="{{ $assets }}/js/signature_pad.min.js"></script>
<script src="{{ $assets }}/izitoast/js/iziToast.min.js"></script>
@endsection
@section('js_scripts')
<script>
    var canvas = document.getElementById('signature-pad');

            // Adjust canvas coordinate space taking into account pixel ratio,
            // to make it look crisp on mobile devices.
            // This also causes canvas to be cleared.
            function resizeCanvas() {
                // When zoomed out to less than 100%, for some very strange reason,
                // some browsers report devicePixelRatio as less than 1
                // and only part of the canvas is cleared then.
                var ratio =  Math.max(window.devicePixelRatio || 1, 1);
                canvas.width = canvas.offsetWidth * ratio;
                canvas.height = canvas.offsetHeight * ratio;
                canvas.getContext("2d").scale(ratio, ratio);
            }

            window.onresize = resizeCanvas;
            resizeCanvas();

            var signaturePad = new SignaturePad(canvas, {
            backgroundColor: 'rgb(255, 255, 255)' // necessary for saving image as JPEG; can be removed is only saving as PNG or SVG
            });

            document.getElementById('save-png').addEventListener('click', function () {
            if (signaturePad.isEmpty()) {
                iziToast.error({
                  title: 'ERROR !',
                  message: 'Tanda Tangan Tidak Boleh Kosong',
                  position: 'topRight'
                });
            }else{
                var data = signaturePad.toDataURL('image/png');
                console.log(data);
                $('#myModal').modal('show').find('.modal-body').html('<img src="'+data+'"><textarea id="signature64" name="signed" style="display:none">'+data+'</textarea>');
            }
            });
            document.getElementById('clear').addEventListener('click', function () {
            signaturePad.clear();
            });

            document.getElementById('undo').addEventListener('click', function () {
                var data = signaturePad.toData();
            if (data) {
                data.pop(); // remove the last dot or line
                signaturePad.fromData(data);
            }
            });    
</script>
@endsection
@section('content')
<div class="page-header">
    <div class="page-leftheader">
        <h4 class="page-title">{{ $title }}</h4>
    </div>
    <div class="page-rightheader ml-auto d-lg-flex d-none">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}" class="d-flex">
                    <svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path d="M12 3L2 12h3v8h6v-6h2v6h6v-8h3L12 3zm5 15h-2v-6H9v6H7v-7.81l5-4.5 5 4.5V18z" />
                        <path d="M7 10.19V18h2v-6h6v6h2v-7.81l-5-4.5z" opacity=".3" /></svg>
                    <span class="breadcrumb-icon"> Home</span></a>
            </li>
            <li class="breadcrumb-item"><a href="/dashboard/users_pengguna">Users Pengguna</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header">
                <div class="card-title">Ubah {{ $title }}</div>
            </div>
            <div class="card-body">
                <h2>{{ $user->name }}</h2>
                <div class="row">
                    <div class="col-md-6">
                        <h4>Tanda Tangan Lama</h4>
                        <img id="foto_kapal" src="{{ asset('images/signature/'.$user->signature) }}" alt="images" style="margin-left: 35px;
    margin-top: 59px;">
                    </div>
                    <div class="col-md-6">
                        <h4>Silakan Tanda Tangan</h4>
                        <div class="text-right">
                            <button type="button" class="btn btn-default btn-sm" id="undo"><i class="fa fa-undo"></i> Undo</button>
                            <button type="button" class="btn btn-danger btn-sm" id="clear"><i class="fa fa-eraser"></i> Clear</button>
                        </div>
                        <br>
                        <form method="POST" action="{{route('ubah_signature')}}">
                            @csrf
                            <input hidden name="id" value="{{ $user->id }}">
                            <div class="wrapper">
                                <canvas id="signature-pad" class="signature-pad"></canvas>
                            </div>
                            <br>
                            <button type="button" class="btn btn-primary btn-block" id="save-png">Simpan Tanda Tangan</button>
                            <!-- Modal untuk tampil preview tanda tangan-->
                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        </div>
                                        <div class="modal-body">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                                            <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save"></i> Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                </divl>
            </div>
            <!--/div-->
        </div>
    </div>
    {{-- Form --}}
    @endsection
