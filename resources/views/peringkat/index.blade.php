@extends('template.base.app')
@section('title', ' Detail Ujian')

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
            </ul>
            <div class="block-content tab-content overflow-hidden">
{{-- KOTA --}}
                <div class="tab-pane fade fade-right show active" id="btabs-animated-slideright-home" role="tabpanel">
                    <ul class="nav nav-tabs nav-tabs-block" data-toggle="tabs" role="tablist">
                        @if(Auth()->user()->level == 'admin')
                            <li class="nav-item">
                                <a class="nav-link active" href="#" id="kota_all">Semua</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" id="kota_2013">Kurikulum 2013</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" id="kota_2006">Kurikulum 2006</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link active" href="#" id="kota_{{ Auth()->user()->sekolah->kurikulum }}">Kurikulum {{ Auth()->user()->sekolah->kurikulum }}</a>
                            </li>
                        @endif
                    </ul>
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
{{-- SEKOLAH --}}
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
{{-- SISWA --}}
                <div class="tab-pane fade fade-right" id="btabs-animated-slideright-siswa" role="tabpanel">
                    <ul class="nav nav-tabs nav-tabs-block" data-toggle="tabs" role="tablist">
                        <li class="nav-item active show rata_rata_siswa" id="rat">
                            <a class="nav-link rata_rata_siswa" href="#btabs-animated-slideright-siswa" id="rata_rata_siswa">Semua</a>
                        </li>
                        <li class="nav-item tiap_pelajaran" id="pel2">
                            <a class="nav-link tiap_pelajaran2" href="#btabs-animated-slideright-pelajaran">Tiap Pelajaran</a>
                        </li>
                    </ul>
                    <div class="row" style="margin-top: 30px;">
                        <div class="col-6">
                            <select class="form-control js-example-basic-single" id="example-select" name="example-select" onchange="myFunction(this)" style="width: 100%">
                                <option value="" disabled="" selected="">Pilih Kurikulum</option>
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
{{-- PELAJARAN --}}
                <div class="tab-pane fade fade-right" id="btabs-animated-slideright-pelajaran" role="tabpanel">
                    <ul class="nav nav-tabs nav-tabs-block" data-toggle="tabs" role="tablist">
                        <li class="nav-item" id="rat2">
                            <a class="nav-link rata_rata_siswa" href="#btabs-animated-slideright-siswa" id="">Semua</a>
                        </li>
                        <li class="nav-item active show tiap_pelajaran" id="pel">
                            <a class="nav-link tiap_pelajaran" href="#btabs-animated-slideright-pelajaran" id="tiap_pelajaran">Tiap Pelajaran</a>
                        </li>
                    </ul>
                    <div class="row" style="margin-top: 30px;">
                        <div class="col-6">
                            <select class="form-control js-example-basic-single" id="example-select" name="example-select" onchange="myFunction2(this)" style="width: 100%">
                                <option value="" disabled="" selected="">Pilih Mata Pelajaran</option>
                                @foreach($mapel as $m)
                                    <option value="{{ $m->id }}" data-mapel=" {{ $m->nama }}" data-kurikulum=" {{ $m->kurikulum }}">{{ $m->kurikulum }} - {{ $m->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="block-content">
                        <h4 class="font-w400" id='dinamis_siswa_individu_teks'>
                            
                        </h4>
                        <div class="table-responsive" id="dinamis_siswa_individu_table">
                            
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
        var table = 
            '<table class="table table-bordered table-striped table-hover dataTable js-basic-example" id="peringkat_kota-table">'+
                '<thead>'+
                    '<tr>'+
                        '<th>Peringkat</th>'+
                        '<th>Kota / Kabupaten</th>'+
                        '<th>Jumlah Sekolah</th>'+
                        '<th>Nilai rata_rata</th>'+
                    '</tr>'+
                '</thead>'+
            '</table>';

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

        var table_peringkat_sekolah = 
            '<table class="table table-bordered table-striped table-hover dataTable js-basic-example" id="peringkat_sekolah-table">'+
                '<thead>'+
                    '<tr>'+
                        '<th>Peringkat</th>'+
                        '<th>Sekolah</th>'+
                        '<th>Nilai rata-rata</th>'+
                    '</tr>'+
                '</thead>'+
            '</table>';
        
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

        $('.rata_rata_siswa').on('click', function(e){
            getRankSiswa('all')
            $('.peringkat_siswa').removeClass('active show');
            $('#rat').addClass('active show');
            $('#btabs-animated-slideright-pelajaran').removeClass('active show');            
        });

        $('.tiap_pelajaran').on('click', function(e){
            $('.rata_rata_siswa').removeClass('active show');
            $('.tiap_pelajaran2').removeClass('active show');
            $('#pel').addClass('active show');
            $('#btabs-animated-slideright-siswa').removeClass('active show');
        });

        var table_peringkat_siswa = 
            '<table class="table table-bordered table-striped table-hover dataTable js-basic-example" id="siswas_rata2-table">'+
                '<thead>'+
                    '<tr>'+
                        '<th></th>'+
                        '<th>Nama</th>'+
                        '<th>NISN</th>'+
                        '<th>Sekolah</th>'+
                        '<th>Nilai Rata-rata</th>'+
                    '</tr>'+
                '</thead>'+
            '</table>';

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

        var table_peringkat_siswa_individu = 
            '<table class="table table-bordered table-striped table-hover dataTable js-basic-example" id="siswas-table">'+
                '<thead>'+
                    '<tr>'+
                        '<th></th>'+
                        '<th>Nama</th>'+
                        '<th>NISN</th>'+
                        '<th>Sekolah</th>'+
                        '<th>Nilai</th>'+
                    '</tr>'+
                '</thead>'+
            '</table>';

        function getRankSiswaIndividu(id, kurikulum, mapel){
            console.log(id)
            $('#dinamis_siswa_individu_table').empty();
            $('#dinamis_siswa_individu_table').append(table_peringkat_siswa_individu);
            $('#dinamis_siswa_individu_teks').html('30 Besar Nilai Mata Pelajaran ' + mapel + ' Kurikulum' + kurikulum);

            $('#siswas-table').DataTable( {
                "processing": true,
                "ajax": "{{ url('/ajax/get_rank_siswa_individu/')}}/"+id,
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

        function myFunction2(selectObject) {
            var value = selectObject.value;  

            var opt = selectObject.options[selectObject.selectedIndex];
            var kurikulum = opt.dataset.kurikulum
            var mapel = opt.dataset.mapel

            getRankSiswaIndividu(value, kurikulum, mapel)
        }

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