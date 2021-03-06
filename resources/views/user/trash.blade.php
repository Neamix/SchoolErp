@extends('layouts.master')
@section('css')

@section('title')
{{ __('system.trash_bin') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-3"> {{ __('system.trash_bin') }} </h4>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <table id="datatable" class="table datatable  table-hover table-sm table-bordered p-0" data-page-length="50" style="text-align: center">
                    <thead>
                    <tr class="alert-success">
                        <th>#</th>
                        <th>{{__('system.name')}}</th>
                        <th>{{__('system.email')}}</th>
                        <th>{{__('system.operation')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td class="d-flex justify-content-center">
                                <ul class="operation d-flex nav">
                                    @can('delete-user',Auth::user())
                                    <li class="nav-item ml-2 mr-2 cursor-pointer password_confirm_need" data-target="#confirmPassword" data-toggle="modal" data-url="{{ route('user.force',['user'=>$user->id]) }}" redirect="{{ route('trash',['model'=>'user']) }}"><i class="ti-na"></i></li>
                                    @endcan
                                    @can('trash-user')
                                    <li class="nav-item ml-2 mr-2 cursor-pointer password_confirm_need" data-target="#confirmPassword" data-toggle="modal" data-url="{{ route('user.restore',['user'=>$user->id]) }}" redirect="{{ route('trash',['model'=>'user']) }}"><i class="ti-back-right mr-2 ml-2"></i></li>
                                    @endcan
                                </ul>
                            </td>                
                            </tr>
                        @endforeach
                        <tr class="@if(count($users)) d-none @endif">
                            <td colspan="5">{{__('system.no_data_to_display')}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
