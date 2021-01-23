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
    #chart {
        height: 450px;
    }
</style>
<nav class="breadcrumb bg-white push">
    <a class="breadcrumb-item" href="{{ url('/dashboard') }}">Dashboard</a>
    <a class="breadcrumb-item" href="{{ url('/soal') }}">Analisis Butir Soal</a>
    <span class="breadcrumb-item active">Paket</span>
</nav>
<div class="row">
    <div class="col-lg-12">
        <div class="block">
            <ul class="nav nav-tabs nav-tabs-block" data-toggle="tabs" role="tablist">
            @if($uji)
                <li class="nav-item">
                    <a class="nav-link active" href="#btabs-animated-slideright-statistik" id="peringkat_kota">Statistik</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#btabs-animated-slideright-detail" id="peringkat_sekolah">Detail Pilihan Ganda</a>
                </li>
                <li class="nav-item ml-auto">
                    <a class="nav-link" href="" onclick="cetak_soal()"><i class="fa fa-print"><span class="ml-1">Cetak Soal</span></i></a>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link active" href="#btabs-animated-slideright-detail" id="peringkat_sekolah">Detail Pilihan Ganda</a>
                </li>
                <li class="nav-item ml-auto">
                    <a class="nav-link" href="" onclick="cetak_soal()"><i class="fa fa-print"><span class="ml-1">Cetak Soal</span></i></a>
                </li>
            @endif
            </ul>
            <div class="block-content tab-content overflow-hidden">
{{-- STATISTIK --}}
                <div class="tab-pane fade fade-right @if($uji) show active @endif" id="btabs-animated-slideright-statistik" role="tabpanel">
                    <div class="block-content">
                        <h4 class="font-w400" id='dinamis_kota_teks'>
                            Statistik Analisis Butir Soal Paket {{ str_replace('_', ' ', $paket->nama) }}
                        </h4>
                        <div class="block-content block-content-full">
                            <div class="row py-20">
                                <div class="col-6 text-right border-r">
                                    <div class="js-appear-enabled animated fadeInLeft" data-toggle="appear" data-class="animated fadeInLeft">
                                        <div class="font-size-h3 font-w600 text-info">{{ count($soal_pilgan) }}</div>
                                        <div class="font-size-sm font-w600 text-uppercase text-muted">Soal Pilihan Ganda</div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="js-appear-enabled animated fadeInRight" data-toggle="appear" data-class="animated fadeInRight">
                                        <div class="font-size-h3 font-w600 text-success">{{ count($soal_essai) }}</div>
                                        <div class="font-size-sm font-w600 text-uppercase text-muted">Soal Essai</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-xl-6">
                                <div class="block">
                                    <div class="block-content" id="tingkat_kesukaran"></div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-6">
                                <div class="block">
                                    <div class="block-content" id="daya_pembeda"></div>
                                </div>
                            </div>
                            <div class="col-md-12 col-xl-12">
                                <div class="block">
                                    <div class="block-content" id="fungsi_pengecoh"></div>
                                </div>
                            </div>
                            <div class="col-md-12 col-xl-12">
                                <div class="block">
                                    <div class="block-content" id="fungsi_pengecoh_all"></div>
                                </div>
                            </div>
                            <div class="col-md-12 col-xl-12">
                                <div class="block">
                                    <div class="block-content" id="chart"></div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive" id="dinamis_table">
                            {{-- table --}}
                        </div>
                    </div>
                </div>
{{-- DETAIL --}}
                <div class="tab-pane fade fade-right @if(!$uji) show active @endif" id="btabs-animated-slideright-detail" role="tabpanel">
                    <div class="block-content">
                        <h4 class="font-w400" id="dinamis_sekolah_teks">
                            @if($uji)
                                Detail Analisis Butir Soal
                            @else
                                Detail Pilihan Ganda
                            @endif
                        </h4>
                        @if(!$uji)
                        <div class="block-content block-content-full">
                            <div class="row py-20">
                                <div class="col-6 text-right border-r">
                                    <div class="js-appear-enabled animated fadeInLeft" data-toggle="appear" data-class="animated fadeInLeft">
                                        <div class="font-size-h3 font-w600 text-info">{{ count($soal_pilgan) }}</div>
                                        <div class="font-size-sm font-w600 text-uppercase text-muted">Soal Pilihan Ganda</div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="js-appear-enabled animated fadeInRight" data-toggle="appear" data-class="animated fadeInRight">
                                        <div class="font-size-h3 font-w600 text-success">{{ count($soal_essai) }}</div>
                                        <div class="font-size-sm font-w600 text-uppercase text-muted">Soal Essai</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="block">
                            <div class="block-header block-header-default bg-gd-primary">
                                <h3 class="block-title text-white">Soal Paket {{ str_replace('_', ' ', $paket->nama) }}</h3>
                            </div>
                            <div class="block-content">
                                <div class="table-responsive">  
                                    <table class="table table-bordered table-striped table-hover dataTable js-basic-example" id="users-table">
                                        <thead>
                                        @if($uji)
                                            <tr>
                                                <th rowspan="2" style="text-align: center; vertical-align: middle;">No</th>
                                                <th rowspan="2" style="text-align: center; vertical-align: middle;">Soal</th>
                                                <th colspan="3" style="text-align: center; vertical-align: middle;">Statistik Butir</th>
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
                                                <th>Pilihan</th>
                                                <th>Fungsi Pengecoh</th>
                                            </tr>
                                        @else
                                            <tr>
                                                <th style="text-align: center; vertical-align: middle;">No</th>
                                                <th style="text-align: center; vertical-align: middle;">Soal</th>
                                                <th style="text-align: center; vertical-align: middle;">Kunci Jawaban</th>
                                            </tr>
                                        @endif
                                        </thead>
                                        <tbody>
                                            @php 
                                                $no=1;
                                            @endphp
                                            @foreach($soal_pilgan as $soal)
                                            @if($uji)
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
                                                    <td class="text-center" rowspan="5" style="font-weight: bold;">
                                                        {{ number_format((float)$soal->analisis->tingkat_kesukaran, 4, '.', '') }} <br>
                                                        @if($soal->analisis->tingkat_kesukaran > 0.7)
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
                                                                $daya_pembeda = $soal->analisis->daya_pembeda;
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
                                                    <td class="text-center" @if($soal->kunci_jawaban=="a") style="font-weight: bold;" @endif>
                                                        Pilihan A
                                                    </td>
                                                    <td>
                                                        @if($soal->jumlah_siswa > 0)
                                                            {{ number_format((float)( $soal->jawaban_a/$soal->jumlah_siswa), 4, '.', '')  }}
                                                        @endif
                                                    </td>
                                                    <td rowspan="5">
                                                        @if($daya_pembeda<0.2)
                                                            <button type="button" class="btn btn-danger">Soal Ditolak!</button>     
                                                        @elseif($daya_pembeda>0.3)
                                                            <button type="button" class="btn btn-success">
                                                                Soal Diterima!
                                                            </button>   
                                                        @else
                                                            <button type="button" class="btn btn-warning">Soal Direvisi!</button>     
                                                        @endif
                                                    </td>
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
                                            @else
                                                <tr>
                                                    <td class="">{{ $no++ }}</td>
                                                    <td class="">
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
                                                    <td class="text-center" style="font-weight: bold;">
                                                        {{ strtoupper($soal->kunci_jawaban) }}
                                                    </td>
                                                </tr>
                                            @endif
                                            @endforeach
                                        </tbody>
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
    <script src="{{ asset('js/devextreme/dx.all.js') }}"></script>
    <script>
        $(document).ready(function(){
            $('#users-table').DataTable({
                "autoWidth": true,
                "ordering": true,
            });
            $('[data-toggle="tooltip"]').tooltip();
        });

        function cetak_soal(){
            window.open('{{ url('/soal/cetak', $paket->id) }}', '_blank');
        }
    </script>
    <script>
        $.getJSON('{{ url('/ajax/grafik/soal/analisis_butir_soal')}}/{{ $paket->id }}').done(function(result) {
            renderDataGrid(result);
        });
        function renderDataGrid(gridDataSource) {
            var tingkat_kesukaran = $("#tingkat_kesukaran").dxPieChart({
                adaptiveLayout: {
                    width: 300
                },
                palette: "office",
                dataSource: gridDataSource.tingkat_kesukaran,
                title: "Tingkat Kesukaran",
                margin: {
                    bottom: 0
                },
                legend: {
                    visible: true
                },
                animation: {
                    enabled: true
                },
                resolveLabelOverlapping: "none",
                "export": {
                    enabled: true
                },
                type: 'doughnut',
                series: [{
                    argumentField: "tipe",
                    valueField: "jumlah",
                    label: {
                        visible: true,
                        customizeText: function(arg) {
                            return arg.argumentText+': ' + arg.originalValue + ' Soal'+
                                "<br>(" + arg.percentText + ")";
                        },
                        connector: {
                            visible: true,
                            width: 1
                        }
                    }
                }]
            }).dxPieChart("instance");

            var daya_pembeda = $("#daya_pembeda").dxPieChart({
                adaptiveLayout: {
                    width: 300
                },
                palette: "ocean",
                dataSource: gridDataSource.daya_pembeda,
                title: "Daya Pembeda",
                margin: {
                    bottom: 0
                },
                legend: {
                    visible: true
                },
                animation: {
                    enabled: true
                },
                resolveLabelOverlapping: "none",
                "export": {
                    enabled: true
                },
                type: 'doughnut',
                series: [{
                    argumentField: "tipe",
                    valueField: "jumlah",
                    label: {
                        visible: true,
                        customizeText: function(arg) {
                            return arg.argumentText+': ' + arg.originalValue + ' Soal'+
                                "<br>(" + arg.percentText + ")";
                        },
                        connector: {
                            visible: true,
                            width: 1
                        }
                    }
                }]
            }).dxPieChart("instance");

            var fungsi_pengecoh = $("#fungsi_pengecoh").dxChart({
                dataSource: gridDataSource.fungsi_pengecoh, 
                title: "Fungsi Pengecoh",
                series: {
                    argumentField: "no_soal",
                    valueField: "jumlah_pengecoh",
                    name: "Jumlah pengecoh <br>berfungsi dengan baik",
                    type: "bar",
                    color: '#ffaa66'
                },
                valueAxis: {
                    title: {
                        text: "Jumlah Pilihan Jawaban"
                    },
                    position: "bottom",
                    visualRange: [0, null],
                    valueType: "numeric",
                    allowDecimals : false,
                },
                argumentAxis: {
                    title: {
                        text: 'Soal Pilihan Ganda'
                    },
                    position: "left",
                    label: {
                        overlappingBehavior: "rotate",
                        rotationAngle: 90
                    }
                },
                tooltip: {
                    enabled: true,
                    location: "edge",
                    customizeTooltip: function (arg) {
                        return {
                            text: arg.valueText + " pilihan jawaban berfungsi dengan baik"
                        };
                    }
                },
                export: {
                    enabled: true
                },
            });

            var fungsi_pengecoh_all = $("#fungsi_pengecoh_all").dxPieChart({
                adaptiveLayout: {
                    width: 300
                },
                palette: "ocean",
                dataSource: gridDataSource.fungsi_pengecoh_all.original.data,
                title: "Fungsi Pengecoh",
                margin: {
                    bottom: 0
                },
                legend: {
                    visible: true
                },
                animation: {
                    enabled: true
                },
                resolveLabelOverlapping: "none",
                "export": {
                    enabled: true
                },
                type: 'doughnut',
                series: [{
                    argumentField: "nama",
                    valueField: "jumlah",
                    label: {
                        visible: true,
                        customizeText: function(arg) {
                            return arg.argumentText+': ' + arg.originalValue + ' Soal'+
                                "<br>(" + arg.percentText + ")";
                        },
                        connector: {
                            visible: true,
                            width: 1
                        }
                    }
                }]
            }).dxPieChart("instance");
        }
    </script>
    <script type="text/javascript">
        $.getJSON('{{ url('/ajax/grafik/soal/analisis_butir_soal_all')}}/{{ $paket->id }}').done(function(result) {
            renderDataGrid2(result);
        });
        function renderDataGrid2(gridDataSource) {
            var all_analisis_butir_soal = $("#chart").dxChart({
                palette: "vintage",
                dataSource: gridDataSource,
                commonSeriesSettings:{
                    argumentField: "no_soal",
                    type: "fullstackedbar"
                },
                series: [{
                        valueField: "tingkat_kesukaran",
                        type: "spline",
                        name: "Tingkat Kesukaran"
                    }, {
                        valueField: "daya_pembeda",
                        type: "spline",
                        name: "Daya Pembeda",
                        color: "#5ec435"
                    }, {
                        // axis: "total",
                        type: "spline",
                        valueField: "jumlah_pengecoh",
                        name: "Jumlah Pengecoh",
                        color: "#008fd8"
                    }
                ],
                valueAxis: [{
                    grid: {
                        visible: true
                    },
                    visualRange: [-1,1],
                }, {
                    name: "total",
                    position: "right",
                    grid: {
                        visible: true
                    },
                    title: {
                        text: "Rentang nilai [-1,1]"
                    }
                }],
                argumentAxis: {
                    title: {
                        text: 'Soal Pilihan Ganda'
                    },
                    position: "left",
                    label: {
                        overlappingBehavior: "rotate",
                        rotationAngle: 90
                    }
                },
                tooltip: {
                    enabled: true,
                    shared: true,
                    format: {
                        type: "largeNumber",
                        precision: 4
                    },
                    customizeTooltip: function (arg) {
                        var items = arg.valueText.split("\n"),
                            color = arg.point.getColor();
                        $.each(items, function(index, item) {
                            if(item.indexOf(arg.seriesName) === 0) {
                                items[index] = $("<span>")
                                                .text(item)
                                                .addClass("active")
                                                .css("color", color)
                                                .prop("outerHTML");
                            }
                        });
                        return { text: items.join("\n") };
                    }
                },
                legend: {
                    verticalAlignment: "bottom",
                    horizontalAlignment: "center"
                },
                "export": {
                    enabled: true
                },
                title: {
                    text: "Korelasi tingkat kesukaran, daya pembeda, dan fungsi pengecoh"
                }
            });
        }
    </script>
    <!-- Page JS Plugins -->
    <script src="{{ asset('codebase/src/assets/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('codebase/src/assets/js/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <!-- Page JS Code -->
    <script src="{{ asset('codebase/src/assets/js/pages/be_tables_datatables.min.js')}}"></script>
@endsection