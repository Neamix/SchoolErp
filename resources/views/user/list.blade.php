@extends('layouts.master')
@section('css')

@section('title')
{{__('system.user_list')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-2"> {{ __('system.user_list') }}</h4>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row user-list">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics main-container h-100" load="user_list">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <form class="search_form">
                            <input type="search" placeholder="{{ __('system.enter_name') }}" class="form-control search-user">
                        </form>
                    </div>
                    <div class="col-md-3">
                        <form class="search-form">
                            <select class="form-control select_job">
                                <option value="1" selected>{{__('system.crew')}}</option>
                                <option value="2">{{__('system.teacher')}}</option>
                                <option value="3">{{__('system.student')}}</option>
                            </select>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <form class="active-form row h-100">
                            <div class="form-group d-flex align-items-center col-md-4 mb-0">
                                <input class="form-control w-25 active_user" name="active-state" type="radio" value="0" checked>
                                <label class="mb-0">{{ __('system.all_user') }}</label>
                            </div>
                            <div class="form-group d-flex col-md-4 mb-0 align-items-center">
                                <input class="form-control w-25  active_user" name="active-state" type="radio" value="1">
                                <label class="mb-0">{{ __('system.active_user') }}</label>
                            </div>
                            <div class="form-group d-flex col-md-4 align-items-center mb-0">
                                <input class="form-control w-25 active_user" name="active-state" type="radio" value="2">
                                <label class="mb-0">{{ __('system.suspended_user') }}</label>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="loader-container w-100 d-flex justify-content-center mt-4">
                    <div class="loader loader-big" data-load="user_list"></div>
                </div>
                <p class="empty_list mt-4 w-100 text-center">{{__('system.no_data_to_display')}}</p>
                <div class="row mt-4 users-list">
                   
                </div>
            </div>
            <ul class="pagination p-3">
               
            </ul>
            <input class="page-indicator" value="1" type="hidden">
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')
@include('js-blades.js-pagination')
@endsection
