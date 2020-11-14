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
    <span class="breadcrumb-item active">Sekolah</span>
</nav>
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
@endsection

@section('moreJS')
    <script>
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
                    ajax: "{{ url('ajax/datatables/sekolah/siswa')}}/"+data.kd_rayon,
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
    <!-- Page JS Plugins -->
    <script src="{{ asset('codebase/src/assets/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('codebase/src/assets/js/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <!-- Page JS Code -->
    <script src="{{ asset('codebase/src/assets/js/pages/be_tables_datatables.min.js')}}"></script>
@endsection