@extends('template.base.app')
@section('title', ' Detail Ujian')

@section('sidebar')
    @include('template.base.sidebar')
@endsection

@section('header')
    @include('template.base.header')
@endsection

@section('content')
{{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" /> --}}
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
    <span class="breadcrumb-item active">Peringkat</span>
</nav>
<div class="row">
    <div class="col-lg-12">
        <div class="block">
            <ul class="nav nav-tabs nav-tabs-block" data-toggle="tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" href="#btabs-animated-slideright-home" id="peringkat_kota">Peringkat Kota & Kabupaten</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#btabs-animated-slideright-sekolah" id="peringkat_sekolah">Peringkat Sekolah</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#btabs-animated-slideright-siswa" id="peringkat_siswa">Peringkat Siswa</a>
                </li>
                {{-- <li class="nav-item ml-auto">
                    <a class="nav-link" href="#btabs-animated-slideright-settings"><i class="si si-settings"></i></a>
                </li> --}}
            </ul>
            <div class="block-content tab-content overflow-hidden">
                <div class="tab-pane fade fade-right show active" id="btabs-animated-slideright-home" role="tabpanel">
                    <ul class="nav nav-tabs nav-tabs-block" data-toggle="tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" href="#" id="kota_all">Semua</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" id="kota_2013">Kurikulum 2013</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" id="kota_2006">Kurikulum 2006</a>
                        </li>
                    </ul>
{{--                     <div class="block block-fx-shadow text-center">
                        <a class="d-block bg-warning font-w600 text-uppercase py-5">
                            <span class="text-white">Statistik Nilai Kota & Kabupaten</span>
                        </a>
                        <div class="block-content block-content-full">
                            <div id="nilai"></div>
                        </div>
                    </div> --}}
                    <div class="block-content">
                        <h4 class="font-w400" id='dinamis_kota_teks'>
                            Peringkat Kota/Kabupaten
                        </h4>
                        <div class="table-responsive" id="dinamis_table">
                            <table class="table table-bordered table-striped table-hover dataTable js-basic-example" id="peringkat_kota-table">
                                <thead>
                                    <tr>
                                        <th>Peringkat</th>
                                        <th>Kota / Kabupaten</th>
                                        <th>Jumlah Sekolah</th>
                                        <th>Nilai rata_rata</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade fade-right" id="btabs-animated-slideright-sekolah" role="tabpanel">
                    <ul class="nav nav-tabs nav-tabs-block" data-toggle="tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" href="#" id="sekolah_all">Semua</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" id="sekolah_2013">Kurikulum 2013</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" id="sekolah_2006">Kurikulum 2006</a>
                        </li>
                    </ul>
                    <div class="block-content">
                        <h4 class="font-w400" id="dinamis_sekolah_teks">
                            Peringkat Sekolah
                        </h4>
                        <div class="table-responsive" id="dinamis_sekolah_table">
                            <table class="table table-bordered table-striped table-hover dataTable js-basic-example" id="peringkat_sekolah-table">
                                <thead>
                                    <tr>
                                        <th>Peringkat</th>
                                        <th>Sekolah</th>
                                        <th>Nilai rata-rata</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade fade-right" id="btabs-animated-slideright-siswa" role="tabpanel">
                    <ul class="nav nav-tabs nav-tabs-block" data-toggle="tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" href="#" id="rata_rata_siswa">Semua</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" id="tiap_pelajaran">Tiap Pelajaran</a>
                        </li>
                    </ul>
                    <div class="block-content">
                        <div class="col-4">
                            <select class="form-control js-example-basic-single" id="example-select" name="example-select" onchange="myFunction(this)" style="width: 100%">
                                <option value="All">Semua</option>
                                <option value="2013">Kurikulum 2013</option>
                                <option value="2006">Kurikulum 2006</option>
                            </select>
                        </div>
                    </div>
                    <div class="block-content">
                        <h4 class="font-w400" id='dinamis_siswa_teks'>
                            100 Besar Nilai Rata-rata Terbaik
                        </h4>
                        <div class="table-responsive" id="dinamis_siswa_table">
                            <table class="table table-bordered table-striped table-hover dataTable js-basic-example" id="siswas_rata2-table">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Nama</th>
                                        <th>NISN</th>
                                        <th>Sekolah</th>
                                        <th>Nilai Rata-rata</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- <div class="tab-pane fade fade-right" id="btabs-animated-slideright-pelajaran" role="tabpanel">
                    <ul class="nav nav-tabs nav-tabs-block" data-toggle="tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link" href="#btabs-animated-slideright-siswa" id="rata_rata_siswa">Semua</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="#btabs-animated-slideright-pelajaran" id="tiap_pelajaran">Tiap Pelajaran</a>
                        </li>
                    </ul>
                    <div class="row">
                        <div class="col-md-4">
                            <select class="form-control" id="example-select" name="example-select">
                                <option value="0">Please select</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <select class="form-control" id="example-select" name="example-select">
                                <option value="0">Please select</option>
                                <option value="1">Option #1</option>
                                <option value="2">Option #2</option>
                                <option value="3">Option #3</option>
                            </select>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-basic-example" id="siswas-table">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Tanggal</th>
                                    <th>Pelaksanaan</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
 --}}
            </div>
        </div>
    </div>
</div>
@endsection
@section('moreJS')
    <script>
        var table = '<table class="table table-bordered table-striped table-hover dataTable js-basic-example" id="peringkat_kota-table"><thead><tr><th>Peringkat</th><th>Kota / Kabupaten</th><th>Jumlah Sekolah</th><th>Nilai rata_rata</th></tr></thead></table>';

        $('#kota_all').on('click', function(e){
            getRankKota()            
        });

        $('#peringkat_kota').on('click', function(e){
            getRankSekolah()            
        });

        function getRankKota(){
            $('#dinamis_table').empty();
            $('#dinamis_table').append(table);
            $('#dinamis_kota_teks').html('Peringkat Kota/Kabupaten');

            $('#peringkat_kota-table').DataTable( {
                "ajax": "{{ url('/ajax/peringkat_kota/all')}}",
                "autoWidth": true,
                "ordering": false,
                "columns": [
                    { "data": "no" },
                    { "data": "nama" },
                    { "data": "jumlah_sekolah" },
                    { "data": "nilai_rata_rata" },
                ]
            });           
        }
        
        $('#kota_2013').on('click', function(e){
            $('#dinamis_table').empty();
            $('#dinamis_table').append(table);
            $('#dinamis_kota_teks').html('Peringkat Kota/Kabupaten Kurikulum 2013');

            $('#peringkat_kota-table').DataTable( {
                "ajax": "{{ url('/ajax/peringkat_kota/2013')}}",
                "autoWidth": true,
                "ordering": false,
                "columns": [
                    { "data": "no" },
                    { "data": "nama" },
                    { "data": "jumlah_sekolah" },
                    { "data": "nilai_rata_rata" },
                ]
            });
        });

        $('#kota_2006').on('click', function(e){
            $('#dinamis_table').empty();
            $('#dinamis_table').append(table);
            $('#dinamis_kota_teks').html('Peringkat Kota/Kabupaten Kurikulum 2006');

            $('#peringkat_kota-table').DataTable( {
                "ajax": "{{ url('/ajax/peringkat_kota/2006')}}",
                "autoWidth": true,
                "ordering": false,
                "columns": [
                    { "data": "no" },
                    { "data": "nama" },
                    { "data": "jumlah_sekolah" },
                    { "data": "nilai_rata_rata" },
                ]
            });
        });

        var table_peringkat_sekolah = '<table class="table table-bordered table-striped table-hover dataTable js-basic-example" id="peringkat_sekolah-table"><thead><tr><th>Peringkat</th><th>Sekolah</th><th>Nilai rata-rata</th></tr></thead></table>';
        
        $('#sekolah_all').on('click', function(e){
            getRankSekolah()
        });

        $('#peringkat_sekolah').on('click', function(e){
            getRankSekolah()
        });

        function getRankSekolah(){
            $('#dinamis_sekolah_table').empty();
            $('#dinamis_sekolah_table').append(table_peringkat_sekolah);
            $('#dinamis_sekolah_teks').html('Peringkat Sekolah');

            $('#peringkat_sekolah-table').DataTable( {
                "ajax": "{{ url('/ajax/peringkat_sekolah/all')}}",
                "autoWidth": true,
                "ordering": false,
                "columns": [
                    { "data": "no" },
                    { "data": "nama" },
                    { "data": "nilai_rata_rata" },
                ]
            });
        }

        
        $('#sekolah_2013').on('click', function(e){
            $('#dinamis_sekolah_table').empty();
            $('#dinamis_sekolah_table').append(table_peringkat_sekolah);
            $('#dinamis_sekolah_teks').html('Peringkat Sekolah Kurikulum 2013');

            $('#peringkat_sekolah-table').DataTable( {
                "ajax": "{{ url('/ajax/peringkat_sekolah/2013')}}",
                "autoWidth": true,
                "ordering": false,
                "columns": [
                    { "data": "no" },
                    { "data": "nama" },
                    { "data": "nilai_rata_rata" },
                ]
            });
        });

        $('#sekolah_2006').on('click', function(e){
            $('#dinamis_sekolah_table').empty();
            $('#dinamis_sekolah_table').append(table_peringkat_sekolah);
            $('#dinamis_sekolah_teks').html('Peringkat Sekolah Kurikulum 2006');

            $('#peringkat_sekolah-table').DataTable( {
                "ajax": "{{ url('/ajax/peringkat_sekolah/2006')}}",
                "autoWidth": true,
                "ordering": false,
                "columns": [
                    { "data": "no" },
                    { "data": "nama" },
                    { "data": "nilai_rata_rata" },
                ]
            });
        });

        $(document).ready(function(){
            $('#peringkat_kota-table').DataTable({
                "ajax": "{{ url('/ajax/peringkat_kota/all')}}",
                "autoWidth": true,
                "ordering": false,
                "columns": [
                    { "data": "no" },
                    { "data": "nama" },
                    { "data": "jumlah_sekolah" },
                    { "data": "nilai_rata_rata" },
                ]
            });
        });

        $('#peringkat_siswa').on('click', function(e){
            getRankSiswa('all')
        });

        $('#rata_rata_siswa').on('click', function(e){
            getRankSiswa('all')
        });

        var table_peringkat_siswa = '<table class="table table-bordered table-striped table-hover dataTable js-basic-example" id="siswas_rata2-table"><thead><tr><th></th><th>Nama</th><th>NISN</th><th>Sekolah</th><th>Nilai Rata-rata</th></tr></thead></table>';

        function getRankSiswa(kurikulum){
            kurikulum = kurikulum.toLowerCase()
            $('#dinamis_siswa_table').empty();
            $('#dinamis_siswa_table').append(table_peringkat_siswa);
            if(kurikulum == 'all') {
                $('#dinamis_siswa_teks').html('100 Besar Nilai Rata-rata Terbaik');
            } else {
                $('#dinamis_siswa_teks').html('100 Besar Nilai Rata-rata Terbaik Kurikulum ' + kurikulum);
            }
            $('#siswas_rata2-table').DataTable( {
                "ajax": "{{ url('/ajax/get_rank_siswa/100/')}}/"+kurikulum,
                "autoWidth": true,
                "ordering": false,
                "columns": [
                    { "data": "no" },
                    { "data": "nama" },
                    { "data": "nisn" },
                    { "data": "nama_sekolah" },
                    { "data": "nilai_rata_rata" },
                ]
            });
        }

        function myFunction(selectObject) {
            var value = selectObject.value;  
            getRankSiswa(value)
        }

        // $.getJSON('{{ url('/ajax/peringkat_kota/all')}}').done(function(result) {
        //     renderDataGrid(result);
        // });

        // function renderDataGrid(gridDataSource) {
        //     console.log(gridDataSource.data)
        //     var tanpa_koreksi = $("#nilai").dxChart({
        //         rotated: true,
        //         dataSource: gridDataSource.data, 
        //         series: {
        //             argumentField: "nama",
        //             valueField: "nilai_rata_rata",
        //             name: "Rata-rata nilai",
        //             type: "bar",
        //             color: '#ffaa66'
        //         },
        //         valueAxis: {
        //             title: {
        //                 text: "Nilai skala 0-100"
        //             },
        //             position: "bottom",
        //             min:0,
        //             max: 100,
        //             valueType: "numeric",
        //             allowDecimals : false,
        //         },
        //         argumentAxis: {
        //             title: {
        //                 text: 'Kota/Kabupaten'
        //             },
        //             inverted: true,
        //             position: "left",
        //             label: {
        //                 overlappingBehavior: "rotate",
        //                 rotationAngle: 90
        //             }
        //         },
        //         tooltip: {
        //             enabled: true,
        //             location: "edge",
        //             customizeTooltip: function (arg) {
        //                 return {
        //                     text: arg.seriesName + " : " + arg.valueText
        //                 };
        //             }
        //         },
        //         export: {
        //             enabled: true
        //         },
        //     });
        // }
        $('.js-example-basic-single').select2({
            width: 'resolve'
        });
    </script>
    <script src="{{ asset('js/devextreme/dx.all.js') }}"></script>
    
    <!-- Page JS Plugins -->
    <script src="{{ asset('codebase/src/assets/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('codebase/src/assets/js/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <!-- Page JS Code -->
    <script src="{{ asset('codebase/src/assets/js/pages/be_tables_datatables.min.js')}}"></script>
@endsection