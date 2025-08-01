@php
$assets = asset('new_assets');
@endphp
@section('sidebarActive', $controller)
@extends('layouts.template.app')
@section('vendor_css')
<link rel="stylesheet" href="{{ $assets }}/izitoast/css/iziToast.min.css">
<link href="{{ $assets }}/plugins/select2/select2.min.css" rel="stylesheet" />
@endsection
@section('css_scripts')
@endsection
@section('vendor_js')


<script src="{{ $assets }}/js/jquery-ui/jquery-ui.min.js"></script>
<script src="{{ $assets }}/js/jquery-ui/jquery-ui-timepicker-addon.js"></script>


<!-- quill js -->
<script src="{{ $assets }}/plugins/quill/quill.min.js"></script>

<script src="{{ $assets }}/plugins/select2/select2.full.min.js"></script>
<script src="{{ $assets }}/js/select2.js"></script>

@endsection
@section('js_scripts')
<script>
$(document).ready(function() {
    $('.date-picker').datetimepicker({
        dateFormat: 'dd-mm-yy',
        timeFormat: 'HH:mm:ss'
    });
    
});



var quill = new Quill('#description_id', {
    theme: 'snow',
    modules: {
        toolbar: [
                [{ header: [1, 2, 3, 4, 5, 6, false] }],
                [{ font: [] }],
                ["bold", "italic"],
                ["link", "blockquote", "code-block", "image"],
                [{ list: "ordered" }, { list: "bullet" }],
                [{ script: "sub" }, { script: "super" }],
                [{ color: [] }, { background: [] }],
        ]
    },
    placeholder: 'Tulis sesuatu disini...'
});

quill.on('text-change', function(delta, oldDelta, source) {
    document.querySelector("input[name='description_id']").value = quill.root.innerHTML;
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
            <li class="breadcrumb-item active" aria-current="page"><a href="{{url('dashboard/news')}}">{{ $title }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Views</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Views {{ $title }}</div>
            </div>
            <div class="card-body">
                

               


                <div class="panel panel-primary">
                    
                    <div class="panel-body tabs-menu-body">
                        
                        <div class="tab-content">
                            
                            <div class="tab-pane active " id="tab_content_general">
                                
                                
                                <div class="panel-body tabs-menu-body">
                                    <div class="tab-content">

                                        
                                            <div class="tab-pane active" id="tab_content_lang_id">
                                                
                                                <div class="form-group">
                                                    <label for="title_id"  class="control-label col-lg-2">{{ __('main.title') }} <span class="required">*</span></label>
                                                    <div class="col-lg-10">
                                                        <input type="text" class="form-control" id="title_id" name="title[id]" value="{{ $descriptions['id']->title }}" readonly maxlength="255">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="description_id"  class="control-label col-lg-2">{{ __('main.description') }} <span class="required">*</span></label>
                                                    <div class="col-lg-10">
                                                        <div style="height: 100%;" id="description_id" >{!! $descriptions['id']->description !!}</textarea>
                                                    </div>
                                                </div>
                                            </div>

                                        
                                       
                                    </div>
                                </div>



                            </div>

                            
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-2 col-md-10">
                                        <a href="{{ LaravelLocalization::getLocalizedURL(LaravelLocalization::getCurrentLocale(),URL::to( 'dashboard/'.$controller )) }}" class="btn btn-default">{{ __('main.back') }}</a>
                                    </div>
                                </div>
                            </div>
                           
                        </div>
                        
                    </div>
                </div>
                           


            </div>
        </div>
        <!--/div-->
    </div>
</div>
{{-- Form --}}
@endsection
