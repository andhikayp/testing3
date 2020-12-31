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
    #jenis_kelamin {
        max-width: 600px;
        margin: 0 auto
    }
</style>

<nav class="breadcrumb bg-white push">
    <a class="breadcrumb-item" href="{{ url('/dashboard') }}">Dashboard</a>
    @if(Auth()->user()->level == 'admin')
        <a class="breadcrumb-item" href="{{ url('/siswa') }}">Sekolah</a>
    @endif
    <span class="breadcrumb-item active">Data Siswa</span>
</nav>
<div class="row">
    <div class="col-md-6 col-xl-6">
        <div class="block">
            <div class="block-content" id="jenis_kelamin"></div>
        </div>
    </div>
    <div class="col-md-6 col-xl-6">
        <div class="block">
            <div class="block-content" id="jurusan"></div>
        </div>
    </div>
</div>
<div class="block">
    <div class="block-header block-header-default bg-gd-primary">
        <h3 class="block-title text-white">Data Siswa {{ $sekolah->nama }}</h3>
    </div>
    <div class="block-content">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover dataTable js-basic-example" id="users-table">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th>NISN</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Jurusan</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection

@section('moreJS')
    <script>
        $(function(){
            var table = $('#users-table').DataTable({
                "processing": true,
                "serverSide": true,
                "searchDelay": 1000,
                "autoWidth": false,
                "ajax":{
                    "url": "{{ url('ajax/datatables/siswa/siswa')}}/{{ $sekolah->id }}",
                    "dataType": "json",
                    "type": "GET",
                },
                "columns": [
                    { data: 'nama'},
                    { data: 'jenis_kelamin'},
                    { data: 'nisn'},
                    { data: 'username'},
                    { data: 'password_siswa'},
                    { data: 'jurusan'},
                ],
                "order": [[0, "asc"]]
            });
        });
    </script>
    <script>
        $.getJSON('{{ url('/ajax/grafik/siswa')}}/{{ $sekolah->id }}').done(function(result) {
            renderDataGrid(result);
        });
        function renderDataGrid(gridDataSource) {
            var jenis_kelamin = $("#jenis_kelamin").dxPieChart({
                adaptiveLayout: {
                    width: 300
                },
                palette: "office",
                dataSource: gridDataSource.jenis_kelamin,
                title: "Statistik Jenis Kelamin",
                margin: {
                    bottom: 0
                },
                legend: {
                    visible: true
                },
                animation: {
                    enabled: true
                },
                resolveLabelOverlapping: "none",
                "export": {
                    enabled: true
                },
                type: 'doughnut',
                series: [{
                    argumentField: "jenis_kelamin",
                    valueField: "total",
                    label: {
                        visible: true,
                        customizeText: function(arg) {
                            (arg.argumentText == "P") ? arg.argumentText="Perempuan" : arg.argumentText="Laki-laki"  
                            return arg.argumentText+': ' + arg.originalValue + ' Orang'+
                                "<br>(" + arg.percentText + ")";
                        },
                        connector: {
                            visible: true,
                            width: 1
                        }
                    }
                }]
            }).dxPieChart("instance");

            var jurusan = $("#jurusan").dxPieChart({
                adaptiveLayout: {
                    width: 300
                },
                palette: "ocean",
                dataSource: gridDataSource.jurusan,
                title: "Statistik Jurusan",
                margin: {
                    bottom: 0
                },
                legend: {
                    visible: true
                },
                animation: {
                    enabled: true
                },
                resolveLabelOverlapping: "none",
                "export": {
                    enabled: true
                },
                type: 'doughnut',
                series: [{
                    argumentField: "jurusan",
                    valueField: "total",
                    label: {
                        visible: true,
                        customizeText: function(arg) {
                            return arg.argumentText+': ' + arg.originalValue + ' Orang'+
                                "<br>(" + arg.percentText + ")";
                        },
                        connector: {
                            visible: true,
                            width: 1
                        }
                    }
                }]
            }).dxPieChart("instance");
        }
    </script>
    <script src="{{ asset('js/devextreme/dx.all.js') }}"></script>

    <!-- Page JS Plugins -->
    <script src="{{ asset('codebase/src/assets/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('codebase/src/assets/js/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <!-- Page JS Code -->
    <script src="{{ asset('codebase/src/assets/js/pages/be_tables_datatables.min.js')}}"></script>
@endsection