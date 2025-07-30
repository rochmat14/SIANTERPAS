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

<script src="{{ $assets }}/js/jquery-ui/jquery-ui.min.js"></script>
<!-- quill js -->
<script src="{{ $assets }}/plugins/quill/quill.min.js"></script>
<script src="https://cdn.rawgit.com/kensnyder/quill-image-resize-module/3411c9a7/image-resize.min.js"></script>
<script src="{{$assets}}/js/sweetalert.min.js"></script>
@endsection
@section('js_scripts')

<script type="text/javascript">
    var table="";
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
            table = $('#table-fasilitas_gallery').DataTable({
            processing: true,
            serverSide: true,
            order: [[ 2, 'asc' ]],
            ajax: {
                "url": "{{ route('fasilitas_gallery.getData', [ 'id_gallery'=> $data_gallery->id ]) }}",
                "type": "POST"
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: null }
            ],

            "columnDefs": [
                {
                    "targets": [ 0 ],
                    "searchable": false,
                    "sortable": false,
                },
                {
                    "targets": [ 1 ],
                    "className": 'col-center',
                    "searchable": false,
                    "sortable": false,
                    "render": function ( data, type, row ) {
                        var fasilitas_gallery = row['fasilitas_gallery'];
                        return `
                                <img style="width:100px;" src="{{ asset('/images/fasilitas_gallery/') }}/${fasilitas_gallery}">
                        `;  
                    }
                },  
                {
                    "targets": [ 2 ],
                    "className": 'col-center',
                    "searchable": false,
                    "sortable": false,
                    "render": function ( data, type, row ) {
                        var deleteUrl = row['deleteUrl'];

                        return `
                            @if (auth()->user()->can($controller.'-delete'))

                                <a href='javascript:void(0)' class="badge bg-light" onclick=removed("${deleteUrl}") title="Delete">
                                    <i class="fa fa-edit text-danger"></i> Delete Images
                                </a>
                            @endif
                            
                        `;  
                    }
                },               
            ],

            "dom": '<"custom-toolbar">frtip',
        });

        @if(auth()->user()->can($controller.'-create'))
            $("div.custom-toolbar").html('<a class="btn btn-success waves-effect waves-light" onclick="add()"><i class="glyphicon glyphicon-plus"></i>Upload Fasilitas Gallery</a> <a class="btn waves-effect waves-light btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</a>');
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


    // add 
    function add() {
        // document.getElementById("btnSave").disabled = true;
        save_method = 'add';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        $('#modal_form').modal('show'); // show bootstrap modal
        $('#photo-preview').hide();
        $('.modal-title').text('Add Images');
        // event.preventDefault();
    }

    //saving
    function save(){
        $('#btnSave').text('saving...'); //change button text
        $('#btnSave').attr('disabled',true); //set button disable 
        event.preventDefault();
        var url;
        var pesan;

        if(save_method == 'add') {
            url ="{{url('dashboard/fasilitas_gallery/save')}}";
            pesan ='Success Add Data';
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
            var url ="{{url('dashboard/fasilitas_gallery/delete')}}";
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

<script>

{{-- text editor --}}
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
var quill = new Quill('#description', {
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
    document.querySelector("input[name='description']").value = quill.root.innerHTML;
});

</script>
@endsection
@section('content')

<div class="modal" id="modal_form" role="document" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h3 class="modal-title"></h3>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form" method="post" class="form-horizontal" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    
                    <div class="form-group">
                        <input type="hidden" value="" name="id" id="id" />
                        <input type="hidden" value="{{ $data_gallery->id }}" name="id_gallery" id="id_gallery" />
                        <label for="fasilitas_gallery" class="control-label">Image:</label>
                        <input type="file" class="form-control" id="fasilitas_gallery" name="fasilitas_gallery" placeholder="fasilitas gallery">
                        <p><i>Upload Image Rekomendasi Ukuran 1080 x 1080 px</i></p>
                    </div>
                </form>
            </div>
            
            <div class="modal-footer">
                <button type="submit" id="btnSave" onclick="save()" class="btn btn-primary">Upload</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

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
            <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('gallery.index') }}">{{ $title }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit</li>
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
                <div class="panel panel-primary">
                    <div class="panel-body tabs-menu-body">
                        @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Sorry!</strong> There were more problems with your HTML input.<br><br>
                            <ul>
                              @foreach ($errors->all() as $error)
                                  <li>{{ $error }}</li>
                              @endforeach
                            </ul>
                        </div>
                        @endif
                        <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="tab-content">
                                    <div class="form-group">
                                        <label for="title"  class="control-label col-lg-2">Kategori<span class="required">*</span></label>
                                        <div class="col-lg-12">
                                            <select name="category" class="form-control" required>
                                                <option value="gallery" {!! $data_gallery->category == 'gallery' ? 'selected' : '' !!}>Gallery - Kegiatan</option>
                                                <option value="portfolio" {!! $data_gallery->category == 'portfolio' ? 'selected' : '' !!}>Portfolio</option>
                                                <option value="layanan" {!! $data_gallery->category == 'layanan' ? 'selected' : '' !!}>Layanan</option>
                                                <option value="karir" {!! $data_gallery->category == 'karir' ? 'selected' : '' !!}>Karir</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="title"  class="control-label col-lg-2">Judul / Title<span class="required">*</span></label>
                                        <div class="col-lg-12">
                                            <input type="hidden" value="{{ $data_gallery->id }}" name="id">
                                            <input type="text" class="form-control" value="{{ $data_gallery->title }}" required="" name="title" placeholder="Title...">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="description"  class="control-label col-lg-2">{{ __('main.description') }} <span class="required">*</span></label>

                                        <input type="hidden" name="description" value="{!! $data_gallery->description !!}">
                                        <div class="col-lg-12">
                                            <div style="height: 100%;" id="description">{!! $data_gallery->description !!}</div>
                                        </div>


                                    </div>
                                    <div class="form-group">
                                        <label for="photo"  class="control-label col-lg-12">Old Images <span class="required">*</span></label>
                                        <div class="col-lg-12">
                                            <img src="{{ url('images/gallery') }}/{{ $data_gallery->file_image }}" style="width: 200px;">
                                            
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="photo"  class="control-label col-lg-12">Change File Thumbnail Images <span class="required">*</span></label>
                                        <div class="col-lg-12">
                                            <input type="file" class="form-control" name="file_image">
                                            <p><i>Upload Image Rekomendasi Ukuran 1080 x 1080 px</i></p>
                                        </div>
                                    </div>
                                    <hr>
                                    <table id="table-fasilitas_gallery" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th width="10">No</th>
                                                <th>File Images</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                    <hr>
                                    <div class="form-group">
                                      <input type="submit" class="btn btn-info" value="Update Gallery">
                                      <a href="{{ route('gallery.index') }}" class="btn btn-secondary">Back</a>
                                    </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--/div-->
    </div>
</div>
{{-- Form --}}
@endsection
