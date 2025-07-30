@php
$assets = asset('new_assets');
@endphp@section('sidebarActive', $controller)
@extends('layouts.template.app')
@section('vendor_css')



@endsection
@section('css_scripts')
@endsection
@section('vendor_js')
<script src="{{ $assets }}/js/jquery-ui/jquery-ui.min.js"></script>
<script src="{{ $assets }}/plugins/jquery-cookiew/js.cookie.min.js"></script>
<script src="{{ $assets }}/plugins/jquery-cookiew/jquery.cookie.js"></script>
@endsection
@section('js_scripts')
<script>
$(document).ready(function() {
    $("ul").sortable({
        update : function () {
            var parent_id = $(this).attr('parent');
            var order = $(this).sortable('serialize');
            $.ajax({url: "{{url('/') }}/{{ LaravelLocalization::getCurrentLocale() }}/dashboard/pages/reorder/"+parent_id+'?'+order});
        }
    });
});


(function(a){
    a.treeMely=function(eEl, eUrl, eTarget, eId, eLevel, eCookie){
        a.eEl = eEl;
        a.treeMely.initialize=function(){
            if (a.treeMely.isExpanded($(eTarget))){
                $(eTarget).children('ul').hide();

                eEl.attr('src', '{{ asset('new_assets/images/xxx/expand.png') }}');
                $(eTarget).removeClass('children-visible').addClass('children-hidden');
                a.treeMely.removeExpandedCookie();

                


            } else{
                eEl.attr('src', '{{ asset('new_assets/images/xxx/collapse.png') }}');
                $(eTarget).removeClass('children-hidden').addClass('children-visible');


                if ($(eTarget).children('ul').length > 0){
                    $(eTarget).children('ul').show();
                } else{
                    a.treeMely.ajax(eId, eLevel);
                }
            }
        };
        a.treeMely.isExpanded=function(row){
            return row.hasClass('children-visible');
        };
        a.treeMely.hasChildren=function(){
            return !a.row.hasClass('no-children');
        };
        a.treeMely.ajax=function(){
            $('#busy-'+eId).show();
            $.ajax({url: eUrl+'/'+eId+'/'+eLevel, success: function(msg){
                if(parseInt(msg)!=0)
                {
                    $(eTarget).append(msg);
                    $('#busy-'+eId).hide();
                    a.treeMely.saveExpandedCookie();

                    $(".container ul").sortable({
                        /*handle : '.handle_reorder',*/
                        update : function () {
                            var parent_id = $(this).attr('parent');
                            var order = $(this).sortable('serialize');
                            $.ajax({url: "{{ url('/') }}/{{ LaravelLocalization::getCurrentLocale() }}/dashboard/form-builder/reorder/"+parent_id+'?'+order});
                        }
                    });
                }
            }
            });

        };
        a.treeMely.saveExpandedCookie=function(){
            $.cookie(eCookie);
            var newCookie;
            if ($.cookie(eCookie) != null) {
                newCookie = $.cookie(eCookie) + ',' + eId;
            }
            else {
                newCookie = eId.toString();
            }

            $.cookie(eCookie, a.treeMely.unique(newCookie.split(',')).join(","));
        };
        a.treeMely.removeExpandedCookie=function(){
            var arrCookie = $.cookie(eCookie).split(',');
            var arrCookieLength = arrCookie.length;

            var newCookie = '';
            if (arrCookieLength > 0){
                for (var x=0; x<arrCookieLength; x++){
                    if (arrCookie[x] != eId){
                        newCookie += arrCookie[x];

                        if (x < arrCookieLength-1) newCookie += ',';
                    }
                }
            }

            $.cookie(eCookie, newCookie);
        };
        a.treeMely.unique=function(arrayName)
        {
            var newArray=new Array();
            label:for(var i=0; i<arrayName.length;i++ )
            {
                for(var j=0; j<newArray.length;j++ )
                {
                    if(newArray[j]==arrayName[i])
                        continue label;
                }
                newArray[newArray.length] = arrayName[i];
            }
            return newArray;
        }

        a.treeMely.initialize();
    };

})(jQuery);

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
            <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
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
                @if(session('status'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-bs-dismiss="alert">
                            <i class="ace-icon fa fa-times"></i>
                        </button>
                        <h4 class="block">{{ __('main.success') }}</h4>
                        <p> {{ session('status') }}</p>
                    </div>
                @endif


                
                @if ($user->can('pages-create'))
                <div class="clearfix">
                    <div class="pull-left tableTools-container">
                        <a href="{{ LaravelLocalization::getLocalizedURL(LaravelLocalization::getCurrentLocale(),URL::to( 'dashboard/'.$controller.'/create' )) }}" class="btn btn-success"> {{ __('main.add_new') }}
                            <i class="fa fa-plus"></i>
                        </a>
                    </div>
                </div>
                @endif

                <br>
                {!! $content_children !!}
            </div>
        </div>
        <!--/div-->
    </div>
</div>
{{-- Form --}}
@endsection
