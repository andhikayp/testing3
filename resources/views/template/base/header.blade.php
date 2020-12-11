<!-- Header -->
<header id="page-header">
    <!-- Header Content -->
    <div class="content-header">
        <!-- Left Section -->
        <div class="content-header-section">
            <!-- Toggle Sidebar -->
            <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
            <button type="button" class="btn btn-circle btn-dual-secondary" data-toggle="layout" data-action="sidebar_toggle">
                <i class="fa fa-navicon"></i>
            </button>
            <!-- END Toggle Sidebar -->

            <!-- Open Search Section -->
            <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
            <!-- END Open Search Section -->

            <!-- Layout Options (used just for demonstration) -->
            <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-circle btn-dual-secondary" id="page-header-options-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-wrench"></i>
                </button>
                <div class="dropdown-menu min-width-300" aria-labelledby="page-header-options-dropdown">
                    <h5 class="h6 text-center py-10 mb-10 border-b text-uppercase">Settings</h5>
                    <h6 class="dropdown-header">Color Themes</h6>
                    <div class="row no-gutters text-center mb-5">
                        <div class="col-2 mb-5">
                            <a class="text-default" data-toggle="theme" data-theme="default" href="javascript:void(0)">
                                <i class="fa fa-2x fa-circle"></i>
                            </a>
                        </div>
                        <div class="col-2 mb-5">
                            <a class="text-elegance" data-toggle="theme" data-theme="{{ asset('codebase/src/assets/css/themes/elegance.min.css')}}" href="javascript:void(0)">
                                <i class="fa fa-2x fa-circle"></i>
                            </a>
                        </div>
                        <div class="col-2 mb-5">
                            <a class="text-pulse" data-toggle="theme" data-theme="{{ asset('codebase/src/assets/css/themes/pulse.min.css')}}" href="javascript:void(0)">
                                <i class="fa fa-2x fa-circle"></i>
                            </a>
                        </div>
                        <div class="col-2 mb-5">
                            <a class="text-flat" data-toggle="theme" data-theme="{{ asset('codebase/src/assets/css/themes/flat.min.css')}}" href="javascript:void(0)">
                                <i class="fa fa-2x fa-circle"></i>
                            </a>
                        </div>
                        <div class="col-2 mb-5">
                            <a class="text-corporate" data-toggle="theme" data-theme="{{ asset('codebase/src/assets/css/themes/corporate.min.css')}}" href="javascript:void(0)">
                                <i class="fa fa-2x fa-circle"></i>
                            </a>
                        </div>
                        <div class="col-2 mb-5">
                            <a class="text-earth" data-toggle="theme" data-theme="{{ asset('codebase/src/assets/css/themes/earth.min.css')}}" href="javascript:void(0)">
                                <i class="fa fa-2x fa-circle"></i>
                            </a>
                        </div>
                    </div>
                    <h6 class="dropdown-header">Header</h6>
                    <div class="row gutters-tiny text-center mb-5">
                        <div class="col-6">
                            <button type="button" class="btn btn-sm btn-block btn-alt-secondary" data-toggle="layout" data-action="header_fixed_toggle">Fixed Mode</button>
                        </div>
                        <div class="col-6">
                            <button type="button" class="btn btn-sm btn-block btn-alt-secondary d-none d-lg-block mb-10" data-toggle="layout" data-action="header_style_classic">Classic Style</button>
                        </div>
                    </div>
                    <h6 class="dropdown-header">Sidebar</h6>
                    <div class="row gutters-tiny text-center mb-5">
                        <div class="col-6">
                            <button type="button" class="btn btn-sm btn-block btn-alt-secondary mb-10" data-toggle="layout" data-action="sidebar_style_inverse_off">Light</button>
                        </div>
                        <div class="col-6">
                            <button type="button" class="btn btn-sm btn-block btn-alt-secondary mb-10" data-toggle="layout" data-action="sidebar_style_inverse_on">Dark</button>
                        </div>
                    </div>
                    <div class="d-none d-xl-block">
                        <h6 class="dropdown-header">Main Content</h6>
                        <button type="button" class="btn btn-sm btn-block btn-alt-secondary mb-10" data-toggle="layout" data-action="content_layout_toggle">Toggle Layout</button>
                    </div>
                    <div class="dropdown-divider"></div>
                </div>
            </div>
            <!-- END Layout Options -->
        </div>
        <!-- END Left Section -->

        <!-- Right Section -->
        <div class="content-header-section">
            <!-- User Dropdown -->
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-rounded btn-dual-secondary" id="page-header-user-dropdown">
                    <a id="waktu" href="#"><span class="d-none d-sm-inline-block" id="date-widget"></span> |
                    <span id="clock-widget"></span></a>  
                </button>
                <button type="button" class="btn btn-rounded btn-dual-secondary" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-user d-sm-none"></i>
                    <span class="d-none d-sm-inline-block">{{ Auth::user()->nama }}</span>
                    <i class="fa fa-angle-down ml-5"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right min-width-200" aria-labelledby="page-header-user-dropdown">
                    <h5 class="h6 text-center py-10 mb-5 border-b text-uppercase">User</h5>
                    <a class="dropdown-item" href="be_pages_generic_profile.html">
                        <i class="si si-user mr-5"></i> Profile
                    </a>

                    <!-- Toggle Side Overlay -->
                    <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                    <a class="dropdown-item" href="javascript:void(0)" data-toggle="layout" data-action="side_overlay_toggle">
                        <i class="si si-wrench mr-5"></i> Settings
                    </a>
                    <!-- END Side Overlay -->

                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{url('/logout')}}">
                        <i class="si si-logout mr-5"></i> Sign Out
                    </a>
                </div>
            </div>
            <!-- END User Dropdown -->

            <!-- Toggle Side Overlay -->
            <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
            <button type="button" class="btn btn-circle btn-dual-secondary" data-toggle="layout" data-action="side_overlay_toggle">
                <i class="fa fa-tasks"></i>
            </button>
            <!-- END Toggle Side Overlay -->
        </div>
        <!-- END Right Section -->
    </div>
    <!-- END Header Content -->

    <!-- Header Loader -->
    <!-- Please check out the Activity page under Elements category to see examples of showing/hiding it -->
    <div id="page-header-loader" class="overlay-header bg-primary">
        <div class="content-header content-header-fullrow text-center">
            <div class="content-header-item">
                <i class="fa fa-sun-o fa-spin text-white"></i>
            </div>
        </div>
    </div>
    <!-- END Header Loader -->
</header>
<!-- END Header -->