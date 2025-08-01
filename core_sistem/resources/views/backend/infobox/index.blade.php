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
        order: [[ 2, 'desc' ]],
        ajax: {
            "url": "{!! route($controller.'.getData') !!}",
            "type": "POST"
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex' }, // 0
            { data: 'title', name: 'title' },
            { data: 'link', name: 'link' },
            { data: 'image', name: 'image' },
            { data: 'status', name: 'status' },
            
            { data: null }
        ],

        "columnDefs": [
            {
                "targets": [ 0 ],
                "searchable": false,
                "sortable": false,
            },

            {
                "targets": [ 3 ],
                "className": 'col-center',
                "searchable": false,
                "sortable": false,
                "render": function ( data, type, row ) {
                    var image = row['image'];
                    return `
                            <img src="{{ asset('/images/infobox/') }}/${image}" style="width:100px;">
                    `;  
                    
                }
            }, 
            
            {
                "targets": [ 5 ],
                "className": 'col-center',
                "searchable": false,
                "sortable": false,
                "render": function ( data, type, row ) {
                    var editUrl = row['editUrl'];
                   

                    return `
                        @if (auth()->user()->can($controller.'-update'))
                            <a href='javascript:void(0)' class="badge bg-light" onclick=edited("${editUrl}") title="Edit">
                                <i class="fa fa-edit text-info"></i> Update
                            </a>
                        @endif
                        
                    `;  
                    
                }
            },               
        ],

        "dom": '<"custom-toolbar">frtip',
    });

    

});


function reload_table() {
    table.ajax.reload(null, false); //reload datatable ajax 
}


//edited
//edited
function edited(id){
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#photo-preview').show(); 
    //Ajax Load data from ajax
    $.ajax({
        url : "{{url('dashboard/'.$controller.'/get_data/id')}}",
        type: "GET",
        dataType: "JSON",
        data: {"id":id},
        async: true,
        success: function(result)
        {
            $('[name="id"]').val(result.data.id);
            $('[name="title"]').val(result.data.title);
            $('[name="link"]').val(result.data.link);
            $('[name="status"]').val(result.data.status);
            $('#modal_form').modal('show');
            $('.modal-title').text(' Edit Info Box'); 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}


function save(){
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    event.preventDefault();
    var url;
    var pesan;

    if(save_method == 'add') {
        url ="{{url('dashboard/'.$controller.'/save')}}";
        pesan ='Success Add Data';
        // console.log(url);
    } else {
        url ="{{url('dashboard/'.$controller.'/update')}}";
        pesan ='Success Update Data';

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
          $('#btnSave').text('save'); //change button text
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
          $('#btnSave').text('save'); //change button text
          $('#btnSave').attr('disabled',false); //set button enable 
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
                <div class="table-responsive">
                    {{-- Form --}}
                    <div class="modal fade" id="modal_form" role="document" data-backdrop="static" data-keyboard="false">
                        <div class="modal-dialog" role="document">
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
                                            <label for="title" class="control-label">Title :</label>
                                            <input type="text" class="form-control" id="title" name="title" placeholder="Title">
                                        </div>
                                        <div class="form-group">
                                            <label for="link" class="control-label">Link :</label>
                                            <input type="text" class="form-control" id="link" name="link" placeholder="Link">
                                        </div>

                                        <div class="form-group">
                                            <label for="name" class="control-label">File Images:</label>
                                            <input type="file" class="form-control" id="image" name="image" placeholder="File Image">
                                        </div>

                                        <div class="form-group">
                                            <label for="phone" class="control-label">Status :</label>
                                            <select name="status" id="status" class="form-control">
                                                <option value="on">ON</option>
                                                <option value="off">OFF</option>
                                            </select>
                                        </div>

                                        
                                    </form>
                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <table id="table-{{ $controller }}" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Title</th>
                                <th>Link</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--/div-->
    </div>
</div>
{{-- Form --}}
@endsection
