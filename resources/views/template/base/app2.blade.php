<!doctype html>
<html lang="en" class="no-focus">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

        <title>MONEV USP-BKS 2020 | @yield('title')</title>

        <meta name="description" content="Codebase - Bootstrap 4 Admin Template &amp; UI Framework created by pixelcave and published on Themeforest">
        <meta name="author" content="pixelcave">
        <meta name="robots" content="noindex, nofollow">

        <!-- Open Graph Meta -->
        <meta property="og:title" content="Codebase - Bootstrap 4 Admin Template &amp; UI Framework">
        <meta property="og:site_name" content="Codebase">
        <meta property="og:description" content="Codebase - Bootstrap 4 Admin Template &amp; UI Framework created by pixelcave and published on Themeforest">
        <meta property="og:type" content="website">
        <meta property="og:url" content="">
        <meta property="og:image" content="">

        <!-- Icons -->
        <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
        <link rel="shortcut icon" href="assets/media/favicons/favicon.png">
        <link rel="icon" type="image/png" sizes="192x192" href="assets/media/favicons/favicon-192x192.png">
        <link rel="apple-touch-icon" sizes="180x180" href="assets/media/favicons/apple-touch-icon-180x180.png">
        <!-- END Icons -->

        <!-- Stylesheets -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <!-- Fonts and Codebase framework -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,400i,600,700">
        <link rel="stylesheet" id="css-main" href="{{ asset('codebase/src/assets/css/codebase.min.css') }}">
        {{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/devextreme/styles.css') }}" /> --}}
        <link rel="stylesheet" type="text/css" href="{{ asset('css/devextreme/dx.light.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('css/devextreme/dx.common.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('fontawesome-free-5.15.1-web/css/all.css') }}" />

        <!-- Page JS Plugins CSS -->
        <link rel="stylesheet" href="{{ asset('codebase/src/assets/js/plugins/datatables/dataTables.bootstrap4.css') }}">   
    </head>
    <body>
        <div id="page-container" class="sidebar-o sidebar-inverse enable-page-overlay side-scroll page-header-fixed page-header-modern main-content-boxed">
            <!-- Side Overlay-->
            <aside id="side-overlay">
                <!-- Side Header -->
                <div class="content-header content-header-fullrow">
                    <div class="content-header-section align-parent">
                        <!-- Close Side Overlay -->
                        <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                        <button type="button" class="btn btn-circle btn-dual-secondary align-v-r" data-toggle="layout" data-action="side_overlay_close">
                            <i class="fa fa-times text-danger"></i>
                        </button>
                        <!-- END Close Side Overlay -->
                    </div>
                </div>
                <!-- END Side Header -->

                <!-- Side Content -->
                <div class="content-side">
                    <!-- Mini Stats -->
                    <div class="block pull-r-l">
                        <div class="block-content block-content-full block-content-sm bg-body-light">
                            <div class="row">
                                <div class="col-4">
                                    <div class="font-size-sm font-w600 text-uppercase text-muted">Clients</div>
                                    <div class="font-size-h4">460</div>
                                </div>
                                <div class="col-4">
                                    <div class="font-size-sm font-w600 text-uppercase text-muted">Sales</div>
                                    <div class="font-size-h4">728</div>
                                </div>
                                <div class="col-4">
                                    <div class="font-size-sm font-w600 text-uppercase text-muted">Earnings</div>
                                    <div class="font-size-h4">$7,860</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END Mini Stats -->

                    <!-- Profile -->
                    <div class="block pull-r-l">
                        <div class="block-header bg-body-light">
                            <h3 class="block-title">
                                <i class="fa fa-fw fa-pencil font-size-default mr-5"></i>Profile
                            </h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
                            </div>
                        </div>
                        <div class="block-content">
                            <form action="be_pages_dashboard.html" method="post" onsubmit="return false;">
                                <div class="form-group mb-15">
                                    <label for="side-overlay-profile-name">Name</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="side-overlay-profile-name" name="side-overlay-profile-name" placeholder="Your name.." value="John Smith">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="fa fa-user"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-15">
                                    <label for="side-overlay-profile-email">Email</label>
                                    <div class="input-group">
                                        <input type="email" class="form-control" id="side-overlay-profile-email" name="side-overlay-profile-email" placeholder="Your email.." value="john.smith@example.com">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="fa fa-envelope"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-15">
                                    <label for="side-overlay-profile-password">New Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="side-overlay-profile-password" name="side-overlay-profile-password" placeholder="New Password..">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="fa fa-asterisk"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-15">
                                    <label for="side-overlay-profile-password-confirm">Confirm New Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="side-overlay-profile-password-confirm" name="side-overlay-profile-password-confirm" placeholder="Confirm New Password..">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="fa fa-asterisk"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-6">
                                        <button type="submit" class="btn btn-block btn-alt-primary">
                                            <i class="fa fa-refresh mr-5"></i> Update
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- END Profile -->
                </div>
                <!-- END Side Content -->
            </aside>
            <!-- END Side Overlay -->

            @yield('sidebar')
            @yield('header')

            <!-- Main Container -->
            <main id="main-container">

                <!-- Page Content -->
                @yield('content')
                <!-- END Page Content -->

            </main>
            <!-- END Main Container -->
            @include('template.base.footer')
        </div>
        <script src="{{ asset('codebase/src/assets/js/codebase.core.min.js')}}"></script>
        <script src="{{ asset('codebase/src/assets/js/codebase.app.min.js')}}"></script>
        <!-- Page JS Plugins -->
        <script src="{{ asset('codebase/src/assets/js/plugins/chartjs/Chart.bundle.min.js')}}"></script>
        <!-- Page JS Code -->
        <script src="{{ asset('codebase/src/assets/js/pages/be_pages_dashboard.min.js')}}"></script>
        <script type="text/javascript">
            $(window).on('load', function(){
                var ServerInitTimestamp = new Date();
                var LocalInitTimestamp = new Date();
                var jarak = LocalInitTimestamp - ServerInitTimestamp;
                var bulan = new Array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "Nopember", "Desember");
                function jam() {
                    var tanggal = new Date(new Date() - jarak);
                    document.getElementById("clock-widget").innerHTML = ("0" + tanggal.getHours()).slice(-2) + ":" + ("0" + tanggal.getMinutes()).slice(-2) + ":" + ("0" + tanggal.getSeconds()).slice(-2);
                        document.getElementById("date-widget").innerHTML = tanggal.getDate() + " " + bulan[tanggal.getMonth()] + " " + tanggal.getFullYear();
                    setTimeout(function () {
                        jam();
                    }, 1000);
                }
                window.setTimeout(function () {
                    jam();
                }, 1000);
            });
        </script>
        @yield('moreJS')
    </body>
</html>