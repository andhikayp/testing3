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
    <span class="breadcrumb-item active">Bank Soal</span>
</nav>
<div class="row">
    <div class="col-lg-12">
        <div class="block">
            <ul class="nav nav-tabs nav-tabs-block" data-toggle="tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" href="#btabs-animated-slideright-detail" id="peringkat_sekolah">Bank Soal</a>
                </li>
            </ul>
            <div class="block-content tab-content overflow-hidden">
                <div class="tab-pane fade fade-right show active" id="btabs-animated-slideright-detail" role="tabpanel">
                    <div class="block-content">
                        <h4 class="font-w400" id="dinamis_sekolah_teks">
                            Detail Paket
                        </h4>
                        <div class="block">
                            <div class="block-content">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover dataTable js-basic-example" id="kurikulums-table">
                                        <thead>
                                            <tr>
                                                <th>Kurikulum</th>
                                                <th>Mata Pelajaran</th>
                                                <th>Jenjang</th>
                                                <th>Aksi</th>
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
        $(function(){
            var table = $('#kurikulums-table').DataTable({
                "processing": true,
                "serverSide": true,
                "searchDelay": 1000,
                "autoWidth": false,
                "ajax":{
                    "url": "{{ url('ajax/datatables/pelajaran/action')}}",
                    "dataType": "json",
                    "type": "GET",
                },
                "columns": [
                    { data: 'kurikulum'},
                    { data: 'nama'},
                    { data: 'jenjang'},
                    { data: 'action'},
                ],
                "order": [[1, "asc"]]
            });
        });
    </script>
    <!-- Page JS Plugins -->
    <script src="{{ asset('codebase/src/assets/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('codebase/src/assets/js/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <!-- Page JS Code -->
    <script src="{{ asset('codebase/src/assets/js/pages/be_tables_datatables.min.js')}}"></script>
@endsection