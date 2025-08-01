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

        // data layanan informasi
        $(function() {
            table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route($controller.'.getData') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'nomor_urut',
                        name: 'nomor_urut'
                    },
                    {
                        data: 'audio',
                        name: 'audio'
                    },
                    {
                        "render": function(data, type, row) {
                            var id = row['id'];

                            var btn_edit = `
                                <a href="javascript:void(0)" 
                                    class="delete btn btn-info btn-sm" 
                                    onclick=edited("${id}")>
                                        <i class="fa fa-edit" style="font-size:15px"> </i>
                                        Edit
                                </a>
                            `;

                            var btn_delete = `
                                <a href="javascript:void(0)" 
                                    class="delete btn btn-danger btn-sm" 
                                    onclick=removed("${id}")>
                                        <i class="fa fa-trash" style="font-size:15px"> </i>
                                        Delete
                                </a>
                            `;

                            return `
                                ${btn_edit}
                                ${btn_delete}
                            `;
                        }
                    },
                ]
            });

            $(".reload").click(function() {
                table.ajax.reload(null, false);
            });
        });
        // data layanan informasi

        // reload table data
        function reload_table() {
            table.ajax.reload(null, false); //reload datatable ajax 
        }
        
        // actiion button add 
        function closeModalAdd() {
            const myModal = bootstrap.Modal.getInstance(document.getElementById('modal_tambah'));
            myModal.hide();
        }

        function add() {
            $('#modal_tambah').modal('show'); // show bootstrap modal

            $("#nomor_urut").val('');;
        }
        // actiion button add 

        // action button create data
        $("#submit_tambah").submit(function(e) {
            e.preventDefault();
            
            if($("#nomor_urut").val() == '') {
                iziToast.warning({
                    title: 'Warning !',
                    message: 'Nomor Urut Tidak Boleh Kosong',
                    position: 'topRight'
                });
            } else if($("#audio").val() == '') {
                iziToast.warning({
                    title: 'Warning !',
                    message: 'Audio Tidak Boleh Kosong',
                    position: 'topRight'
                });
            } else {
            
                $.ajax({
                    url : "{{url('dashboard/'.$controller.'/create')}}",
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    dataType: "JSON",
                    success: function(respose)
                    {
                        $('#modal_tambah').modal('hide');
                        iziToast.success({
                            title: 'OK',
                            position: 'center',
                            message: 'Berhasil Menambah Data',
                        });
                      
                        reload_table()
                        // window.location.reload();
                    },
                    error: function (error)
                    {   
                    iziToast.error({
                        title: 'ERROR !',
                        message: 'Terjadi Kesalah Pada Server',
                        position: 'topRight'
                    });
                    }
                });
            }
        });
    
        // action close modal edit
    function closeModalEdit() {
        const myModal = bootstrap.Modal.getInstance(document.getElementById('modal_edit'));
        myModal.hide();
    }

    //show modal edit
    function edited(id){
        $.ajax({
            url : "{{url('dashboard/'.$controller.'/get_data/id')}}",
            type: "GET",
            dataType: "JSON",
            data: {"id":id},
            async: true,
            success: function(result)
            {
                let part = result.data.nomor_urut.slice(1)

                $("#id").val(result.data.id);
                $('[name="nomor_urut"]').val(part);

                $('#modal_edit').modal('show');
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }

    // action button edit
    $("#submit_edit").submit(function(e) {
        e.preventDefault();

        if($("#nomor_urut").val() == '') {
            iziToast.error({
                title: 'ERROR !',
                message: 'Posisi Tidak Boleh Kosong',
                position: 'topRight'
            });
        } else {
        
            $.ajax({
                url : "{{url('dashboard/'.$controller.'/update')}}",
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: new FormData(this),
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function(respose)
                {
                    $('#modal_edit').modal('hide');
                    iziToast.success({
                        title: 'OK',
                        position: 'center',
                        message: 'Berhasil Mengubah Data',
                    });
                    reload_table();
                },
                error: function (error)
                {   
                iziToast.error({
                    title: 'ERROR !',
                    message: 'Terjadi Kesalah Pada Server',
                    position: 'topRight'
                });
                }
            });
        }
    });

    // action button delete
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
          <svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 3L2 12h3v8h6v-6h2v6h6v-8h3L12 3zm5 15h-2v-6H9v6H7v-7.81l5-4.5 5 4.5V18z"/><path d="M7 10.19V18h2v-6h6v6h2v-7.81l-5-4.5z" opacity=".3"/></svg>
          <span class="breadcrumb-icon"> Home</span></a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
      </ol>
    </div>
  </div>


  <!-- table data -->
  <div class="row">
    <div class="col-12">
      <div class="card shadow-sm">
        <div class="card-header">
          <div class="card-title">{{ $title }}</div>
        </div>
        <div class="card-body">
          <div class="table-responsive">


          {{-- Form  --}}
          <button class="btn btn-success waves-effect waves-light mb-5" onclick="add()">
              <i class="glyphicon glyphicon-plus"></i> Tambah
          </button>


          <!-- Start Form Tambah -->
          <div class="modal fade" id="modal_tambah" role="document" data-backdrop="static" data-keyboard="false">
              <div class="modal-dialog" role="document">
                  <div class="modal-content modal-content-demo">
                      <form id="submit_tambah" class="form-horizontal" enctype="multipart/form-data">
                      <div class="modal-header">
                          <h3 class="modal-title">Tambah {{ $title }}</h3>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="closeModalAdd()"><span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <div class="modal-body">
                          
                              {{ csrf_field() }}
                              <div class="form-group">
                                  <label for="nomor_urut" 
                                      class="control-label">Nomor Urut:</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">P</span>
                                    <input type="number" 
                                        class="form-control" 
                                        id="nomor_urut" 
                                        name="nomor_urut" 
                                        placeholder="Nomor Urut">
                                </div>
                              </div>

                              <div class="form-group">
                                  <label for="audio" 
                                      class="control-label">Audio :</label>

                                  <input type="file" 
                                      class="form-control" 
                                      id="audio" 
                                      name="audio"
                                      accept=".mp3">
                              </div>
                      </div>
      
                      <div class="modal-footer">
                          <button type="submit" id="btnSave" class="btn btn-primary">
                            <i class="fa fa-save"></i> Save</button>
                          <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="closeModalAdd()">
                            <i class="fa fa-close"></i> Cancel</button>
                      </div>
                      </form>
                  </div>
                  <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
          </div>
          <!-- Start Form Tambah -->

          <!-- Start Modal Edit -->
            <div class="modal fade" id="modal_edit" role="document" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog" role="document">
                    <div class="modal-content modal-content-demo">
                        <form id="submit_edit" class="form-horizontal" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h3 class="modal-title">Edit {{ $title }}</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="closeModalEdit()"><span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            
                                {{ csrf_field() }}
                                <div class="form-group" hidden>
                                    <label for="id" 
                                        class="control-label">ID:</label>

                                    <input type="text" 
                                        class="form-control" 
                                        name="id" 
                                        id="id">
                                </div>
                                
                                <div class="form-group">
                                    <label for="nomor_urut" 
                                        class="control-label">Nomor Urut:</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">P</span>
                                        <input type="number" 
                                            class="form-control" 
                                            id="nomor_urut"
                                            name="nomor_urut" 
                                            placeholder="Nomor Urut">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="audio" 
                                        class="control-label">Audio :</label>

                                    <input type="file" 
                                        class="form-control" 
                                        id="audio" 
                                        name="audio"
                                        accept=".mp3">
                                </div>
                            
                        </div>
                        
                        <div class="modal-footer">
                            <button type="submit" id="btnSave" class="btn btn-primary">
                                <i class="fa fa-save"></i> Save</button>
                            <button type="button" class="btn btn-danger" onclick=closeModalEdit()>
                                <i class="fa fa-close"></i> Cancel</button>
                        </div>
                        </form>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
          
              <table class="display nowrap table table-hover table-striped table-bordered data-table" cellspacing="0" width="100%">
                  <thead>
                      <tr>
                          <th width="10">No</th>
                          <th width="20">Nomor Urut</th>
                          <th>Audio</th>
                          <th>Action</th>
                      </tr>
                  </thead>
                  <tbody></tbody>
              </table>
          </div>
        </div>
      </div>    
    </div>
  </div>

@endsection