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
    <span class="breadcrumb-item active">Detail Ujian</span>
</nav>
<div class="row">
    <div class="col-lg-12">
        <div class="block">
            <ul class="nav nav-tabs nav-tabs-block" data-toggle="tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" href="#btabs-animated-slideright-home">Grafik</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#btabs-animated-slideright-profile">Ujian</a>
                </li>
                {{-- <li class="nav-item ml-auto">
                    <a class="nav-link" href="#btabs-animated-slideright-settings"><i class="si si-settings"></i></a>
                </li> --}}
            </ul>
            <div class="block-content tab-content overflow-hidden">
                <div class="tab-pane fade fade-right show active" id="btabs-animated-slideright-home" role="tabpanel">
                    {{-- <h4 class="font-w400">Home Content</h4>
                    <p>Content slides in to the right..</p> --}}
                    {{-- <div class="demo-container">
                        <div id="chart"></div>
                    </div> --}}
                    <div class="block-content block-content-full">
                        <div id="nilai"></div>
                    </div>
                </div>
                <div class="tab-pane fade fade-right" id="btabs-animated-slideright-profile" role="tabpanel">
                    {{-- <h4 class="font-w400">Profile Content</h4>
                    <p>Content slides in to the right..</p> --}}
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
                {{-- <div class="tab-pane fade fade-right" id="btabs-animated-slideright-settings" role="tabpanel">
                    <h4 class="font-w400">Settings Content</h4>
                    <p>Content slides in to the right..</p>
                </div> --}}
            </div>
        </div>
    </div>
</div>
@endsection
@section('moreJS')
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
                        '<th>Nama</th>'+
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
                "order": [[1, "asc"]]
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
                        { data: 'sesi', name: 'sesi' },
                        { data: 'waktu_mulai', name: 'waktu_mulai' },
                        { data: 'waktu_selesai', name: 'waktu_selesai' },
                        {data: 'durasi', name: 'durasi', orderable: false, searchable: false},
                    ]
                })
            }
        });
    </script>
    <script src="{{ asset('js/devextreme/dx.all.js') }}"></script>
    
    <!-- Page JS Plugins -->
    <script src="{{ asset('codebase/src/assets/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('codebase/src/assets/js/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <!-- Page JS Code -->
    <script src="{{ asset('codebase/src/assets/js/pages/be_tables_datatables.min.js')}}"></script>
@endsection