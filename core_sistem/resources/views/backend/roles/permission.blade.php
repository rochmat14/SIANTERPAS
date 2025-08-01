@extends('layouts.template.app')
@section('sidebarActive', $controller)
@section('web_title', $title)
@section('page_header', $title)

@section('vendor_css')
@endsection

@section('css_scripts')
@endsection

@section('vendor_js')
@endsection

@section('js_scripts')
<script>
$(document).ready(function() {
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
        <svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 3L2 12h3v8h6v-6h2v6h6v-8h3L12 3zm5 15h-2v-6H9v6H7v-7.81l5-4.5 5 4.5V18z"/><path d="M7 10.19V18h2v-6h6v6h2v-7.81l-5-4.5z" opacity=".3"/></svg>
        <span class="breadcrumb-icon"> Home</span></a>
      </li>
      <li class="breadcrumb-item"><a href="#">Level Otorisasi</a></li>
      <li class="breadcrumb-item" aria-current="page"><a href="{{ route('roles.index') }}">{{ $title }}</a></li>
      <li class="breadcrumb-item active" aria-current="page">Permission Akses {{ $title }}</li>
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
        
        <form action="{{ route($controller.'.permission', $role->id) }}" method="POST">
          @csrf
          @method('PUT')
          
          <div class="form-body">
              <div class="row">
                  <div class="col-md-12">
                      <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                          <label for="name">Name</label>
                          <input type="text" name="name" id="name" value="{{ $role->name }}" class="form-control{{ $errors->has('name') ? ' form-control-danger' : '' }}" required readonly>
                      </div>
                  </div>
              </div>
      
              <div class="row">
                  <div class="col-md-12">
                      <div class="form-group{{ $errors->has('permissions') ? ' has-danger' : '' }}">
                          <label>Permissions</label>
                          <div class="col-md-9">
                              @if (count($permissions))
                                  @foreach ($permissions as $module => $modulePermissions)
                                      <div class="m-b-10">
                                          <strong>{{ strtoupper($module) }}</strong>
                                          <div class="">
                                              <div class="checkbox checkbox-success">
                                                  @foreach ($modulePermissions as $permission)
                                                      @php
                                                          $checked = in_array($permission->id, $rolePermission) ? true : false;
                                                      @endphp
                                                      
                                                      <input type="checkbox" name="permission[{{ $permission->id }}]" id="check-{{ $permission->id }}" value="1" {{ $checked ? 'checked' : '' }}>
                                                      <label for="check-{{ $permission->id }}">{{ $permission['operation'] }}</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                  @endforeach
                                              </div>
                                          </div>
                                      </div>
                                  @endforeach
                              @endif
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      
          <div class="form-actions">
              <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Save</button>
              <a href="{{ route($controller.'.index') }}" class="btn btn-inverse">Cancel</a>
          </div>
      </form>
      

      </div>
    </div>
    <!--/div-->

    
    
  </div>
</div>
@endsection
