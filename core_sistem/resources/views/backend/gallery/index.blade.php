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
        order: [[ 2, 'asc' ]],
        ajax: {
            "url": "{!! route($controller.'.getData') !!}",
            "type": "POST"
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex' }, // 0
            { data: 'title', name: 'title'},
            { data: 'category', name: 'category'},
           
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
                    var file_image = row['file_image'];
                    return `
                            <img src="{{ asset('/images/gallery/') }}/${file_image}" style='width:100px;'>
                    `;  
                    
                }
            },  
            {
                "targets": [ 4 ],
                "className": 'col-center',
                "searchable": false,
                "sortable": false,
                "render": function ( data, type, row ) {
                    var editUrl = row['editUrl'];
                    var deleteUrl = row['deleteUrl'];
                    return `
                        @if (auth()->user()->can($controller.'-update'))
                            <a href='${editUrl}' class="badge bg-light"  title="Edit">
                                <i class="fa fa-edit text-info"></i> Edit
                            </a>
                        @endif
                        @if (auth()->user()->can($controller.'-delete'))
                            <a href='javascript:void(0)' class="badge bg-light" onclick=removed("${deleteUrl}") title="Delete">
                                <i class="fa fa-edit text-danger"></i> Delete
                            </a>
                        @endif
                    `;  
                    
                }
            },
        ],

        "dom": '<"custom-toolbar">frtip',
    });

    @if(auth()->user()->can($controller.'-create'))
        $("div.custom-toolbar").html('<a href="{{ url('dashboard/gallery/create') }}" class="btn btn-success waves-effect waves-light"><i class="glyphicon glyphicon-plus"></i>Add Gallery</a> <button class="btn waves-effect waves-light btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>');
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





function removed(id){
    var href = $(this).attr('href');
    var message = $(this).data('confirm');
    swal({
        title: "Are you sure delete this data ?",
        text: message, 
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        // ajax delete data to database
        var url ="{{url('dashboard/'.$controller.'/delete')}}";
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
                    $('#modal_form').modal('hide');

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
                console.log(url);
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
                <div class="table-responsive">
                    {{-- Form --}}
                    
                    @if(session('status'))
                        <div class="alert alert-success">
                            <button type="button" class="close" data-bs-dismiss="alert">
                                <i class="ace-icon fa fa-times"></i>
                            </button>
                            <h4 class="block">{{ __('main.success') }}</h4>
                            <p> {{ session('status') }}</p>
                        </div>
                    @endif



                    <table id="table-{{ $controller }}" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th width="10">No</th>
                                <th>Title</th>
                                <th>Kategori</th>
                                <th>Thumnail Images</th>
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
