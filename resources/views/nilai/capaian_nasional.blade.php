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
    <span class="breadcrumb-item active">Statistik Nilai</span>
    <span class="breadcrumb-item active">Capaian Nilai Rata-rata Tiap Paket</span>
</nav>
<div class="row">
    <div class="col-lg-12">
        <div class="block">
            <ul class="nav nav-tabs nav-tabs-block" data-toggle="tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" href="#btabs-animated-slideright-home">Statistik Paket</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#btabs-animated-slideright-detail-sekolah">Detail</a>
                </li>
            </ul>
            <div class="block-content tab-content overflow-hidden">
                <div class="tab-pane fade fade-right show active" id="btabs-animated-slideright-home" role="tabpanel">
                    <div class="block">
                        <h4 class="font-w400" id='dinamis_siswa_teks'>
                            Capaian Nilai Rata-rata Tiap Paket
                        </h4>
                        <div class="row" style="margin-top: 50px;">
                            <div class="col-4">
                                <h6>Kurikulum</h6>
                                <select class="form-control js-example-basic-single" id="example-select" name="example-select" onchange="myFunction(this)" style="width: 100%">
                                    <option disabled selected>Pilih Kurikulum</option>
                                    @if(Auth()->user()->level == 'admin')
                                        <option value="2013">Kurikulum 2013</option>
                                        <option value="2006">Kurikulum 2006</option>
                                    @elseif(Auth()->user()->level == 'proktor')
                                        <option value="{{ Auth()->user()->sekolah->kurikulum }}">Kurikulum {{ Auth()->user()->sekolah->kurikulum }}</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="block-content block-content-full">
                            <div id="nilai"></div>
                        </div>
                        <div id="dinamis_insert">
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade fade-right" id="btabs-animated-slideright-detail-sekolah" role="tabpanel">
                    <div class="block">
                        <h4 class="font-w400" id='dinamis_siswa_teks'>
                            Capaian Nilai Rata-rata Tiap Paket
                        </h4>
                        <div class="row" style="margin-top: 50px;">
                            <div class="col-6">
                                <select class="form-control js-example-basic-single" id="example-select" name="example-select" onchange="myFunction2(this)" style="width: 100%">
                                    <option disabled selected>Pilih Mata Pelajaran</option>
                                    @foreach($mapel as $m)
                                        <option value="{{ $m->id }}" data-mapel=" {{ $m->nama }}" data-kurikulum=" {{ $m->kurikulum }}">{{ $m->kurikulum }} - {{ $m->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="block-content">
                            <h4 class="font-w400" id='dinamis_kota_teks'>
                            </h4>
                            @if(Auth()->user()->level == 'admin')
                                <div class="table-responsive" id="dinamis_table">
                                    <table class="table table-bordered table-striped table-hover dataTable js-basic-example" id="peringkat_kota-table">
                                        <thead>
                                            <tr>
                                                <th>Paket</th>
                                                <th>Rata-rata</th>
                                                <th>Jumlah Siswa</th>
                                                <th>Keterangan</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            @elseif(Auth()->user()->level == 'proktor')
                                <div class="table-responsive" id="dinamis_table">
                                    <table class="table table-bordered table-striped table-hover dataTable js-basic-example" id="peringkat_kota-table">
                                        <thead>
                                            <tr>
                                                <th>Paket</th>
                                                <th>Jumlah Siswa Sekolah</th>
                                                <th>Rata-rata Sekolah</th>
                                                <th>Jumlah Siswa Semua</th>    
                                                <th>Rata-rata Semua</th>
                                                <th>Keterangan</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('moreJS')
    <script src="{{ asset('js/devextreme/dx.all.js') }}"></script>
    <script>
        var table = '<table class="table table-bordered table-striped table-hover dataTable js-basic-example" id="peringkat_kota-table">'+
                        '<thead>'+
                            '<tr>'+
                            @if(Auth()->user()->level == 'admin')
                                '<th>Paket</th>'+
                                '<th>Rata-rata</th>'+
                                '<th>Jumlah Siswa</th>'+
                                '<th>Keterangan</th>'+
                            @else
                                '<th>Paket</th>'+
                                '<th>Jumlah Siswa Sekolah</th>'+
                                '<th>Rata-rata Sekolah</th>'+
                                '<th>Jumlah Siswa Semua</th>'+   
                                '<th>Rata-rata Semua</th>'+
                                '<th>Keterangan</th>'+
                            @endif
                            '</tr>'+
                        '</thead>'+
                    '</table>';

        function myFunction2(selectObject) {
            var value = selectObject.value;  

            var opt = selectObject.options[selectObject.selectedIndex];
            var kurikulum = opt.dataset.kurikulum
            var mapel = opt.dataset.mapel
            // console.log(value, kurikulum, mapel)
            getPaketDetail(value, kurikulum, mapel)
        }

        function getPaketDetail(value, kurikulum, mapel){
            $('#dinamis_table').empty();
            $('#dinamis_table').append(table);

            $('#peringkat_kota-table').DataTable( {
                "ajax": "{{ url('/ajax/rata2_paket/')}}"+"/"+value,
                "autoWidth": true,
                "ordering": false,
                "columns": [
                @if(Auth()->user()->level == 'admin')
                    { "data": "nama_baru" },
                    { "data": "nilai_rata_rata" },
                    { "data": "count_siswa" },
                    { "data": "keterangan" },
                @else
                    { "data": "nama_baru" },
                    { "data": "count_siswa_sekolah" },
                    { "data": "rata2_sekolah" },
                    { "data": "count_siswa" },
                    { "data": "nilai_rata_rata" },
                    { "data": "keterangan" },
                @endif
                ]
            });           
        }

        function myFunction(selectObject) {
            var value = selectObject.value;
            // console.log(value)
            value = value.toLowerCase()
            getPaketNilaiStat(value)
        }

        function getPaketNilaiStat(kurikulum){
            $.getJSON('{{ url('/ajax/pelajaran/')}}'+'/'+kurikulum).done(function(result) {
                getDataKurikulum(result);
            });
        }

        function getDataKurikulum(result){
            // console.log(result)
            $('#dinamis_insert').empty();
            result.forEach(appendHTML);
        }

        function appendHTML(item, index){
            // console.log(item);
            $('#dinamis_insert').append(getHTML(item));
            // console.log(item.id)
            $.getJSON('{{ url('/ajax/rata2_paket/')}}'+'/'+item.id).done(function(result) {
                // console.log(result)
                renderDataGrid2(result);
            });

            function renderDataGrid2(gridDataSource) {
                // console.log(gridDataSource.data[0].pelajaran_id)
                var sekolah_id = "#sekolah_" + gridDataSource.data[0].pelajaran_id
                $(sekolah_id).dxChart({
                    rotated: true,
                    dataSource: gridDataSource.data, 
                    series: {
                        argumentField: "nama_baru",
                        @if(Auth()->user()->level == 'admin')
                            valueField: "nilai_rata_rata",
                        @elseif(Auth()->user()->level == 'proktor')
                            valueField: "rata2_sekolah",
                        @endif
                        name: "Nilai rata-rata tiap paket",
                        type: "bar",
                        color: '#ffaa66'
                    },
                    valueAxis: {
                        title: {
                            text: "Nilai 0 - 100"
                        },
                        position: "bottom",
                        visualRange: [0, 100],
                        valueType: "numeric",
                        allowDecimals : false,
                    },
                    argumentAxis: {
                        title: {
                            text: 'Paket Pelajaran'
                        },
                        inverted: true,
                        position: "left",
                        label: {
                            overlappingBehavior: "rotate",
                            rotationAngle: 90
                        }
                    },
                    tooltip: {
                        enabled: true,
                        location: "edge",
                        customizeTooltip: function (arg) {
                            console.log(arg)
                            return {
                                text: "Nilai rata-rata paket "+arg.argumentText+": " + arg.valueText
                            };
                        }
                    },
                    export: {
                        enabled: true
                    },
                });
            }
        }

        function getHTML(d){
            return '<div class="block">'+
                '<h4 class="font-w400" id="dinamis_siswa_teks">'+
                    d.nama+
                '</h4>'+
                '<div class="block-content block-content-full">'+
                    '<div id="sekolah_'+d.id+'"></div>'+
                '</div>'+
            '</div>';
        }
    </script>
    <script type="text/javascript">
        $('.js-example-basic-single').select2({
            width: 'resolve'
        });
    </script>
    <!-- Page JS Plugins -->
    <script src="{{ asset('codebase/src/assets/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('codebase/src/assets/js/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <!-- Page JS Code -->
    <script src="{{ asset('codebase/src/assets/js/pages/be_tables_datatables.min.js')}}"></script>
@endsection