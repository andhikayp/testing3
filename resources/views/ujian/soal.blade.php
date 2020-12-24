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
                        <th rowspan="2" style="text-align: center; vertical-align: middle;">No</th>
                        <th rowspan="2" style="text-align: center; vertical-align: middle;">Soal</th>
                        <th colspan="4" style="text-align: center; vertical-align: middle;">Statistik Butir</th>

                        <th colspan="2" style="text-align: center; vertical-align: middle;">Statistik Pilihan Jawaban</th>
                        <th rowspan="2" style="text-align: center; vertical-align: middle;">Keterangan</th>
                    </tr>
                    <tr>
                        <th style="text-align: center; vertical-align: middle;">Kunci Jawaban</th>
                        <th style="text-align: center; vertical-align: middle;">
                            <a href="#" data-toggle="tooltip" title="Pengukuran seberapa besar derajat kesukaran suatu soal.">Tingkat Kesukaran</a>
                        </th>
                        <th style="text-align: center; vertical-align: middle;">
                            <a href="#" data-toggle="tooltip" title="Pengukuran sejauh mana suatu butir soal mampu membedakan peserta didik yang sudah menguasai kompetensi dengan peserta didik yang belum menguasai kompetensi.">Daya Pembeda</a>
                        </th>
                        <th>Reliabilitas</th>
                        <th>Pilihan</th>
                        <th>Fungsi Pengecoh</th>
                    </tr>
                </thead>
                <tbody>
                    @php 
                        $no=1;
                    @endphp
                    @foreach($all_soal as $soal)
                    <tr>
                        <td class="" rowspan="5">{{ $no++ }}</td>
                        <td class="" rowspan="5">
                            {!! $soal->deskripsi !!}
                            <div class="row" style="margin-top: -10px;">
                                <div class="col-1">A).</div>
                                <div class="col-11" style="margin-left: -15px;">{!! $soal->pilihan_a !!}</div>
                            </div>
                            <div class="row" style="margin-top: -20px;">
                                <div class="col-1">B).</div>
                                <div class="col-11" style="margin-left: -15px;">{!! $soal->pilihan_b !!}</div>
                            </div>
                            <div class="row" style="margin-top: -20px;">
                                <div class="col-1">C).</div>
                                <div class="col-11" style="margin-left: -15px;">{!! $soal->pilihan_c !!}</div>
                            </div>
                            <div class="row" style="margin-top: -20px;">
                                <div class="col-1">D).</div>
                                <div class="col-11" style="margin-left: -15px;">{!! $soal->pilihan_d !!}</div>
                            </div>
                            <div class="row" style="margin-top: -20px;">
                                <div class="col-1">E).</div>
                                <div class="col-11" style="margin-left: -15px;">{!! $soal->pilihan_e !!}</div>
                            </div>
                        </td>
                        <td class="text-center" rowspan="5" style="font-weight: bold;">
                            {{ strtoupper($soal->kunci_jawaban) }}
                        </td>
                        {{-- <td class="text-center" style="font-weight: bold;">
                            {{ number_format((float)$soal->analisis->tingkat_kesulitan, 2, '.', '') }}% <br>
                            @if($soal->analisis->tingkat_kesulitan > 0.70)
                                (Sulit)
                            @elseif($soal->analisis->tingkat_kesulitan > 0.3)
                                (Sedang)
                            @else
                                (Mudah)
                            @endif
                        </td> --}}
                        <td class="text-center" rowspan="5" style="font-weight: bold;">
                            {{ number_format((float)$soal->analisis->tingkat_kesukaran, 4, '.', '') }} <br>
                            @if($soal->analisis->tingkat_kesukaran > 0.70)
                                (Mudah)
                            @elseif($soal->analisis->tingkat_kesukaran > 0.3)
                                (Sedang)
                            @else
                                (Sulit)
                            @endif
                        </td>

                        <td class="text-center" rowspan="5" style="font-weight: bold;">
                            @if($soal->tipe_soal == 'pilihan_ganda' && $soal->jumlah_siswa!=0)
                                @php
                                    $daya_pembeda = ($soal->analisis->salah_bawah-$soal->analisis->salah_atas)/($soal->jumlah_siswa*0.27);
                                @endphp
                                {{ number_format((float)($daya_pembeda), 4, '.', '') }} <br>
                                @if($daya_pembeda > 0.4)
                                    (Sangat baik)
                                @elseif($daya_pembeda > 0.3)
                                    (Cukup baik)
                                @elseif($daya_pembeda > 0.2)
                                    (Revisi)
                                @else
                                    (Ditolak)
                                @endif
                            @endif
                        </td>
                        <td rowspan="5">0</td>
                        <td class="text-center" @if($soal->kunci_jawaban=="a") style="font-weight: bold;" @endif>
                            Pilihan A
                        </td>
                        <td>
                            @if($soal->jumlah_siswa > 0)
                                {{ number_format((float)( $soal->jawaban_a/$soal->jumlah_siswa), 4, '.', '')  }}
                            @endif
                        </td>
                        <td rowspan="5">Keterangan</td>
                    </tr>
                    <tr>
                        <td class="text-center"  @if($soal->kunci_jawaban=="b") style="font-weight: bold;" @endif>
                            Pilihan B
                        </td>
                        <td>
                            @if($soal->jumlah_siswa > 0)
                                {{ number_format((float)( $soal->jawaban_b/$soal->jumlah_siswa), 4, '.', '')  }}</td>
                            @endif
                    </tr>
                    <tr>
                        <td class="text-center"  @if($soal->kunci_jawaban=="c") style="font-weight: bold;" @endif>
                            Pilihan C
                        </td>
                        <td>
                            @if($soal->jumlah_siswa > 0)
                                {{ number_format((float)( $soal->jawaban_c/$soal->jumlah_siswa), 4, '.', '')  }}</td>
                            @endif
                    </tr>
                    <tr>
                        <td class="text-center"  @if($soal->kunci_jawaban=="d") style="font-weight: bold;" @endif>
                            Pilihan D
                        </td>
                        <td>
                            @if($soal->jumlah_siswa > 0)
                                {{ number_format((float)( $soal->jawaban_d/$soal->jumlah_siswa), 4, '.', '')  }}</td>
                            @endif
                    </tr>
                    <tr>
                        <td class="text-center"  @if($soal->kunci_jawaban=="e") style="font-weight: bold;" @endif>
                            Pilihan E
                        </td>
                        <td>
                            @if($soal->jumlah_siswa > 0)
                                {{ number_format((float)( $soal->jawaban_e/$soal->jumlah_siswa), 4, '.', '')  }}
                            @endif
                        </td>
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
                "ordering": true,
            });
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
    <!-- Page JS Plugins -->
    <script src="{{ asset('codebase/src/assets/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('codebase/src/assets/js/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <!-- Page JS Code -->
    <script src="{{ asset('codebase/src/assets/js/pages/be_tables_datatables.min.js')}}"></script>
@endsection