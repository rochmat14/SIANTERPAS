@section('sidebarActive', $controller) @extends('layouts.template.app') @section('content')

<div class="page-header">
    <div class="page-leftheader">
        <h4 class="page-title">{{ $title }}</h4>
    </div>
    <div class="page-rightheader ml-auto d-lg-flex d-none">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard.index') }}" class="d-flex">
                    <svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path d="M12 3L2 12h3v8h6v-6h2v6h6v-8h3L12 3zm5 15h-2v-6H9v6H7v-7.81l5-4.5 5 4.5V18z" />
                        <path d="M7 10.19V18h2v-6h6v6h2v-7.81l-5-4.5z" opacity=".3" />
                    </svg>
                    <span class="breadcrumb-icon"> Home</span>
                </a>
            </li>
            <li class="breadcrumb-item"><a href="#">Profile</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
        </ol>
    </div>
</div>

<div class="row">
  <div class="col-xl-4 col-lg-5">
    <div class="card box-widget widget-user">
      <div class="widget-user-image mx-auto mt-5">
       <center>
         <img alt="User Avatar" class="w-50 rounded-circle" src="{{ $user->images != '' ? asset('/images/users/') . '/' . $user->images : asset('/images/users/no-user.jpg') }}">
       </center>
      </div>
      <div class="card-body text-center">
        <div class="pro-user">
          <h3 class="pro-user-username text-dark mb-1">{{ $user->name }}</h3>
          <h6 class="pro-user-desc text-muted">{{ $userRole }}</h6>
          
        </div>
      </div>

      <div class="card-footer p-0">
        <div class="row">
          <div class="col-sm-12 border-right text-center">
            <div class="description-block p-4">
              <form role="form" action="{{ route('profile.change_image') }}" method="post" enctype="multipart/form-data">
              {{ csrf_field() }}
                <div class="card-body">
                  <div class="form-group">
                      <label for="name" class="control-label">Ganti Photo <span class="required" aria-required="true"> * </span></label>
                      <input id="file" type="file" class="form-control" name="file" required>

                      @if ($errors->has('file'))
                          <span class="help-block">
                              <strong>{{ $errors->first('file') }}</strong>
                          </span>
                      @endif
                  </div>
                </div>
                <div class="card-footer text-right">
                  <button type="submit" class="btn btn-primary">Ganti Photo</button>
                </div>
              </form>

            </div>
          </div>
          
        </div>
      </div>

    </div>
    <div class="card shadow-sm">
      @if(session('status'))
          <br><br>
          <div class="alert alert-success">
              <button type="button" class="close" data-dismiss="alert">
                  <i class="ace-icon fa fa-times"></i>
              </button>
              <h6 class="block">Success</h6>
              <p> {{ session('status') }}</p>
          </div>
          
      @endif

      @if(session('error'))
          <br><br>
          <div class="alert alert-danger">
              <button type="button" class="close" data-dismiss="alert">
                  <i class="ace-icon fa fa-times"></i>
              </button>
              <h4 class="block">Error</h4>
              <p> {{ session('error') }}</p>
          </div>

      @endif

      @if (count($errors) > 0)
          <br><br>
          <div class="alert alert-danger">
              <button type="button" class="close" data-dismiss="alert">
                  <i class="ace-icon fa fa-times"></i>
              </button>
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif

      <form method="post" action="{{ route('profile.change_password') }}">
        {{ csrf_field() }}
        <div class="card-header">
          <div class="card-title">Edit Password</div>
        </div>
        <div class="card-body">
          <div class="form-group">
            <label class="form-label">Password Lama</label>
            <input type="password" class="form-control" name="current_password" placeholder="******">
          </div>
          <div class="form-group">
            <label class="form-label">Password Baru</label>
            <input type="password" class="form-control" name="password" placeholder="******">
          </div>
          <div class="form-group">
            <label class="form-label">Konfirmasi Password Baru</label>
            <input type="password" class="form-control" name="password_confirmation" placeholder="******">
          </div>
        </div>
        <div class="card-footer text-right">
          <button type="submit" class="btn btn-primary">Update</button>
          <button type="reset" class="btn btn-danger">Reset</button>
        </div>
      </form>
    </div>
  </div>
  <div class="col-xl-8 col-lg-7">
    <div class="card shadow-sm">

      @if(session('status_profile'))
          <br><br>
          <div class="alert alert-success">
              <button type="button" class="close" data-dismiss="alert">
                  <i class="ace-icon fa fa-times"></i>
              </button>
              <h6 class="block">Success</h6>
              <p> {{ session('status_profile') }}</p>
          </div>
          
      @endif

      <div class="card-header">
        <div class="card-title">Edit Profile</div>
      </div>
      <form method="post" action="{{ route('profile.change_profile') }}">
        {{ csrf_field() }}
        <div class="card-body">
          <input type="hidden" name="id_users_desc" value="{{ $users_desc->id }}">
          <div class="row">
            
            <div class="col-sm-6 col-md-6">
              <div class="form-group">
                <label class="form-label">Nama Depan</label>
                <input type="text" class="form-control" value="{{ $users_desc->nama_depan }}" name="nama_depan">
              </div>
            </div>
            <div class="col-sm-6 col-md-6">
              <div class="form-group">
                <label class="form-label">Nama Belakang</label>
                <input type="text" class="form-control" value="{{ $users_desc->nama_belakang }}" name="nama_belakang">
              </div>
            </div>
            {{-- <div class="col-sm-6 col-md-6">
              <div class="form-group">
                <label class="form-label">Tempat Lahir</label>
                <input type="text" class="form-control" value="{{ $users_desc->tempat_lahir }}" name="tempat_lahir">
              </div>
            </div>
            <div class="col-sm-6 col-md-6">
              <div class="form-group">
                <label class="form-label">Tanggal Lahir</label>
                <input type="date" class="form-control" value="{{ $users_desc->tanggal_lahir }}" name="tanggal_lahir">
              </div>
            </div> --}}
            <div class="col-md-12">
              <div class="form-group">
                <label class="form-label">Alamat Lengkap</label>
                <input type="text" class="form-control" value="{{ $users_desc->alamat_rumah }}" name="alamat_rumah">
              </div>
            </div>
            <div class="col-sm-6 col-md-4">
              <div class="form-group">
                <label class="form-label">Email</label>
                <input type="text" class="form-control" value="{{ $user->email }}" name="email" readonly>
              </div>
            </div>
            <div class="col-sm-6 col-md-4">
              <div class="form-group">
                <label class="form-label">Telepon</label>
                <input type="text" class="form-control" value="{{ $users_desc->phone }}" name="telp">
              </div>
            </div>

            <div class="col-sm-6 col-md-4">
              <div class="form-group">
                <label class="form-label">Jenis Kelamin</label>                            
                <div class="radio">
                  <label><input type="radio" id="pria" name="jenis_kelamin" value="pria" 
                    
                    {{ $users_desc->jenis_kelamin =='pria' ? 'checked' : '' }}
                    > &nbsp; &nbsp; Pria</label>
                </div>
                <div class="radio">
                  <label><input type="radio" id="wanita" name="jenis_kelamin" value="wanita"
                    {{ $users_desc->jenis_kelamin =='wanita' ? 'checked' : '' }}
                    > &nbsp; &nbsp; Wanita</label>
                </div>

              </div>
            </div>

            
            <div class="col-sm-12 col-md-12">
                <div class="form-group">
                  <label class="form-label">Tanggal Masuk</label>
                  <input type="date" class="form-control" value="{{ date('Y-m-d', strtotime($users_desc->created_at)) }}" readonly>
                </div>
              </div>
          </div>


          
        </div>
        <div class="card-footer text-right">
          <button type="submit" class="btn btn-lg btn-primary">Update</button>
          <button type="reset" class="btn btn-lg btn-danger">Reset</button>
        </div>
      </form>
    </div>
  </div>
</div>



@endsection
