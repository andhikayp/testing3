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
    <a class="breadcrumb-item" href="{{ url('/nilai') }}">Sekolah</a>
    <a class="breadcrumb-item" href="{{ url('/nilai', ['id'=>$ujian_siswa->user->sekolah->id]) }}">Data Siswa</a>
    <a class="breadcrumb-item" href="{{ url('/nilai', ['sekolah'=>$ujian_siswa->user->sekolah->id, 'id'=>$ujian_siswa->user->id]) }}">Nilai</a>
    <span class="breadcrumb-item active">Analisis Soal</span>
</nav>
<div class="block">
    <div class="block-header block-header-default bg-gd-primary">
        <h3 class="block-title text-white">
            Analisis Soal {{ $ujian_siswa->paket->pelajaran->nama }} - {{ $ujian_siswa->user->nama }}
        </h3>
    </div>
    <div class="block-content">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover dataTable js-basic-example" id="users-table">
                <thead>
                    <tr>
                        <th rowspan="2" style="text-align: center; vertical-align: middle;">Soal</th>
                        <th rowspan="2" style="text-align: center; vertical-align: middle;">Jawaban Siswa</th>
                        <th rowspan="2" style="text-align: center; vertical-align: middle;">Kunci Jawaban</th>
                        <th rowspan="2" style="text-align: center; vertical-align: middle;">Tingkat Kesulitan</th>
                        <th colspan="2" style="text-align: center; vertical-align: middle;">Persentase menjawab benar</th>
                    </tr>
                    <tr>
                        <th>Keseluruhan</th>
                        <th>Sekolah</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($all_soal as $soal)
                    <tr>
                        <td class="">
                            {!! $soal->deskripsi !!}
                            <div class="row" style="margin-top: -10px;">
                                <div class="col-1">A).</div>
                                <div class="col-11" style="margin-left: -35px;">{!! $soal->pilihan_a !!}</div>
                            </div>
                            <div class="row" style="margin-top: -20px;">
                                <div class="col-1">B).</div>
                                <div class="col-11" style="margin-left: -35px;">{!! $soal->pilihan_b !!}</div>
                            </div>
                            <div class="row" style="margin-top: -20px;">
                                <div class="col-1">C).</div>
                                <div class="col-11" style="margin-left: -35px;">{!! $soal->pilihan_c !!}</div>
                            </div>
                            <div class="row" style="margin-top: -20px;">
                                <div class="col-1">D).</div>
                                <div class="col-11" style="margin-left: -35px;">{!! $soal->pilihan_d !!}</div>
                            </div>
                            <div class="row" style="margin-top: -20px;">
                                <div class="col-1">E).</div>
                                <div class="col-11" style="margin-left: -35px;">{!! $soal->pilihan_e !!}</div>
                            </div>
                        </td>
                        <td class="text-center" style="font-weight: bold;">
                            {{ $soal->jawaban_siswa }}
                        </td>
                        <td class="text-center" style="font-weight: bold;">
                            {{ $soal->kunci_jawaban }}
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
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
        $(document).ready(function(){
            $('#users-table').DataTable({
                "autoWidth": true,
                "ordering": false,
            });
        });
    </script>
    {{-- <script>
        $(function(){
            var table = $('#users-table').DataTable({
                "processing": true,
                "serverSide": true,
                "searchDelay": 1000,
                "autoWidth": false,
                "ajax":{
                    "url": "{{ url('ajax/datatables/soal')}}/{{$paket->id}}",
                    "dataType": "json",
                    "type": "GET",
                },
                "columns": [
                    { 
                        data: null,
                        sortable: false, 
                        render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }  
                    },
                    { data: 'deskripsi'},
                    { data: 'pilihan_a'},
                    { data: 'pilihan_b'},
                    { data: 'pilihan_c'},
                    { data: 'pilihan_d'},
                    { data: 'pilihan_e'},
                    { data: 'kunci_jawaban'},
                    { data: 'tipe_soal'},
                ],
            });
        });
    </script> --}}
    <!-- Page JS Plugins -->
    <script src="{{ asset('codebase/src/assets/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('codebase/src/assets/js/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <!-- Page JS Code -->
    <script src="{{ asset('codebase/src/assets/js/pages/be_tables_datatables.min.js')}}"></script>
@endsection