@extends('template.auth.app')
@section('title', 'Masuk')

@section('content')
<!-- Page Content -->
<div class="bg-image" style="background-image: url({{ asset('img/bg_ujian.jpg') }});">
    <div class="row mx-0 bg-black-op">
        <div class="hero-static col-md-6 col-xl-8 d-none d-md-flex align-items-md-end">
            <div class="p-30 invisible" data-toggle="appear">
                <p class="font-size-h3 font-w600 text-white">
                    MONEV USP-BKS - Aplikasi Monitoring dan Evaluasi USP-BKS Dinas Pendidikan Provinsi Jawa Timur
                </p>
                <p class="font-italic text-white-op">
                    Copyright &copy; Dinas Pendidikan Provinsi Jawa Timur <span class="js-year-copy"></span>
                </p>
            </div>
        </div>
        <div class="hero-static col-md-6 col-xl-4 d-flex align-items-center bg-white invisible" data-toggle="appear" data-class="animated fadeInRight">
            <div class="content content-full">
                <div class="px-30 py-10 text-center">
                    <img src="{{ asset('img/logo_jatim.png') }}" alt="Logo Sidoarjo" width="50%" height="100%"><br>
                    <a class="link-effect font-w700" href="index.html">
                        <span class="font-size-xl text-primary-dark">MONEV USP-BKS 2020</span><br><span class="font-size-xl">Dinas Pendidikan <br>Provinsi Jawa Timur</span>
                    </a>
                </div>
                <!-- Header -->
                <div class="px-30 py-10">
                    {{-- <h1 class="h3 font-w700 mt-30 mb-10">MONEV USP-BKS</h1> --}}
                    <h2 class="h5 font-w400 text-muted mb-0">Masuk terlebih dahulu</h2>
                </div>
                <!-- END Header -->

                <!-- Sign In Form -->
                <!-- jQuery Validation functionality is initialized with .js-validation-signin class in js/pages/op_auth_signin.min.js which was auto compiled from _es6/pages/op_auth_signin.js -->
                <!-- For more examples you can check out https://github.com/jzaefferer/jquery-validation -->
                @if(session('error'))
                    <div class="alert alert-danger">
                        <strong>Login Gagal!</strong>
                        {{ session('error') }}
                    </div>
                @elseif(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}                        
                    </div>
                @endif
                <form id="login-form" class="js-validation-signin px-30" action="{{url('/login')}}" method="post">
                    {{csrf_field()}}
                    <div class="form-group row">
                        <div class="col-12">
                            <div class="form-material form-material-primary floating">
                                <input type="text" class="form-control" id="username" name="username">
                                <label for="username">Username</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <div class="form-material form-material-primary floating">
                                <input type="password" class="form-control" id="password" name="password">
                                <label for="password">Password</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-sm btn-hero btn-alt-primary">
                            <i class="si si-login mr-10"></i> Masuk
                        </button>
                    </div>
                </form>
                <!-- END Sign In Form -->
            </div>
        </div>
    </div>
</div>
<!-- END Page Content -->
@endsection