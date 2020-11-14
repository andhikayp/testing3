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
    <a class="breadcrumb-item" href="{{ url('/siswa') }}">Sekolah</a>
    <span class="breadcrumb-item active">Data Siswa {{ $sekolah->nama }}</span>
</nav>
<div class="block">
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
                        <th></th>
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
                    "url": "{{ url('ajax/datatables/nilai')}}/{{ $sekolah->id }}",
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
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
                "order": [[0, "asc"]]
            });
        });
    </script>
    <script src="{{ asset('js/devextreme/dx.all.js') }}"></script>

    <!-- Page JS Plugins -->
    <script src="{{ asset('codebase/src/assets/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('codebase/src/assets/js/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <!-- Page JS Code -->
    <script src="{{ asset('codebase/src/assets/js/pages/be_tables_datatables.min.js')}}"></script>
@endsection