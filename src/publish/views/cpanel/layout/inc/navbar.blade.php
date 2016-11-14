
    <body class="page-header-fixed page-content-white page-footer-fixed page-sidebar-fixed page-sidebar-closed-hide-logo page-content-white">
    <div id="sound"></div>
        <!-- BEGIN HEADER -->
<div class="loading-overlay">
    <div class="spinner">
      <div class="bounce1"></div>
      <div class="bounce2"></div>
      <div class="bounce3"></div>
    </div>
</div>
        <div class="page-header navbar navbar-fixed-top">
            <!-- BEGIN HEADER INNER -->
            <div class="page-header-inner ">
                <!-- BEGIN LOGO -->
                <div class="page-logo">
                    <a href="{{ url('/') }}" target="_blank">
                        <img src="{{$logo}}" alt="logo" height="20" class="logo-default" /> </a>
                    <div class="menu-toggler sidebar-toggler"> </div>
                </div>
                <!-- END LOGO -->
                <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
                <!-- END RESPONSIVE MENU TOGGLER -->
                <!-- BEGIN TOP NAVIGATION MENU -->
                <div class="top-menu">
                    <ul class="nav navbar-nav pull-right">

                        <li class="dropdown dropdown-extended dropdown-notification dropdown-dark" id="header_inbox_bar">
                            <a href="javascript:;" class="dropdown-toggle notfication-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                <i class="icon-bell"></i>
@if (auth()->user()->rule == 'admin')
    @php
        $countNotfication = auth()->user()->adminNotfications()->where('check',0)->count();
    @endphp
@else
    @php
        $countNotfication = auth()->user()->importNotfications()->where('check',0)->count();
    @endphp
@endif
<span class="badge badge-default notfication-count">{{ $countNotfication > 0 ? $countNotfication :'' }}</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="external">
                                    <h3>{{ trans('lang.notfications') }}</h3>
                                    <a href="javascript:;" class="read_all">{{ trans('lang.read_all') }}</a>
                                </li>
                                <li>
                                    <ul class="dropdown-menu-list scroller  notfication-ul" style="height: 275px;" data-handle-color="#637283">
                                    
                                    @include('helpers.ajax.notfication.navbar')
                                    </ul>
                                </li>
                            </ul>
                        </li>
               
                        <li class="dropdown dropdown-user dropdown-dark">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                <img alt="" class="img-circle" src="{{ auth()->user()->img('sm') }}" />
                                <span class="username username-hide-on-mobile">{{ user('name') }}
                                ( {{ trans('lang.'.ucfirst(user('rule'))) }} ) </span>
                                <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-default">
                                <li>
                                    <a href="{{ url(cp.'profile') }}">
                                        <i class="icon-user"></i> {{ trans('lang.edit_profile') }} </a>
                                </li>
                                <li class="divider"> </li>
                                <li>
                                    <a href="{{ url('logout') }}">
                                        <i class="icon-key"></i> {{ trans('lang.logout') }} </a>
                                </li>
                            </ul>
                        </li>
                        <!-- END USER LOGIN DROPDOWN -->
                        <!-- BEGIN LANGUAGE BAR -->
                        <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                        <li class="dropdown dropdown-language dropdown-dark">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                <img alt="" src="{{ currentLang('flug') }}">
                                <span class="langname"> {{ currentLang('name') }} </span>
                                <i class="fa fa-angle-down"></i>
                            </a>
                            
                            <ul class="dropdown-menu dropdown-menu-default">
                            @foreach (languages() as $lang)
                                <li>
                                    <a href="{{ $lang['url'] }}">
                                        <img alt="" src="{{ $lang['flug'] }}">{{ $lang['name'] }} </a>
                                </li>
                            @endforeach

                            </ul>
                        </li>
                        <!-- END LANGUAGE BAR -->
                    </ul>
                </div>
                <!-- END TOP NAVIGATION MENU -->
            </div>
            <!-- END HEADER INNER -->
        </div>
        <!-- END HEADER -->

        <!-- BEGIN HEADER & CONTENT DIVIDER -->
        <div class="clearfix"> </div>
        <!-- END HEADER & CONTENT DIVIDER -->
        <!-- BEGIN CONTAINER -->
        <div class="page-container">
            <!-- BEGIN SIDEBAR -->
            <div class="page-sidebar-wrapper">
                <!-- BEGIN SIDEBAR -->
                <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                <div class="page-sidebar navbar-collapse collapse">
                    <!-- BEGIN SIDEBAR MENU -->
                    <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
                        <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
                        <li class="sidebar-toggler-wrapper hide">
                            <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                            <div class="sidebar-toggler"> </div>
                            <!-- END SIDEBAR TOGGLER BUTTON -->
                        </li>
                        <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
  