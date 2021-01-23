@extends('template.base.app')
@section('title', ' Dashboard')

@section('sidebar')
    @include('template.base.sidebar')
@endsection

@section('header')
    @include('template.base.header')
@endsection

@section('content')
<style>
    td.details-control {
        background: url('{{ asset('img/details_open.png') }}') no-repeat center center;
        cursor: pointer;
    }
    tr.shown td.details-control {
        background: url('{{ asset('img/details_close.png') }}') no-repeat center center;
    }
</style>
<nav class="breadcrumb bg-white push">
    <a class="breadcrumb-item" href="{{ url('/dashboard') }}">Dashboard</a>
    <a class="breadcrumb-item" href="{{ url('/bank_soal') }}">Bank Soal</a>
    <span class="breadcrumb-item active">{{ $pelajaran->nama }} Kurikulum {{ $pelajaran->kurikulum }}</span>
</nav>
<div class="block">
    <div class="block-header block-header-default bg-gd-primary">
        <h3 class="block-title text-white">Mata Pelajaran {{ $pelajaran->nama }} Kurikulum {{ $pelajaran->kurikulum }}</h3>
    </div>
    <div class="block-content">
        <div class="row py-20">
            <div class="col-3 text-center border-r">
                <div class="js-appear-enabled animated fadeInLeft" data-toggle="appear" data-class="animated fadeInLeft">
                    <div class="font-size-h3 font-w600 text-info">{{ $count['terima'] }}</div>
                    <div class="font-size-sm font-w600 text-uppercase text-muted">Soal Diterima</div>
                </div>
            </div>
            <div class="col-3 text-center border-r">
                <div class="js-appear-enabled animated fadeInUp" data-toggle="appear" data-class="animated fadeInUp">
                    <div class="font-size-h3 font-w600 text-success">{{ $count['revisi'] }}</div>
                    <div class="font-size-sm font-w600 text-uppercase text-muted">Soal Direvisi</div>
                </div>
            </div>
            <div class="col-3 text-center">
                <div class="js-appear-enabled animated fadeInRight" data-toggle="appear" data-class="animated fadeInRight">
                    <div class="font-size-h3 font-w600 text-primary">{{ $count['tolak'] }}</div>
                    <div class="font-size-sm font-w600 text-uppercase text-muted">Soal Ditolak</div>
                </div>
            </div>
            <div class="col-3 text-center border-l">
                <div class="js-appear-enabled animated fadeInRight" data-toggle="appear" data-class="animated fadeInRight">
                    <div class="font-size-h3 font-w600 text-primary-dark">{{ $count['tidak_diuji'] }}</div>
                    <div class="font-size-sm font-w600 text-uppercase text-muted">Soal Tidak Diujikan</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="block">
            <ul class="nav nav-tabs nav-tabs-block" data-toggle="tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" href="#btabs-animated-slideright-statistik" id="diterim">Diterima</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#btabs-animated-slideright-detail" id="direvisi">Direvisi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#btabs-animated-slideright-detail2" id="ditolak">Ditolak</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#btabs-animated-slideright-detail3" id="tidak_diuji">Tidak Diuji</a>
                </li>
            </ul>
            <div class="block-content tab-content overflow-hidden">
{{-- SOAL DITERIMA --}}
                <div class="tab-pane fade fade-right show active" id="btabs-animated-slideright-statistik" role="tabpanel">
                    <div class="block-content">
                        <h4 class="font-w400 text-center" id="dinamis_sekolah_teks">
                            Soal Diterima
                        </h4>
                        <div class="block">
                            <div class="block-content">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover dataTable js-basic-example" id="table_terima">
                                        <thead>
                                            <tr>
                                                <th>Soal</th>
                                                <th>Pilihan A</th>
                                                <th>Pilihan B</th>
                                                <th>Pilihan C</th>
                                                <th>Pilihan D</th>
                                                <th>Pilihan E</th>
                                                <th>Kunci Jawaban</th>
                                                <th>Tingkat Kesulitan</th>
                                                <th>Paket</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
{{-- SOAL DIREVISI--}}
                <div class="tab-pane fade fade-right" id="btabs-animated-slideright-detail" role="tabpanel">
                    <div class="block-content text-center">
                        <h4 class="font-w400" id="dinamis_sekolah_teks">
                            Soal Direvisi
                        </h4>
                        <div class="block">
                            <div class="block-content">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover dataTable js-basic-example" id="table_revisi">
                                        <thead>
                                            <tr>
                                                <th>Soal</th>
                                                <th>Pilihan A</th>
                                                <th>Pilihan B</th>
                                                <th>Pilihan C</th>
                                                <th>Pilihan D</th>
                                                <th>Pilihan E</th>
                                                <th>Kunci Jawaban</th>
                                                <th>Tingkat Kesulitan</th>
                                                <th>Paket</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
{{-- SOAL DITOLAK --}}
                <div class="tab-pane fade fade-right" id="btabs-animated-slideright-detail2" role="tabpanel">
                    <div class="block-content text-center">
                        <h4 class="font-w400" id="dinamis_sekolah_teks">
                            Soal Ditolak
                        </h4>
                        <div class="block">
                            <div class="block-content">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover dataTable js-basic-example" id="table_tolak">
                                        <thead>
                                            <tr>
                                                <th>Soal</th>
                                                <th>Pilihan A</th>
                                                <th>Pilihan B</th>
                                                <th>Pilihan C</th>
                                                <th>Pilihan D</th>
                                                <th>Pilihan E</th>
                                                <th>Kunci Jawaban</th>
                                                <th>Tingkat Kesulitan</th>
                                                <th>Paket</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
{{-- SOAL TIDAK DIUJI --}}
                <div class="tab-pane fade fade-right" id="btabs-animated-slideright-detail3" role="tabpanel">
                    <div class="block-content text-center">
                        <h4 class="font-w400" id="dinamis_sekolah_teks">
                            Soal Tidak Diuji
                        </h4>
                        <div class="block">
                            <div class="block-content">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover dataTable js-basic-example" id="table_tidak_diuji">
                                        <thead>
                                            <tr>
                                                <th>Soal</th>
                                                <th>Pilihan A</th>
                                                <th>Pilihan B</th>
                                                <th>Pilihan C</th>
                                                <th>Pilihan D</th>
                                                <th>Pilihan E</th>
                                                <th>Kunci Jawaban</th>
                                                <th>Tingkat Kesulitan</th>
                                                <th>Paket</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('moreJS')
    <script>
        $(function(){
            var table_terima = $('#table_terima').DataTable({
                "processing": true,
                "serverSide": true,
                "searchDelay": 1000,
                "autoWidth": false,
                "ajax":{
                    "url": "{{ url('ajax/bank_soal/terima')}}/{{ $pelajaran->id }}",
                    "dataType": "json",
                    "type": "GET",
                },
                "columns": [
                    { data: 'deskripsi'},
                    { data: 'pilihan_a'},
                    { data: 'pilihan_b'},
                    { data: 'pilihan_c'},
                    { data: 'pilihan_d'},
                    { data: 'pilihan_e'},
                    { data: 'kunci_jawaban'},
                    { data: 'tingkat_kesulitan'},
                    { data: 'nama_paket'},
                ],
                "order": [[1, "asc"]]
            });

            var table_revisi = $('#table_revisi').DataTable({
                "processing": true,
                "serverSide": true,
                "searchDelay": 1000,
                "autoWidth": false,
                "ajax":{
                    "url": "{{ url('ajax/bank_soal/revisi')}}/{{ $pelajaran->id }}",
                    "dataType": "json",
                    "type": "GET",
                },
                "columns": [
                    { data: 'deskripsi'},
                    { data: 'pilihan_a'},
                    { data: 'pilihan_b'},
                    { data: 'pilihan_c'},
                    { data: 'pilihan_d'},
                    { data: 'pilihan_e'},
                    { data: 'kunci_jawaban'},
                    { data: 'tingkat_kesulitan'},
                    { data: 'nama_paket'},
                ],
                "order": [[1, "asc"]]
            });

            var table_tolak = $('#table_tolak').DataTable({
                "processing": true,
                "serverSide": true,
                "searchDelay": 1000,
                "autoWidth": false,
                "ajax":{
                    "url": "{{ url('ajax/bank_soal/tolak')}}/{{ $pelajaran->id }}",
                    "dataType": "json",
                    "type": "GET",
                },
                "columns": [
                    { data: 'deskripsi'},
                    { data: 'pilihan_a'},
                    { data: 'pilihan_b'},
                    { data: 'pilihan_c'},
                    { data: 'pilihan_d'},
                    { data: 'pilihan_e'},
                    { data: 'kunci_jawaban'},
                    { data: 'tingkat_kesulitan'},
                    { data: 'nama_paket'},
                ],
                "order": [[1, "asc"]]
            });

            var table_tidak_diuji = $('#table_tidak_diuji').DataTable({
                "processing": true,
                "serverSide": true,
                "searchDelay": 1000,
                "autoWidth": false,
                "ajax":{
                    "url": "{{ url('ajax/bank_soal/tidak_diuji')}}/{{ $pelajaran->id }}",
                    "dataType": "json",
                    "type": "GET",
                },
                "columns": [
                    { data: 'deskripsi'},
                    { data: 'pilihan_a'},
                    { data: 'pilihan_b'},
                    { data: 'pilihan_c'},
                    { data: 'pilihan_d'},
                    { data: 'pilihan_e'},
                    { data: 'kunci_jawaban'},
                    { data: 'tingkat_kesulitan'},
                    { data: 'nama_paket'},
                ],
                "order": [[1, "asc"]]
            });
        });
    </script>
    <!-- Page JS Plugins -->
    <script src="{{ asset('codebase/src/assets/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('codebase/src/assets/js/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <!-- Page JS Code -->
    <script src="{{ asset('codebase/src/assets/js/pages/be_tables_datatables.min.js')}}"></script>
@endsection