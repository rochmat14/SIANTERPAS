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

var table="";

$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
        table = $('#table-{{ $controller }}').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        order: [[ 2, 'desc' ]],
        ajax: {
            "url": "{!! route($controller.'.getData') !!}",
            "type": "POST"
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex' }, // 0
            { data: 'fiture_image', name: 'fiture_image' },
            @if(auth()->user()->can($controller.'-all'))
            { data: 'writer', name: 'writer' },
            @endif
            { data: 'title', name: 'title' },
            { data: 'category', name: 'category' },
            { data: 'status_publish', name: 'status_publish' },
            { data: 'action', name: 'action' },
            
        ],
        "columnDefs": [
            {
                "targets": [ 0 ],
                "searchable": false,
                "sortable": false,
            }           
        ],
       

        "dom": '<"custom-toolbar">frtip',
    });

    @if(auth()->user()->can($controller.'-create'))
        $("div.custom-toolbar").html('<a href="{{ LaravelLocalization::getLocalizedURL(LaravelLocalization::getCurrentLocale(),URL::to( 'dashboard/'.$controller.'/create' )) }}" class="btn btn-success waves-effect waves-light"><i class="glyphicon glyphicon-plus"></i>{{ __('main.add_new') }} </a> <button class="btn waves-effect waves-light btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>');
    @endif
});


function reload_table() {
    table.ajax.reload(null, false); //reload datatable ajax 
}


function change_status(id){
    save_method = 'change_status';
    $('#form')[0].reset();
    $('.form-group').removeClass('has-error');
    $('.help-block').empty();
    $.ajax({
        url : "{{url('dashboard/'.$controller.'/get_data/id')}}",
        type: "GET",
        dataType: "JSON",
        data: {"id":id},
        async: true,
        success: function(result)
        {
            //agent data
            $('[name="id"]').val(result.data.id);
            $('[name="publish"]').val(result.data.publish);
            $('#modal_form').modal('show');
            $('.modal-title').text('Change Status '+result.title); 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function status_change(){
    $('#btnSave').text('submit...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 

    event.preventDefault();
    var url;
    var pesan;

    if(save_method == 'change_status') {
        url ="{{url('dashboard/'.$controller.'/change_status')}}";
        pesan ='Success Change Data';
        // console.log(url);
    }
    // ajax adding data to database
    var formData = new FormData($('#form')[0]);

    $.ajax({
        url : url,
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function(data)
        {
          if(data.status) //if success close modal and reload ajax table
          {
              $('#modal_form').modal('hide');
              iziToast.success({
                  title: 'OK',
                  position: 'center',
                  message: pesan,
              });
              reload_table();
          }
          else
          {
              for (var i = 0; i < data.inputerror.length; i++) 
              {
                  $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                  $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
              }
          }
          $('#btnSave').text('Submit'); //change button text
          $('#btnSave').attr('disabled',false); //set button enable 
        },
        error: function (data)
        {   
          console.log(data.responseJSON.message);
          var error_message="";
          error_message +="<ul>";
          $.each( data.responseJSON.errors, function( key, value ) {
             error_message +="<li>"+value+"</li>";
          });

          error_message +="</ul>";
          iziToast.error({
               title: 'ERROR !',
               message: error_message,
               position: 'topRight'
          });
          $('#btnSave').text('Submit'); //change button text
          $('#btnSave').attr('disabled',false); //set button enable 
        }
    });
}


function send_article(id){
    var href = $(this).attr('href');
    var message = $(this).data('confirm');
    swal({
        title: "Apakah anda ingin mengirim artikel ini untuk di publish ?",
        text: message, 
        icon: "info",
        buttons: true,
        dangerMode: false,
    })
    .then((willDelete) => {
      if (willDelete) {
        var url ="{{ route('news.send_article') }}";
        $.ajax({
            url : url,
            type: "POST",
            data: {"id":id},
            dataType: "JSON",
            headers:
            {
                'X-CSRF-Token': $('input[name="_token"]').val()
            },
            success: function(result)
            {
                if(result.data_post.status) //if success close modal and reload ajax table
                {
                    iziToast.success({
                        title: 'OK',
                        position: 'center',
                        message: result.data_post['message'],
                    });
                    reload_table();
                }
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });
      }
    });
}

function pull_article(id){
    var href = $(this).attr('href');
    var message = $(this).data('confirm');
    swal({
        title: "Apakah anda ingin menarik artikel ini untuk dapat di update ?",
        text: message, 
        icon: "info",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        var url ="{{ route('news.pull_article') }}";
        $.ajax({
            url : url,
            type: "POST",
            data: {"id":id},
            dataType: "JSON",
            headers:
            {
                'X-CSRF-Token': $('input[name="_token"]').val()
            },
            success: function(result)
            {
                if(result.data_post.status) //if success close modal and reload ajax table
                {
                    iziToast.success({
                        title: 'OK',
                        position: 'center',
                        message: result.data_post['message'],
                    });
                    reload_table();
                }
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });
      }
    });
}

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
                <div class="table-responsive">
                    <table id="table-{{ $controller }}" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Fiture Image</th>
                                @if(auth()->user()->can($controller.'-all'))
                                    <th>Writer</th>
                                @endif
                                <th>Title</th>
                                <th>Category</th>
                                <th>Status Publish</th>
                                <th>{{ __('main.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_form" role="document" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title"></h3>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form" method="post" class="form-horizontal">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <input type="hidden" value="" name="id" id="id" />
                        <label for="publish" class="control-label">Status :</label>
                        <select name="publish" id="publish" class="form-control">
                            <option value="">--Select Status--</option>
                            <option value="draft">Draft</option>
                            <option value="pending">Pending</option>
                            <option value="publish">Publish</option>
                            <option value="reject">Reject</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" id="btnSave" onclick="status_change()" class="btn btn-primary">Submit</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
@endsection
