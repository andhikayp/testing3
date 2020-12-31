@extends('template.base.app2')
@section('title', ' Dashboard')

@section('sidebar')
    @include('template.base.sidebar')
@endsection

@section('header')
    @include('template.base.header')
@endsection

@section('content')
    <div class="bg-image" style="background-image: url({{ asset('img/dinas.jpeg') }});">
        <div class="bg-black-op-75">
            <div class="content content-top content-full text-center">
                <div class="py-20">
                    <h1 class="h2 font-w700 text-white mb-10">Dashboard Monitoring dan Evaluasi </h1>
                    <h2 class="h4 font-w700 text-white-op mb-10">USP BKS Jawa Timur 2020<br><a class="text-primary-light link-effect" href="https://dindik.jatimprov.go.id/main">Dinas Pendidikan Provinsi Jawa Timur</a></h2>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        @if(Auth()->user()->level == 'admin')
        <div class="row js-appear-enabled animated fadeIn" data-toggle="appear">
            <div class="col-6 col-xl-3">
                <a class="block block-link-rotate block-transparent text-right bg-primary-lighter" href="javascript:void(0)">
                    <div class="block-content block-content-full clearfix">
                        <div class="float-left mt-10 d-none d-sm-block">
                            <i class="fas fa-archway fa-3x text-primary"></i>
                        </div>
                        <div class="font-size-h3 font-w600 text-primary-darker js-count-to-enabled" data-toggle="countTo" data-speed="1000" data-to="1500">{{ number_format($kota, 0, ',', '.') }}</div>
                        <div class="font-size-sm font-w600 text-uppercase text-primary-dark">Kota/Kabupaten</div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-xl-3">
                <a class="block block-link-rotate block-transparent text-right bg-primary-lighter" href="javascript:void(0)">
                    <div class="block-content block-content-full clearfix">
                        <div class="float-left mt-10 d-none d-sm-block">
                            <i class="fas fa-school fa-3x text-primary"></i>
                        </div>
                        <div class="font-size-h3 font-w600 text-primary-darker"><span data-toggle="countTo" data-speed="1000" data-to="780" class="js-count-to-enabled">{{ number_format($sekolah, 0, ',', '.') }}</span></div>
                        <div class="font-size-sm font-w600 text-uppercase text-primary-dark">SMA</div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-xl-3">
                <a class="block block-link-rotate block-transparent text-right bg-primary-lighter" href="javascript:void(0)">
                    <div class="block-content block-content-full clearfix">
                        <div class="float-left mt-10 d-none d-sm-block">
                            <i class="fas fa-user-graduate fa-3x text-primary"></i>
                        </div>
                        <div class="font-size-h3 font-w600 text-primary-darker js-count-to-enabled" data-toggle="countTo" data-speed="1000" data-to="15">{{ number_format($user[0]->total, 0, ',', '.') }}</div>
                        <div class="font-size-sm font-w600 text-uppercase text-primary-dark">{{ $user[0]->level }}</div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-xl-3">
                <a class="block block-link-rotate block-transparent text-right bg-primary-lighter" href="javascript:void(0)">
                    <div class="block-content block-content-full clearfix">
                        <div class="float-left mt-10 d-none d-sm-block">
                            <i class="fas fa-chalkboard-teacher fa-3x text-primary"></i>
                        </div>
                        <div class="font-size-h3 font-w600 text-primary-darker js-count-to-enabled" data-toggle="countTo" data-speed="1000" data-to="4252">{{ number_format($user[1]->total, 0, ',', '.') }}</div>
                        <div class="font-size-sm font-w600 text-uppercase text-primary-dark">{{ $user[1]->level }}</div>
                    </div>
                </a>
            </div>
        </div>
        <div class="row js-appear-enabled animated fadeIn" data-toggle="appear">
            <div class="col-6 col-xl-3">
                <a class="block block-link-rotate block-transparent text-right bg-primary-lighter" href="javascript:void(0)">
                    <div class="block-content block-content-full clearfix">
                        <div class="float-left mt-10 d-none d-sm-block">
                            <i class="fas fa-book fa-3x text-primary"></i>
                        </div>
                        <div class="font-size-h3 font-w600 text-primary-darker js-count-to-enabled" data-toggle="countTo" data-speed="1000" data-to="1500">{{ number_format($kurikulum, 0, ',', '.') }}</div>
                        <div class="font-size-sm font-w600 text-uppercase text-primary-dark">Kurikulum</div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-xl-3">
                <a class="block block-link-rotate block-transparent text-right bg-primary-lighter" href="javascript:void(0)">
                    <div class="block-content block-content-full clearfix">
                        <div class="float-left mt-10 d-none d-sm-block">
                            <i class="fas fa-book-reader fa-3x text-primary"></i>
                        </div>
                        <div class="font-size-h3 font-w600 text-primary-darker js-count-to-enabled" data-toggle="countTo" data-speed="1000" data-to="1500">{{ number_format($pelajaran, 0, ',', '.') }}</div>
                        <div class="font-size-sm font-w600 text-uppercase text-primary-dark">Pelajaran</div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-xl-6">
                <a class="block block-link-rotate block-transparent text-right bg-primary-lighter" href="javascript:void(0)">
                    <div class="block-content block-content-full clearfix">
                        <div class="float-left mt-10 d-none d-sm-block">
                            <i class="fas fa-align-justify fa-3x text-primary"></i>
                        </div>
                        <div class="font-size-h3 font-w600 text-primary-darker js-count-to-enabled" data-toggle="countTo" data-speed="1000" data-to="1500" id="count_ujian"></div>
                        <div class="font-size-sm font-w600 text-uppercase text-primary-dark">Ujian Siswa</div>
                    </div>
                </a>
            </div>
        </div>
        @elseif(Auth()->user()->level == 'proktor')
        <div class="content content-full text-center">
            <h1 class="h2 font-w700 mb-10">Selamat datang, {{ Auth()->user()->sekolah->nama }}!</h1>
        </div>
        <div class="row js-appear-enabled animated fadeIn" data-toggle="appear">
            <div class="col-6 col-xl-3">
                <a class="block block-link-rotate block-transparent text-right bg-primary-lighter" href="javascript:void(0)">
                    <div class="block-content block-content-full clearfix">
                        <div class="float-left mt-10 d-none d-sm-block">
                            <i class="fas fa-book fa-3x text-primary"></i>
                        </div>
                        <div class="font-size-sm font-w600 text-uppercase text-primary-dark">Kurikulum</div>
                        <div class="font-size-h3 font-w600 text-primary-darker js-count-to-enabled" data-toggle="countTo" data-speed="1000" data-to="1500">{{ Auth()->user()->sekolah->kurikulum }}</div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-xl-3">
                <a class="block block-link-rotate block-transparent text-right bg-primary-lighter" href="javascript:void(0)">
                    <div class="block-content block-content-full clearfix">
                        <div class="float-left mt-10 d-none d-sm-block">
                            <i class="fas fa-book-reader fa-3x text-primary"></i>
                        </div>
                        <div class="font-size-h3 font-w600 text-primary-darker js-count-to-enabled" data-toggle="countTo" data-speed="1000" data-to="1500">{{ number_format($pelajaran, 0, ',', '.') }}</div>
                        <div class="font-size-sm font-w600 text-uppercase text-primary-dark">Pelajaran</div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-xl-3">
                <a class="block block-link-rotate block-transparent text-right bg-primary-lighter" href="javascript:void(0)">
                    <div class="block-content block-content-full clearfix">
                        <div class="float-left mt-10 d-none d-sm-block">
                            <i class="fas fa-book-reader fa-3x text-primary"></i>
                        </div>
                        <div class="font-size-h3 font-w600 text-primary-darker js-count-to-enabled" data-toggle="countTo" data-speed="1000" data-to="1500">{{ number_format($user, 0, ',', '.') }}</div>
                        <div class="font-size-sm font-w600 text-uppercase text-primary-dark">Siswa</div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-xl-3">
                <a class="block block-link-rotate block-transparent text-right bg-primary-lighter" href="javascript:void(0)">
                    <div class="block-content block-content-full clearfix">
                        <div class="float-left mt-10 d-none d-sm-block">
                            <i class="fas fa-align-justify fa-3x text-primary"></i>
                        </div>
                        <div class="font-size-h3 font-w600 text-primary-darker js-count-to-enabled" data-toggle="countTo" data-speed="1000" data-to="1500">{{ number_format($ujian, 0, ',', '.') }}</div>
                        <div class="font-size-sm font-w600 text-uppercase text-primary-dark">Ujian Siswa</div>
                    </div>
                </a>
            </div>
        </div>
        @endif
    </div>
@endsection
@section('moreJS')
<script>
    // $(window).on('load', function () {
    //     $.getJSON('{{ url('/count_ujian')}}', function(result) {
    //         getCountUjian(result);
    //     });
    // });
    function getCountUjian(result){
        var div = document.getElementById('count_ujian');
        var reverse = result.toString().split('').reverse().join(''),
        ribuan  = reverse.match(/\d{1,3}/g);
        ribuan  = ribuan.join('.').split('').reverse().join('');
        div.innerHTML += ribuan;
    }
</script>

<script src="{{ asset('js/devextreme/dx.all.js') }}"></script>
<script>
    $.getJSON('{{ url('/admindt') }}')
      .done(function(result) {
        console.log(result);
        // renderDataGrid(result.data);
      });
</script>
@endsection
