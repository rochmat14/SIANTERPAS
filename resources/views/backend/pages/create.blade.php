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
            <li class="breadcrumb-item active" aria-current="page">Create {{ $title }}</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">{{ $title }}</div>
            </div>
            <div class="card-body">
               
                @if ($root)
                    <div class="page-header">
                        <h2>{!! $root->description()->first()->name !!}</h2>
                    </div>
                @endif


                <div class="panel panel-primary">
                    <div class="tab-menu-heading">
                        <div class="tabs-menu ">
                            <!-- Tabs -->
                            <ul class="nav panel-tabs">
                                <li class=""><a href="#tab_content_general" class="active" data-bs-toggle="tab">General</a></li>
                                <li><a href="#tab_content_data" data-bs-toggle="tab">Data</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="panel-body tabs-menu-body">
                        <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                        <div class="tab-content">
                            
                            <div class="tab-pane active " id="tab_content_general">
                                
                                
                                <div class="panel-body tabs-menu-body">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab_content_lang_id">
                                            <div class="form-group">
                                                <label for="name_id"  class="control-label col-lg-2">{{ __('main.title') }} <span class="required">*</span></label>
                                                <div class="col-lg-10">
                                                    <input type="text" class="form-control" id="name_id" name="name[id]" value="{{ old('name.id') }}" required="" placeholder="Masukan Judul Pages Disini..."> 
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="description_id"  class="control-label col-lg-2">{{ __('main.description') }} </label>

                                                <input type="hidden" name="description_id" value="{{ old('description.id') }}">
                                                <div class="col-lg-12">
                                                    <div style="height: 100%;" id="description_id" >{{ old('description.id') }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                            </div>

                            <div class="tab-pane  " id="tab_content_data">
                                
                                <div class="form-group{{ $errors->has('slug') ? ' has-error' : '' }}">
                                    <label for="slug"  class="control-label col-md-2">SEO URL / Slug <span class="required">*</span> </label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control text-lowercase" id="slug" name="slug" value="{{ old('slug') }}" required="" maxlength="255">
                                        @if ($errors->has('slug'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('slug') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('meta_keyword') ? ' has-error' : '' }}">
                                    <label for="meta_keyword"  class="control-label col-md-2">Meta Keyword <span class="required">*</span> </label>
                                    <div class="col-md-10">
                                        <textarea class="form-control" name="meta_keyword" placeholder="Meta Keyword"></textarea>
                                        @if ($errors->has('meta_keyword'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('meta_keyword') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('meta_description') ? ' has-error' : '' }}">
                                    <label for="meta_description"  class="control-label col-md-2">Meta Description <span class="required">*</span> </label>
                                    <div class="col-md-10">
                                        <textarea class="form-control" name="meta_description" placeholder="Meta description"></textarea>
                                        @if ($errors->has('meta_description'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('meta_description') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
                                    <label for="category"  class="control-label col-md-2">Category<span class="required">*</span> </label>
                                    <div class="col-md-10">
                                        <select name="category" class="form-control" required>
                                            <option value="">-- Select Category --</option>
                                            @foreach($category as $key => $value)
                                                <option value="{{$value->id}}">{{ $value->name }}</option>
                                            @endforeach

                                        </select>
                                        @if ($errors->has('category'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('category') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('tags') ? ' has-error' : '' }}">
                                    <label for="tags"  class="control-label col-md-2">Tags<span class="required">*</span> </label>
                                    <div class="col-md-10">
                                        <select class="form-control select2" data-placeholder="Choose Browser" name="post_tags[]" multiple required style="width:100%;">

                                            @foreach($tags as $key => $value)
                                                <option value="{{ $value->name }}">
                                                    {{ $value->name }}
                                                </option>
                                            @endforeach
                                            
                                            
                                        </select>
                                        @if ($errors->has('post_tags'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('post_tags') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-lg-2">Upload Foto</label>
                                    <div class="col-lg-10">
                                        <input type="file" name="image" class="btn btn-primary">
                                        <p><i>{{ __('main.info_image_blog') }}</i></p>
                                        
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="jenis" class="col-md-2 control-label">Type <span class="required" aria-required="true"> * </span></label>

                                    <div class="col-md-10">
                                        <div class="mt-radio-inline">
                                            <?php
                                            $jenisActive = old('jenis') !== false ? '1' : old('jenis');
                                            ?>
                                            @foreach ($arrJenis as $k => $v)
                                                <label class="mt-radio">
                                                    <input type="radio" name="jenis" id="jenis" value="{{ $k }}" {{ $k == $jenisActive ? 'checked' : '' }}> {{ $v }}
                                                    <span></span>
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="status" class="col-md-2 control-label">{{ __('main.status') }} <span class="required" aria-required="true"> * </span></label>

                                    <div class="col-md-10">
                                        <div class="mt-radio-inline">
                                            <?php
                                            $statusActive = old('status') !== false ? '1' : old('status');
                                            ?>
                                            @foreach (arrStatusActive() as $k => $v)
                                                <label class="mt-radio">
                                                    <input type="radio" name="status" id="status" value="{{ $k }}" {{ $k == $statusActive ? 'checked' : '' }}> {{ $v }}
                                                    <span></span>
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>


                            </div>

                             
                            <div style="padding-top: 20px;">
                                <button type="submit" class="btn btn-success">{{ __('main.submit') }}</button>
                                <a href="{{ LaravelLocalization::getLocalizedURL(LaravelLocalization::getCurrentLocale(),URL::to( 'dashboard/'.$controller )) }}" class="btn btn-white btn-default">{{ __('main.cancel') }}</a>
                            </div>
                           
                        </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
