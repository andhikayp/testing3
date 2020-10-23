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
    <a class="breadcrumb-item" href="{{ url('/siswa') }}">Data Siswa</a>
    <span class="breadcrumb-item active">Data Siswa {{ $sekolah->nama }}</span>
</nav>
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
                    "url": "{{ url('ajax/datatables/siswa')}}/{{ $sekolah->id }}",
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
    <!-- Page JS Plugins -->
    <script src="{{ asset('codebase/src/assets/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('codebase/src/assets/js/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <!-- Page JS Code -->
    <script src="{{ asset('codebase/src/assets/js/pages/be_tables_datatables.min.js')}}"></script>
@endsection