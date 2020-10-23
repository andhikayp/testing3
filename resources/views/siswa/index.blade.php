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
    <a class="breadcrumb-item" href="{{ url('/dashboard') }}">Dashboard</a>
    <span class="breadcrumb-item active">Data Siswa</span>
</nav>
<div class="block">
    <div class="block-header block-header-default bg-gd-primary">
        <h3 class="block-title text-white">Data Siswa</h3>
    </div>
    <div class="block-content">
        <div class="table-responsive">
            {{-- <table class="table table-bordered table-striped table-hover dataTable js-basic-example" id="userTable"> --}}
            <table id="users-table" class="">
                <thead>
                    <tr>
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
    <script>hljs.initHighlightingOnLoad();</script>
    <script>
        $(function(){
            $('#users-table').DataTable({
                "processing": true,
                "serverSide": true,
                "searchDelay": 1000,
                "autoWidth": false,
                "ajax":{
                    "url": "{{ url('siswa/ajax/datatables')}}",
                    "dataType": "json",
                    "type": "GET",
                },
                "columns": [
                    {
                        "className": 'details-control',
                        "orderable": false,
                        "searchable": false,
                        "data": null,
                        "defaultContent": ''
                    },
                    { data: 'kd_rayon'},
                    { data: 'nama'},
                ],
                "order": [[1, "asc"]]
            });
        });
        $('#users-table tbody').on('click', 'td.details-control', function () {
            console.log("wkkw")
            var tr = $(this).closest('tr');
            var row = table.row( tr );

            if ( row.child.isShown() ) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            }
            else {
                // Open this row
                row.child( template(row.data()) ).show();
                tr.addClass('shown');
            }
        });
    </script>
    <script id="details-template" type="text/x-handlebars-template">
    <table class="table">
        <tr>
            <td>Full name:</td>
            <td></td>
        </tr>
        <tr>
            <td>Email:</td>
            <td></td>
        </tr>
        <tr>
            <td>Extra info:</td>
            <td>And any further details here (images etc)...</td>
        </tr>
    </table>
</script>
    <!-- Page JS Plugins -->
    {{-- <script src="{{ asset('codebase/src/assets/js/plugins/datatables/jquery.dataTables.min.js')}}"></script> --}}
    {{-- <script src="{{ asset('codebase/src/assets/js/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script> --}}
    <!-- Page JS Code -->
    {{-- <script src="{{ asset('codebase/src/assets/js/pages/be_tables_datatables.min.js')}}"></script> --}}

    <script src="{{ asset('datatables/js/jquery.min.js') }}"></script>
    <script src="{{ asset('datatables/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('datatables/js/jquery.dataTables.min.js') }}"></script>
    {{-- <script src="{{ asset('datatables/js/datatables.bootstrap.js') }}"></script> --}}
    <script src="{{ asset('datatables/js/handlebars.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mark.js/8.0.0/jquery.mark.min.js"></script>
@endsection