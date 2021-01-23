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

        {{-- select2 --}}
        <link rel="stylesheet" type="text/css" href="{{ asset('bower_components/select2/dist/css/select2.min.css') }}" />
        <link href="{{ asset('bower_components/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet" />

        <!-- Page JS Plugins CSS -->
        <link rel="stylesheet" href="{{ asset('codebase/src/assets/js/plugins/datatables/dataTables.bootstrap4.css') }}">   
        {{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css"> --}}
        {{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.css"/> --}}
        {{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css" /> --}}

        <!-- You can include a specific file from css/themes/ folder to alter the default color theme of the template. eg: -->
        <!-- <link rel="stylesheet" id="css-theme" href="assets/css/themes/flat.min.css"> -->
        <!-- END Stylesheets -->
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
                    <!-- END Mini Stats -->

                    <!-- Profile -->
                    <div class="block pull-r-l">
                        <div class="block-header bg-body-light">
                            <h3 class="block-title">
                                <i class="fa fa-fw fa-pencil font-size-default mr-5"></i>Profil
                            </h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
                            </div>
                        </div>
                        <div class="block-content">
                            <form action="{{ url('/ubah/password/') }}" method="post">
                                {{csrf_field()}}
                                <input type="text" hidden="" class="form-control" id="id" name="id" value="{{ Auth()->user()->id }}">
                                <div class="form-group mb-15">
                                    <label for="nama">Nama</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="nama" name="nama" value="{{ Auth()->user()->nama }}" disabled="">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="fa fa-user"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-15">
                                    <label for="username">Username</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="username" name="username" value="{{ Auth()->user()->username }}" disabled="">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="fa fa-envelope"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                @if(Auth()->user()->level == 'proktor')
                                <div class="form-group mb-15">
                                    <label for="sekolah">Sekolah</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="sekolah" name="sekolah" value="{{ Auth()->user()->sekolah->nama }}" disabled="">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="fa fa-school"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>   
                                @endif
                                <div class="form-group mb-15">
                                    <label for="password">Password Baru</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Password Baru">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="fa fa-asterisk"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-15">
                                    <label for="konfrimasi_password">Konfirmasi Password Baru</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="konfrimasi_password" name="konfrimasi_password" placeholder="Konfirmasi Password Baru">
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
                                            <i class="fa fa-refresh mr-5"></i> Perbarui
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
                @if(session('error'))
                    <div class="alert alert-danger">
                        <strong>Submit Form Tidak Berhasil!</strong>
                        {{ session('error') }}
                    </div>
                @elseif(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}                        
                    </div>
                @endif
                <div class="content">
                    @yield('content')
                </div>
                <!-- END Page Content -->

            </main>
            <!-- END Main Container -->
            @include('template.base.footer')
        </div>
        <!-- END Page Container -->
        <!--
            Codebase JS Core

            Vital libraries and plugins used in all pages. You can choose to not include this file if you would like
            to handle those dependencies through webpack. Please check out assets/_es6/main/bootstrap.js for more info.

            If you like, you could also include them separately directly from the assets/js/core folder in the following
            order. That can come in handy if you would like to include a few of them (eg jQuery) from a CDN.

            assets/js/core/jquery.min.js
            assets/js/core/bootstrap.bundle.min.js
            assets/js/core/simplebar.min.js
            assets/js/core/jquery-scrollLock.min.js
            assets/js/core/jquery.appear.min.js
            assets/js/core/jquery.countTo.min.js
            assets/js/core/js.cookie.min.js
        -->
        <script src="{{ asset('codebase/src/assets/js/codebase.core.min.js')}}"></script>
        <!--
            Codebase JS
            Custom functionality including Blocks/Layout API as well as other vital and optional helpers
            webpack is putting everything together at assets/_es6/main/app.js
        -->
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
        <script src="{{ asset('bower_components/sweetalert2/dist/sweetalert2.min.js') }}"></script>
        <script src="{{ asset('bower_components/select2/dist/js/select2.min.js') }}"></script>
        @yield('moreJS')
    </body>
</html>