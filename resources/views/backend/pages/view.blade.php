@php
$assets = asset('new_assets');
@endphp@section('sidebarActive', $controller)
@extends('layouts.template.app')
@section('vendor_css')
<link href="{{ $assets }}/plugins/select2/select2.min.css" rel="stylesheet" />



@endsection
@section('css_scripts')
@endsection
@section('vendor_js')
<script src="{{ $assets }}/js/jquery-ui/jquery-ui.min.js"></script>
<script src="{{ $assets }}/js/jquery-ui/jquery-ui-timepicker-addon.js"></script>


<!-- quill js -->
<script src="{{ $assets }}/plugins/quill/quill.min.js"></script>
<script src="https://cdn.rawgit.com/kensnyder/quill-image-resize-module/3411c9a7/image-resize.min.js"></script>
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



var icons = Quill.import('ui/icons');
    icons['bold'] = '<i class="fa fa-bold" aria-hidden="true"><\/i>';
    icons['italic'] = '<i class="fa fa-italic" aria-hidden="true"><\/i>';
    icons['underline'] = '<i class="fa fa-underline" aria-hidden="true"><\/i>';
    icons['strike'] = '<i class="fa fa-strikethrough" aria-hidden="true"><\/i>';
    icons['list']['ordered'] = '<i class="fa fa-list-ol" aria-hidden="true"><\/i>';
    icons['list']['bullet'] = '<i class="fa fa-list-ul" aria-hidden="true"><\/i>';
    icons['link'] = '<i class="fa fa-link" aria-hidden="true"><\/i>';
    icons['image'] = '<i class="fa fa-image" aria-hidden="true"><\/i>';
    icons['video'] = '<i class="fa fa-film" aria-hidden="true"><\/i>';
    icons['code-block'] = '<i class="fa fa-code" aria-hidden="true"><\/i>';
var quill = new Quill('#description_id', {
    theme: 'snow',
    modules: {
        imageResize: {
          displaySize: true
        },
        toolbar: [
                [{ header: [1, 2, 3, 4, 5, 6, false] }],
                [{ font: [] }],
                ["bold", "italic"],
                ["link", "blockquote", "code-block", "image","video"],
                [{ list: "ordered" }, { list: "bullet" }],
                [{ script: "sub" }, { script: "super" }],
                [{ color: [] }, { background: [] }],
                [
                    { align: '' }, 
                    { align: 'center' }, 
                    { align: 'right' }, 
                    { align: 'justify' }
                ]
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
            <li class="breadcrumb-item" aria-current="page"><a href="{{ url('dashboard/pages') }}">{{ $title }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit {{ $title }}</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Edit {{ $title }}</div>
            </div>
            <div class="card-body">
               
                @if (isset($errors) && $errors->any())
                    @foreach ($errors->all() as $error)
                        <p class="alert alert-danger">{{ $error }}</p>
                    @endforeach
                @endif


                <div class="panel panel-primary">
                    
                    <div class="panel-body tabs-menu-body">
                        
                            
                        <div class="tab-content">
                            
                            <div class="tab-pane active " id="tab_content_general">
                                
                                
                                <div class="panel-body tabs-menu-body">
                                    <div class="tab-content">
                                        @php
                                            $localeCode="id";
                                        @endphp
                                        <div class="tab-pane active" id="tab_content_lang_{!! $localeCode !!}">
                                            <div class="form-group">
                                                <label for="name_{!! $localeCode !!}"  class="control-label col-lg-2">{{ __('main.title') }} <span class="required">*</span></label>
                                                <div class="col-lg-10">
                                                    <input type="text" class="form-control" id="name_{!! $localeCode !!}" name="name[{!! $localeCode !!}]" value="{{ $descriptions[$localeCode]->name }}" readonly> 
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="description_{!! $localeCode !!}"  class="control-label col-lg-2">{{ __('main.description') }} </label>
                                                <div class="col-lg-12">
                                                    <div style="height: 100%;" id="description_{!! $localeCode !!}">{!! $descriptions[$localeCode]->description !!}</div>
                                                </div>
                                            </div>
                                        </div>
                                            
                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-offset-2 col-md-10">
                                                    <a href="{{ LaravelLocalization::getLocalizedURL(LaravelLocalization::getCurrentLocale(),URL::to( 'dashboard/'.$controller.'/'.$row->id.'/edit' )) }}" class="btn btn-success">{{ __('main.edit') }}</a>
                                                    <a href="{{ LaravelLocalization::getLocalizedURL(LaravelLocalization::getCurrentLocale(),URL::to( 'dashboard/'.$controller )) }}" class="btn btn-default">{{ __('main.back') }}</a>
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
        </div>
    </div>
</div>
@endsection
