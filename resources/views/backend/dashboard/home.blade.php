@section('sidebarActive', $controller)
@extends('layouts.template.app')
@section('content')
<div class="page-header">
    <div class="page-leftheader">
        <h4 class="page-title">Dashboard</h4>
    </div>
    <div class="page-rightheader ms-auto d-lg-flex d-none">
    </div>
</div>
<!--End Page header-->
<div class="row">
    <div class="col-xl-8 col-md-12 col-lg-12">
        <div class="row">
            <div class="col-xl-12 col-md-12 col-lg-12">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-7 col-md-12 col-lg-6">
                                <div class="d-block card-header border-0 text-center px-0">
                                    <h3 class="text-center mb-4">{!! AppSeting('app_name') !!}</h3>
                                    <h4>{!! AppSeting('office_address') !!}</h4>
                                </div>
                                <div class="row text-center">
                                    <div class="col-md-12">
                                        <h5 class="mt-4 text-white-50">{!! AppSeting('app_desc') !!}</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-5 col-md-12 col-lg-6">
                                <img class="mx-auto text-center w-90" alt="img" src="{{ url('/images/logo') }}/{{ AppSeting('future_image') }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-4 col-md-12 col-lg-6">
        <div class="card">
            <div class="card-body">
                <div class="card-header">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <tbody>
                                <tr>
                                    <td class="py-2 px-2" colspan="2">
                                        <div class="text-center">
                                            <img src="{!! $user_param['image'] !!}" class="rounded-pill" style="width:100px;">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-2 px-2">
                                        <span class="font-weight-semibold w-50">Nama Operator </span>
                                    </td>
                                    <td class="py-2 px-2">: {!! $user_param['nama_user'] !!}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 px-2">
                                        <span class="font-weight-semibold w-50">Jabatan </span>
                                    </td>
                                    <td class="py-2 px-2">: {!! $user_param['jabatan'] !!}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 px-2">
                                        <span class="font-weight-semibold w-50">Last Login </span>
                                    </td>
                                    <td class="py-2 px-2">: {!! $user_param['last_login'] !!}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 px-2">
                                        <span class="font-weight-semibold w-50">Email </span>
                                    </td>
                                    <td class="py-2 px-2">: {!! $user_param['email'] !!}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>
@endsection
