<div class="container-fluid">
    <div class="row">
        <!-- Left Sidebar start-->
        <div class="side-menu-fixed">
            <div class="scrollbar side-menu-bg">
                <ul class="nav navbar-nav side-menu" id="sidebarnav">
                    <!-- menu item Dashboard-->
                    @can('viewDashboard', Auth::user())
                    <li>
                        <a href="/">
                            <div class="pull-left"><i class="ti-home"></i><span class="right-nav-text">{{ __('system.dashboard') }}</span>
                            </div>
                            <div class="clearfix"></div>
                        </a>
                    </li>
                    @endcan
                    <!-- menu title -->
                    <!-- menu item Elements-->
                    @canany(['editUser', 'viewAny'], Auth::user())
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#elements">
                            <div class="pull-left"><i class="ti-palette"></i><span
                                    class="right-nav-text">{{ __('system.users') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                            <ul id="elements" class="collapse" data-parent="#sidebarnav">
                                @can('editUser',Auth::user())
                                <li><a href="{{ route('user.index') }}">{{ __('system.create_user')  }}</a></li>
                                @endcan
                                @can('viewAny',Auth::user())
                                <li><a href="{{ route('user.list') }}">{{ __('system.user_list')  }}</a></li>
                                @endcan
                            </ul>    
                    </li>
                    @endcanany
                    @canany(['trash-user','trash-course'], Auth::user())
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#trash">
                            <div class="pull-left"><i class="ti-trash"></i><span
                                    class="right-nav-text">{{ __('system.trash_bin') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="trash" class="collapse" data-parent="#sidebarnav">
                            @can('trash-user',Auth::user())
                            <li><a href="{{ route('trash',['model'=>'user']) }}">{{ __('system.user_list')  }}</a></li>
                            @endcan
                            @can('trash-course',Auth::user())
                            <li><a href="{{ route('trash',['model'=>'course']) }}">{{ __('system.courses_list')  }}</a></li>
                            @endcan
                        </ul>    
                    </li>
                    @endcanany
                    @canany(['view-course', 'upsert-course'], Auth::user())
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#subject">
                            <div class="pull-left"><i class="ti-palette"></i><span
                                    class="right-nav-text">{{ __('system.subjects') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="subject" class="collapse" data-parent="#sidebarnav">
                            @can('upsert-course', Auth::user())
                            <li><a href="{{ route('course.index') }}">{{ __('system.create_course')  }}</a></li>
                            @endcan
                            @can('view-course',Auth::user())
                            <li><a href="{{ route('course.list') }}">{{ __('system.course_list')  }}</a></li>
                            @endcan
                        </ul>
                    </li>
                    @endcanany
                    <!-- menu item schedule-->
                    @can('view-course')
                    <li>
                        <a href="{{ route('course.schedule') }}" data-target="#calendar-menu">
                            <div class="pull-left"><i class="ti-calendar"></i><span
                                    class="right-nav-text">{{ __('system.schedule') }}</span></div>
                            <div class="clearfix"></div>
                        </a>

                    </li>
                    @endcan
                    <li>
                        <a href="{{ route('user.myprofile') }}" data-target="#calendar-menu">
                            <div class="pull-left"><i class="ti-calendar"></i><span
                                    class="right-nav-text">{{ __('system.profile') }}</span></div>
                            <div class="clearfix"></div>
                        </a>

                    </li>
                </ul>
            </div>
        </div>

        <!-- Left Sidebar End-->

        <!--=================================
