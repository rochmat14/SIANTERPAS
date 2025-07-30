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
var table ="";
$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    table = $('#table-{{ $controller }}').DataTable({
        processing: true,
        serverSide: true,
        order: [[ 1, 'desc' ]],
        ajax: {
            "url": "{!! route($controller.'.getData') !!}",
            "type": "POST"
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex' }, // 0
            // { data: 'id', name: 'id' },
            { data: 'name', name: 'name'},
            { data: 'deskripsi', name: 'deskripsi'},
            //{ data: 'organization_name', name: 'organization_name'},
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
                    var permissionUrl = row['permissionUrl'];
                    var editUrl = row['editUrl'];
                    var deleteUrl = row['deleteUrl'];

                    return `
                        @if (auth()->user()->can($controller.'-update'))
                            <a class="badge bg-light mt-2" href="${permissionUrl}" title="Edit Permission">
                                <i class="fa fa-edit text-warning"></i> Permission
                            </a>
                        @endif

                        @if (auth()->user()->can($controller.'-update'))
                            <a class="badge bg-light mt-2" href="${editUrl}" title="Edit">
                                <i class="fa fa-edit text-info"></i> Edit
                            </a>
                        @endif

                        @if (auth()->user()->can($controller.'-delete'))
                            <form method="POST" action="${deleteUrl}" style="display:inline;">
                                <input name="_method" type="hidden" value="DELETE">
                                {!! Form::token() !!}
                                <button type="submit" class="badge bg-danger mt-2" data-action="delete-record">
                                    <i class="fa fa-trash"></i> Delete
                                </button>
                            </form>
                        @endif
                    `;  
                    
                }
            },               
        ],

        "dom": '<"custom-toolbar">frtip',
    });

    @if(auth()->user()->can($controller.'-create'))
        $("div.custom-toolbar").html('<a href="{{ route($controller.'.create') }}" class="btn waves-effect waves-light btn-success btn-xs"><i class="fa fa-plus"></i> Create Divisi & Roles</a> <button class="btn waves-effect waves-light btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>');

        
    @endif
    
    $('body').on('click', '[data-action="delete-record"]', function(event) {
        event.preventDefault();
        if (confirm('Apakah anda serius akan menghapus data ini?')) {
            $(this).parents('form').submit();
        }
    });
});


function reload_table() {
    table.ajax.reload(null, false); //reload datatable ajax 
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
        <svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 3L2 12h3v8h6v-6h2v6h6v-8h3L12 3zm5 15h-2v-6H9v6H7v-7.81l5-4.5 5 4.5V18z"/><path d="M7 10.19V18h2v-6h6v6h2v-7.81l-5-4.5z" opacity=".3"/></svg>
        <span class="breadcrumb-icon"> Home</span></a>
      </li>
      <li class="breadcrumb-item"><a href="#">Level Otorisasi</a></li>
      <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
    </ol>
  </div>
</div>



<div class="row">
  <div class="col-12">
    <div class="card shadow-sm">
      <div class="card-header">
        <div class="card-title">{{ $title }}</div>
      </div>
      <div class="card-body">
        <div class="table-responsive">

        {{-- Form  --}}
        <div class="modal fade col-md-12" id="modal_form" role="dialog" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title"></h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="form" method="post" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <input type="hidden" value="" name="id" id="id" />
                                <label for="name" class="control-label">Permissions Name:</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Permissions Name">
                            </div>
                        </form>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="submit" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
         

        <table id="table-{{ $controller }}" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th width="10">No</th>
                    <!-- <th width="20">ID</th> -->
                    <th>Name</th>
                    {{-- <th>Persentasi Penghasilan</th> --}}
                    <th>Description</th>
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

@endsection
