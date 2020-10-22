@extends('template.base.app')
@section('title', ' Dashboard')

@section('sidebar')
    @include('template.base.sidebar')
@endsection

@section('header')
    @include('template.base.header')
@endsection

@section('content')
<nav class="breadcrumb bg-white push">
    <a class="breadcrumb-item" href="">Dashboard</a>
    <span class="breadcrumb-item active">Manajemen User Petugas</span>
</nav>
<div class="block">
    <div class="block-header block-header-default bg-primary">
        <h3 class="block-title">Manajemen User Petugas</h3>
    </div>
    <div class="block-content">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover dataTable js-basic-example" id="userTable">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Sekolah</th>
                        <th>Username</th>
                        <th>Level</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection

@section('moreJS')
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> --}}
    {{-- <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script> --}}
    {{-- <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.js"></script> --}}
    <script>
        $(function(){
            $('#userTable').DataTable({
                "processing": true,
                "serverSide": true,
                "searchDelay": 1000,
                "autoWidth": false,
                "ajax":{
                    "url": "{{ url('users/ajax/datatables')}}",
                    "dataType": "json",
                    "type": "POST",
                    "data":{ _token: "{{csrf_token()}}"}
                },
                "columns": [
                    { "data": "nama"},
                    { "data": "sekolah"},
                    { "data": "username"},
                    { "data": "level"},
                    { "data": "action", "orderable": false, "width": "28%"}
                ],
                "order": [[2, "asc"]]
            });
        });
    </script>

    <!-- Page JS Plugins -->
    <script src="{{ asset('codebase/src/assets/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('codebase/src/assets/js/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <!-- Page JS Code -->
    <script src="{{ asset('codebase/src/assets/js/pages/be_tables_datatables.min.js')}}"></script>


@endsection