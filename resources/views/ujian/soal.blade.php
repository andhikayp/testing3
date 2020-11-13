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
    <a class="breadcrumb-item" href="{{ url('/ujian') }}">Detail Ujian</a>
    <span class="breadcrumb-item active">Soal</span>
</nav>
<div class="block">
    <div class="block-header block-header-default bg-gd-primary">
        <h3 class="block-title text-white">Soal Paket {{ str_replace('_', ' ', $paket->nama) }}</h3>
    </div>
    <div class="block-content">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover dataTable js-basic-example" id="users-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Soal</th>
                        <th>Pilihan A</th>
                        <th>Pilihan B</th>
                        <th>Pilihan C</th>
                        <th>Pilihan D</th>
                        <th>Pilihan E</th>
                        <th>Kunci Jawaban</th>
                        <th>Tipe Soal</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no=1;
                    @endphp
                    @foreach($soal as $soals)
                        <tr>
                            <td>{{$no++}}</td>
                            <td>
                                {!! $soals->deskripsi !!}
                            </td>
                            <td>{!! $soals->pilihan_a !!}</td>
                            <td>{!! $soals->pilihan_b !!}</td>
                            <td>{!! $soals->pilihan_c !!}</td>
                            <td>{!! $soals->pilihan_d !!}</td>
                            <td>{!! $soals->pilihan_e !!}</td>
                            <td>{!! $soals->kunci_jawaban !!}</td>
                            <td>{{ str_replace('_', ' ', $soals->tipe_soal) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('moreJS')
    <script>
        $(function(){
            var table = $('#users-table').DataTable({
                "scrollX": true
            });
        });
    </script>
    <!-- Page JS Plugins -->
    <script src="{{ asset('codebase/src/assets/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('codebase/src/assets/js/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <!-- Page JS Code -->
    <script src="{{ asset('codebase/src/assets/js/pages/be_tables_datatables.min.js')}}"></script>
@endsection