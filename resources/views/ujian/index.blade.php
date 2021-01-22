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
    #nilai {
        height: 550px;
        width: 100%;
    }
</style>

<nav class="breadcrumb bg-white push">
    <a class="breadcrumb-item" href="{{ url('/dashboard') }}">Dashboard</a>
    <span class="breadcrumb-item active">Detail Ujian</span>
</nav>
<div class="row">
    <div class="col-lg-12">
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error')}}
            </div>
        @elseif(session('success'))
            <div class="alert alert-success">
                {{ session('success')}}                        
            </div>
        @endif
        <div class="block">
            <ul class="nav nav-tabs nav-tabs-block" data-toggle="tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" href="#btabs-animated-slideright-home">Grafik</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#btabs-animated-slideright-profile">Ujian</a>
                </li>
            </ul>
            <div class="block-content tab-content overflow-hidden">
                <div class="tab-pane fade fade-right show active" id="btabs-animated-slideright-home" role="tabpanel">
                    <div class="block-content block-content-full">
                        <div id="nilai"></div>
                    </div>
                </div>
                <div class="tab-pane fade fade-right" id="btabs-animated-slideright-profile" role="tabpanel">
                    <div>
                        <a href="{{ url('/ujian/tambah/') }}" class="float-right mb-10">
                            <button class="btn btn-primary min-width-125">
                                <span><i class="si si-plus mr-2"></i></span><span>Tambah Jadwal Ujian</span>
                            </button>
                        </a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-basic-example" id="users-table">
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
            </div>
        </div>
    </div>
</div>
@endsection
@section('moreJS')
    <script src="{{ asset('js/devextreme/dx.all.js') }}"></script>
    <script>
        $.getJSON('{{ url('/json/ujian')}}').done(function(result) {
            renderDataGrid(result);
        });
        function renderDataGrid(gridDataSource) {
            console.log(gridDataSource)
            var tanpa_koreksi = $("#nilai").dxChart({
                dataSource: gridDataSource, 
                series: {
                    argumentField: "tanggal",
                    valueField: "pelaksanaan",
                    name: "Jumlah Paket yang Diujikan",
                    type: "bar",
                    color: '#ffaa66'
                },
                valueAxis: {
                    title: {
                        text: "Jumlah"
                    },
                    position: "bottom",
                    valueType: "numeric",
                    allowDecimals : false,
                },
                argumentAxis: {
                    title: {
                        text: 'Tanggal Pelaksanaan'
                    },
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
                        return {
                            text: arg.seriesName + " : " + arg.valueText
                        };
                    }
                },
                export: {
                    enabled: true
                },
            });
        }
    </script>
    <script>
        function formatUjian ( d ) {
            return '<table class="table details-table" id="posts-'+d.date+'">'+
                '<thead>'+
                    '<tr>'+
                        '<th>Nama Pelajaran</th>'+
                        '<th>Kurikulum</th>'+
                        '<th>Pelaksanaan</th>'+
                        '<th>Sesi</th>'+
                        '<th>Waktu Mulai</th>'+
                        '<th>Waktu Selesai</th>'+
                        '<th>Durasi</th>'+
                    '</tr>'+
                '</thead>'+
            '</table>';
        }
        $(function(){
            var table = $('#users-table').DataTable({
                "processing": true,
                "serverSide": true,
                "searchDelay": 1000,
                "autoWidth": false,
                "ajax":{
                    "url": "{{ url('ajax/datatables/ujian')}}",
                    "dataType": "json",
                    "type": "GET",
                },
                "columns": [
                    {
                        "className": 'details-control',
                        "orderable": false,
                        "data": null,
                        "defaultContent": '',
                    },
                    { data: 'tanggal'},
                    { data: 'pelaksanaan'},
                ],
                "order": false,
            });
            $('#users-table tbody').on('click', 'td.details-control', function () {
                var tr = $(this).closest('tr');
                var row = table.row(tr);
                console.log(row.data())
                var tableId = 'posts-' + row.data().date;
                console.log(tableId)
                if (row.child.isShown()) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                } else {
                    // Open this row
                    row.child(formatUjian(row.data())).show();
                    initTableUjian(tableId, row.data());
                    tr.addClass('shown');
                    tr.next().find('td').addClass('no-padding bg-gray');
                }
            });
            function initTableUjian(tableId, data) {
                console.log(tableId)
                $('#' + tableId).DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ url('ajax/datatables/ujian')}}/"+data.date,
                    columns: [
                        { data: 'deskripsi', name: 'deskripsi' },
                        { data: 'kurikulum', name: 'kurikulum' },
                        { data: 'pelaksanaan', name: 'pelaksanaan' },
                        { data: 'sesi', name: 'sesi' },
                        { data: 'waktu_mulai', name: 'waktu_mulai' },
                        { data: 'waktu_selesai', name: 'waktu_selesai' },
                        {data: 'durasi', name: 'durasi', orderable: false, searchable: false},
                    ]
                })
            }
        });
    </script>    
    <!-- Page JS Plugins -->
    <script src="{{ asset('codebase/src/assets/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('codebase/src/assets/js/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <!-- Page JS Code -->
    <script src="{{ asset('codebase/src/assets/js/pages/be_tables_datatables.min.js')}}"></script>
@endsection