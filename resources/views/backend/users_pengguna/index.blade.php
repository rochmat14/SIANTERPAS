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
            { data: 'fullname', name: 'fullname'},
            { data: 'email', name: 'email'},
            { data: 'role', name: 'role'},
            { data: 'status', name: 'status'},
            { data: null }
        ],

        "columnDefs": [
            {
                "targets": [ 0 ],
                "searchable": false,
                "sortable": false,
            },
            {
                "targets": [ 4 ],
                "searchable": false,
                "sortable": false,
            },
            {
                "targets": [ 5 ],
                "className": 'col-center',
                "searchable": false,
                "sortable": false,
                "render": function ( data, type, row ) {
                    var editUrl = row['editUrl'];
                    var showUrl = row['showUrl'];
                    var activatedUrl = row['activatedUrl'];
                    var activatedText = row['activatedText'];
                    var activatedIcon = row['activatedIcon'];
                    var id = row['id'];
                    var signature = row['signature'];
                    
                    if(row.signature == null) {
                        var btn_signature = `<a href='{{url('/')}}/dashboard/users_signature/create/${id}' class="badge bg-light" title="Tambah Signature">
                                <i class="fa fa-plus text-success"></i> Tambah Signature
                            </a>`
                    } else {
                        var btn_signature = `<a href='{{url('/')}}/dashboard/users_signature/edit/${id}' class="badge bg-light" title="Edit Signature">
                                <i class="fa fa-edit text-info"></i> Edit Signature
                            </a>`
                    }
                    return `
                        
                    
                        @if (auth()->user()->can('users-update'))
                            <a href='javascript:void(0)' class="badge bg-light" onclick=edited("${editUrl}") title="Edit">
                                <i class="fa fa-edit text-info"></i> Edit
                            </a>
                        @endif

                        @if (auth()->user()->can('users-show'))
                            <a class=" waves-effect waves-light badge bg-light" href="${showUrl}" title="View">
                                <i class="fa fa-eye"></i> View
                            </a>
                        @endif

                        @if (auth()->user()->can('users-activated'))
                            <form method="POST" action="${activatedUrl}" style="display:inline;">
                                {{ csrf_field() }}
                                <button type="submit" class="waves-effect waves-light badge bg-light">
                                    <i class="fa fa-${activatedIcon} text-danger"></i> ${activatedText}
                                </button>
                            </form>
                        @endif
                    `;                    
                }
            },               
        ],

        "dom": '<"custom-toolbar">frtip',
    });

    @if(auth()->user()->can('users-create'))
        $("div.custom-toolbar").html('<button class="btn btn-success waves-effect waves-light" onclick="add()"><i class="glyphicon glyphicon-plus"></i>Tambah User</button> <button class="btn waves-effect waves-light btn-light" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>');
    @endif
});


function reload_table() {
    table.ajax.reload(null, false); //reload datatable ajax 
}

// add 
function add() {
    // OPTION ROLES
    $.ajax({
        url: `{{url('/')}}/dashboard/roles/get-data-option`, //akses url
        tye: "get", //tipe method
        dataType: 'json', //jenis file yang juga di upload
        success: function(response) {
            console.log(response);
            var i;
            var no = 0;
            var html = "";
            for (i = 0; i < response.length; i++) {

                html = html + `<option value="${response[i].name}"> ${response[i].name}
            </option>`;
            }

            $("#role").html(
                '<option value="" disabled>-- Pilih Role --</option>' +
                html
            );
        }
    });
    // OPTION ROLES
    
    // document.getElementById("btnSave").disabled = true;
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('#photo-preview').hide();
    $('.modal-title').text('Tambah Users');
    $('select option').attr("selected",false);

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


//edited
function edited(id){
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#photo-preview').show(); 
    //Ajax Load data from ajax
    $.ajax({
        url : "{{ $controller }}/get_data/"+id,
        type: "GET",
        dataType: "JSON",
        // data: {"id":id},
        async: true,
        success: function(result)
        {
            // OPTION ROLES
            $.ajax({
                url: `{{url('/')}}/dashboard/roles/get-data-option`, //akses url
                tye: "get", //tipe method
                dataType: 'json', //jenis file yang juga di upload
                success: function(response) {
                    console.log(response);
                    var i;
                    var no = 0;
                    var html = "";
                    for (i = 0; i < response.length; i++) {

                        html = html + `<option value="${response[i].name}" ${response[i].name == result.roles ? 'selected' : ''}> ${response[i].name}
                    </option>`;
                    }

                    $("#role").html(
                        '<option value="" disabled>-- Pilih Role --</option>' +
                        html
                    );
                }
            });
            // OPTION ROLES
            
            //agent data
            console.log(result.roles);
            
            $('[name="id_users_desc"]').val(result.data_users.id);
            $('[name="nama_depan"]').val(result.data_users.nama_depan);
            $('[name="nama_belakang"]').val(result.data_users.nama_belakang);
            $('[name="telp"]').val(result.data_users.telp);
            $('[name="alamat_rumah"]').val(result.data_users.alamat_rumah);
            $('[name="tempat_lahir"]').val(result.data_users.tempat_lahir);
            $('[name="tanggal_lahir"]').val(result.data_users.tanggal_lahir);
            $('[name="tanggal_masuk"]').val(result.data_users.tanggal_masuk);
            

            $('input:radio[name="jenis_kelamin"]').filter('[value="'+result.data_users.jenis_kelamin+'"]').attr('checked', true);


            $('#role').val(result.roles);


            $('[name="id"]').val(result.data.id);
            $('[name="name"]').val(result.data.name);
            $('[name="email"]').val(result.data.email);

            // $('select option').attr("selected",false);
            // $.each(result.roles, function(i, item) {
            //     $('select option[value='+item+']').attr("selected",true);
            //     // alert(item);
            // });
            
            // $('select option[value="admin-web"]').attr("selected",true);


            // $('[name="role"]').val(result.roles.name);
            $('#modal_form').modal('show');
            $('.modal-title').text('Users Edit'); 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
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



<div class="row">
  <div class="col-12">
    <div class="card shadow-sm">
      <div class="card-header">
        <div class="card-title">{{ $title }}</div>
      </div>
      <div class="card-body">
        <div class="table-responsive">

        
            <div class="modal fade" id="modal_form" role="document" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog modal-md" role="document">
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
                                    <input type="hidden" value="" name="id_users_desc" id="id_users_desc" />


                                    <div class="alert alert-info text-center">
                                        <h5 class="mb-0">Form Data User</h5>
                                    </div>
                                    

                        
                                    <div class="form-group">
                                        <label for="nama_depan" class="control-label">Nama Depan</label>
                                        <input type="text" class="form-control" name="nama_depan" placeholder="Masukkan Nama Depan">
                                    </div>
                                    <div class="form-group">
                                        <label for="nama_belakang" class="control-label">Nama Belakang </label>
                                        <input type="text" class="form-control" name="nama_belakang" placeholder="Masukkan Nama Belakang" >
                                    </div>
                                        
                                    <div class="form-group">
                                        <label for="jenis_kelamin" class="control-label">Jenis Kelamin </label>
                                        
                                        <div class="radio">
                                          <label><input type="radio" id="pria" name="jenis_kelamin" value="pria" checked> &nbsp; &nbsp; Pria</label>
                                        </div>
                                        <div class="radio">
                                          <label><input type="radio" id="wanita" name="jenis_kelamin" value="wanita"> &nbsp; &nbsp; Wanita</label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="tanggal_masuk" class="control-label">Alamat Lengkap</label>
                                        <textarea placeholder="Alamat Rumah" name="alamat_rumah" class="form-control"></textarea>
                                    </div>
                                  
                                    <div class="form-group">
                                        <label for="telp" class="control-label">Telepon </label>
                                        <input type="text" class="form-control" name="telp" placeholder="08xxxxxxxxx">
                                    </div>

                                    


                                    {{-- Email --}}
                                    <div class="form-group">
                                        <label for="email" class="control-label text-right">E-Mail</label>
                                        <input type="email" id="email" name="email" value="{{ old('email') }}" required class="form-control{{ $errors->has('email') ? ' form-control-danger' : '' }}" placeholder="Email Users">
                                        @if ($errors->has('email')) 
                                            <small class="form-control-feedback">{{ $errors->first('email') }}</small>
                                        @endif
                                    </div>


                                    <div class="form-group">
                                        <label for="role" class="control-label">Role</label>

                                        <select class="form-control custom-select" name="role[]" id="role" data-height="100%">
                                            
                                            @foreach ($roles as $k => $v)
                                                <option value="{{ $v }}">{{ $v }}</option>
                                            @endforeach
                                            
                                        </select>

                                        @if ($errors->has('role'))
                                            <small class="form-control-feedback">{{ $errors->first('role') }}</small>
                                        @endif
                                    </div>



                                    <!-- Password -->
                                    <div class="form-group">
                                        <label for="password" class="control-label">Password</label>
                                        <input type="password" id="password" name="password" required class="form-control{{ $errors->has('password') ? ' form-control-danger' : '' }}" placeholder="Password">
                                        @if ($errors->has('password'))
                                            <small class="form-control-feedback">{{ $errors->first('password') }}</small>
                                        @endif
                                    </div>


                                    <small class="text-info">Jika Password tidak diisi, Maka default password : <b> <u> 123456789 </u> </b> </small>

                                    


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
            </div>
            </div>

            <div class="table-responsive">
                <table id="table-{{ $controller }}" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th width="10">No</th>
                            <th>Nama Lengkap</th>
                            <th>E-mail</th>
                            <th>Role User</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>

        </div>
      </div>
    </div>
    <!--/div-->

    
    
  </div>
</div>



{{-- Form  --}}


@endsection
