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
</nav>
<div class="row">
    <div class="col-lg-12">
        <div class="block">
            <ul class="nav nav-tabs nav-tabs-block" data-toggle="tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" href="#btabs-animated-slideright-home">Statistik Jawa Timur</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#btabs-animated-slideright-detail-sekolah">Detail</a>
                </li>
            </ul>
            <div class="block-content tab-content overflow-hidden">
                <div class="tab-pane fade fade-right show active" id="btabs-animated-slideright-home" role="tabpanel">
                    <div class="block">
                        <h4 class="font-w400" id='dinamis_siswa_teks'>
                            Nilai Rata-rata tiap Kota & Kabupaten
                        </h4>
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-6">
                                <select class="form-control js-example-basic-single" id="example-select" name="example-select" onchange="myFunction(this)" style="width: 100%">
                                    <option value="All">Semua</option>
                                    <option value="2013">Kurikulum 2013</option>
                                    <option value="2006">Kurikulum 2006</option>
                                </select>
                            </div>
                        </div>
                        <div class="block-content block-content-full">
                            <div id="nilai"></div>
                        </div>
                    </div>

                    <div class="block">
                        <h4 class="font-w400" id='dinamis_siswa_teks'>
                            Sebaran Nilai Rata-rata tiap Sekolah
                        </h4>
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-6">
                                <select class="form-control js-example-basic-single" id="example-select" name="example-select" onchange="myFunction2(this)" style="width: 100%">
                                    <option value="All">Semua</option>
                                    <option value="2013">Kurikulum 2013</option>
                                    <option value="2006">Kurikulum 2006</option>
                                </select>
                            </div>
                        </div>
                        <div class="block-content block-content-full">
                            <div id="sekolah"></div>
                        </div>
                    </div>

                </div>
                <div class="tab-pane fade fade-right" id="btabs-animated-slideright-detail-sekolah" role="tabpanel">
                    <div class="block">
                        <div class="block-header block-header-default bg-gd-primary">
                            <h3 class="block-title text-white">Sekolah</h3>
                        </div>
                        <div class="block-content">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-basic-example" id="users-table">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Kode Rayon</th>
                                            <th>Kota / Kabupaten</th>
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


@endsection

@section('moreJS')
    <script>
        getStatJawaTimur('all')
        getStatJawaTimurSekolah('all')

        function myFunction(selectObject) {
            var value = selectObject.value;
            value = value.toLowerCase()
            getStatJawaTimur(value)
        }

        function getStatJawaTimur(kurikulum) {
            $.getJSON('{{ url('/ajax/peringkat_kota/')}}'+'/'+kurikulum).done(function(result) {
                renderDataGrid(result);
            });
        }

        function renderDataGrid(gridDataSource) {
            console.log(gridDataSource.data)
            var tanpa_koreksi = $("#nilai").dxChart({
                rotated: true,
                dataSource: gridDataSource.data, 
                series: {
                    argumentField: "nama",
                    valueField: "nilai_rata_rata",
                    name: "Rata-rata nilai",
                    type: "bar",
                    color: '#ffaa66'
                },
                valueAxis: {
                    title: {
                        text: "Nilai skala 0-100"
                    },
                    position: "bottom",
                    visualRange: [0, 100],
                    valueType: "numeric",
                    allowDecimals : false,
                },
                argumentAxis: {
                    title: {
                        text: 'Kota/Kabupaten'
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

        function myFunction2(selectObject) {
            var value = selectObject.value;
            value = value.toLowerCase()
            getStatJawaTimurSekolah(value)
        }

        function getStatJawaTimurSekolah(kurikulum) {
            $.getJSON('{{ url('/ajax/sebaran_peringkat_sekolah/')}}'+'/'+kurikulum).done(function(result) {
                renderDataGrid2(result);
            });
        }

        function renderDataGrid2(gridDataSource) {
            console.log(gridDataSource.data)
            var tanpa_koreksi = $("#sekolah").dxChart({
                rotated: true,
                dataSource: gridDataSource.data, 
                series: {
                    argumentField: "nama",
                    valueField: "jumlah",
                    name: "nama",
                    type: "bar",
                    color: '#ffaa66'
                },
                valueAxis: {
                    title: {
                        text: "Nilai skala 0-100"
                    },
                    position: "bottom",
                    visualRange: [0, null],
                    valueType: "numeric",
                    allowDecimals : false,
                },
                argumentAxis: {
                    title: {
                        text: 'Kota/Kabupaten'
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


        function format ( d ) {
            return '<table class="table details-table" id="posts-'+d.kd_rayon+'">'+
                '<thead>'+
                    '<tr>'+
                        '<th>Nama</th>'+
                        '<th>Alamat</th>'+
                        '<th>Kode</th>'+
                        '<th>Kurikulum</th>'+
                        '<th></th>'+
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
                    "url": "{{ url('ajax/datatables/siswa')}}",
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
                    { data: 'kd_rayon'},
                    { data: 'nama'},
                ],
                "order": [[1, "asc"]]
            });

            $('#users-table tbody').on('click', 'td.details-control', function () {
                var tr = $(this).closest('tr');
                var row = table.row(tr);
                var tableId = 'posts-' + row.data().kd_rayon;

                if (row.child.isShown()) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                } else {
                    // Open this row
                    row.child(format(row.data())).show();
                    initTable(tableId, row.data());
                    tr.addClass('shown');
                    tr.next().find('td').addClass('no-padding bg-gray');
                }
            });

            function initTable(tableId, data) {
                $('#' + tableId).DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ url('ajax/datatables/sekolah/nilai')}}/"+data.kd_rayon,
                    columns: [
                        { data: 'nama', name: 'nama' },
                        { data: 'alamat', name: 'alamat' },
                        { data: 'kode', name: 'kode' },
                        { data: 'kurikulum', name: 'kurikulum' },
                        {data: 'action', name: 'action', orderable: false, searchable: false},
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