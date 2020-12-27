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
    <span class="breadcrumb-item active">Analisis Butir Soal</span>
</nav>
<div class="row">
    <div class="col-lg-12">
        <div class="block">
            <ul class="nav nav-tabs nav-tabs-block" data-toggle="tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" href="#btabs-animated-slideright-statistik" id="peringkat_kota">Statistik</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#btabs-animated-slideright-detail" id="peringkat_sekolah">Detail Paket</a>
                </li>
            </ul>
            <div class="block-content tab-content overflow-hidden">
{{-- STATISTIK PAKET--}}
                <div class="tab-pane fade fade-right show active" id="btabs-animated-slideright-statistik" role="tabpanel">
                    <div class="block-content">
                        <h4 class="font-w400" id='dinamis_kota_teks'>
                            Statistik Paket
                        </h4>
                        <div class="table-responsive" id="dinamis_table">
                            {{-- table --}}
                        </div>
                    </div>
                </div>
{{-- DETAIL PAKET--}}
                <div class="tab-pane fade fade-right" id="btabs-animated-slideright-detail" role="tabpanel">
                    <div class="block-content">
                        <h4 class="font-w400" id="dinamis_sekolah_teks">
                            Detail Paket
                        </h4>
                        <div class="block">
                            <div class="block-header block-header-default bg-gd-primary">
                                <h3 classπ="block-title text-white">Mata Pelajaran</h3>
                            </div>
                            <div class="block-content">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover dataTable js-basic-example" id="kurikulums-table">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Kurikulum</th>
                                                <th>Mata Pelajaran</th>
                                                <th>Jenjang</th>
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
        function format ( d ) {
            return '<table class="table details-table" id="posts_kurikulum-'+d.id+'">'+
                '<thead>'+
                    '<tr>'+
                        '<th>Paket</th>'+
                        '<th></th>'+
                    '</tr>'+
                '</thead>'+
            '</table>';
        }
        $(function(){
            var table = $('#kurikulums-table').DataTable({
                "processing": true,
                "serverSide": true,
                "searchDelay": 1000,
                "autoWidth": false,
                "ajax":{
                    "url": "{{ url('ajax/datatables/pelajaran')}}",
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
                    { data: 'kurikulum'},
                    { data: 'nama'},
                    { data: 'jenjang'},
                ],
                "order": [[1, "asc"]]
            });
            $('#kurikulums-table tbody').on('click', 'td.details-control', function () {
                var tr = $(this).closest('tr');
                var row = table.row(tr);
                console.log(row.data())
                var tableId = 'posts_kurikulum-' + row.data().id;
                console.log(tableId)
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
                    ajax: "{{ url('ajax/datatables/paket')}}/"+data.id,
                    columns: [
                        { data: 'nama', name: 'nama' },
                        {data: 'action', name: 'action', orderable: false, searchable: false},
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