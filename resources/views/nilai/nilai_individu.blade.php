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
    <a class="breadcrumb-item" href="{{ url('/nilai') }}">Sekolah</a>
    <a class="breadcrumb-item" href="{{ url('/nilai', ['id'=>$sekolah]) }}">Data Siswa</a>
    <span class="breadcrumb-item active">Nilai</span>
</nav>
<div class="block">
    <div class="block-header block-header-default bg-gd-primary">
        <h3 class="block-title text-white text-center">Daftar Nilai {{ $nilai[0]->user->nama }}</h3>
    </div>
    {{-- <div class="my-50 text-center">
        <h2 class="font-w700 text-black mb-10">All Wallets</h2>
        <h3 class="h5 text-muted mb-0">All great, keep it up!</h3>
    </div> --}}
</div>
<div class="row">
    @foreach($nilai as $nilais)
    <div class="col-lg-6 col-xl-6">
        <div class="block block-fx-shadow text-center">
            <a class="d-block bg-warning font-w600 text-uppercase py-5" href="javascript:void(0)" data-toggle="modal" data-target="#modal-crypto-wallet-{{ $nilais->id }}">
                <span class="text-white">{{ $nilais->paket->pelajaran->nama }}</span>
            </a>
            <div class="block-content block-content-full">
                <div class="pt-20 pb-30">
                    <div class="font-size-sm font-w600 text-uppercase text-muted">Benar | Salah | Essai</div>
                    <div class="font-size-h3 font-w700">{{ $nilais->jumlah_benar }} || {{ $nilais->jumlah_salah }} || {{ $nilais->jumlah_kosong }}</div>
                    <div class="font-size-sm font-w600 text-uppercase text-muted">{{ $nilais->JadwalUjian->waktu_mulai }} - {{ $nilais->JadwalUjian->waktu_selesai }}</div>
                    <div class="font-size-sm font-w600 text-uppercase text-muted">Paket {{ $nilais->Paket->nama[-1] }}</div>
                </div>
                <a class="btn btn-secondary" href="{{ url('/nilai/soal', ['mapel'=>$nilais->id, 'id'=>$nilai[0]->user->id]) }}">
                    <i class="fa fa-send mr-5"></i> Analisis Soal
                </a>
                <a class="btn btn-secondary" href="javascript:void(0)" data-toggle="modal" data-target="#modal-crypto-wallet-{{ $nilais->id }}">
                    <i class="fa fa-qrcode mr-5"></i> Nilai
                </a>
            </div>
        </div>
    </div>
    @endforeach
</div>
@foreach($nilai as $nilais)
<div class="modal fade" id="modal-crypto-wallet-{{ $nilais->id }}" tabindex="-1" role="dialog" aria-labelledby="modal-crypto-wallet-btc" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">
                        {{-- <i class="si si-wallet text-warning mr-5"></i> --}}
                        {{-- {{ $nilais->jumlah_benar }} --}}
                        Nilai {{ $nilai[0]->user->nama }}
                    </h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <table class="table table-borderless table-striped table-vcenter mb-10">
                        <tbody>
                            <tr>
                                <td class="text-center">
                                    {{-- JAN<br>10 --}}
                                    1
                                </td>
                                <td>
                                    <strong>Penskoran tanpa koreksi</strong><br>
                                    <span class="text-muted">Setiap butir soal dijawab benar mendapatkan nilai 1</span>
                                </td>
                                <td class="text-right text-success font-w600">
                                    {{-- + 0.50 BTC --}}
                                    Skala 0-100
                                </td>
                                <td class="d-none d-sm-table-cell text-right text-danger font-w600">
                                    {{ $nilais->jumlah_benar/($nilais->jumlah_benar+$nilais->jumlah_salah+$nilais->jumlah_kosong-5)*100 }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    {{-- JAN<br>05 --}}
                                    2
                                </td>
                                <td>
                                    <strong>Penskoran ada koreksi jawaban</strong><br>
                                    <span class="text-muted">Memberikan pertimbangan pada butir soal yang dijawab salah dan tidak dijawab</span>
                                </td>
                                <td class="text-right text-success font-w600">
                                    {{-- + 0.50 BTC --}}
                                    Skala 0-100
                                </td>
                                <td class="d-none d-sm-table-cell text-right text-danger font-w600">
                                    {{ ($nilais->jumlah_benar-($nilais->jumlah_salah/(5-1)))/($nilais->jumlah_benar+$nilais->jumlah_salah+$nilais->jumlah_kosong-5)*100 }}
                                </td>
                            </tr>
                            {{-- <tr>
                                <td class="text-center">
                                    3
                                </td>
                                <td>
                                    <strong>Penskoran dengan butir beda bobot</strong><br>
                                    <span class="text-muted">Memberikan bobot berbeda untuk setiap soal</span>
                                </td>
                                <td class="text-right text-danger font-w600">
                                    Skala 0-100
                                </td>
                                <td class="d-none d-sm-table-cell text-right text-success font-w600">
                                </td>
                            </tr> --}}
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-alt-secondary" type="button" data-dismiss="modal">Close</button>
                <button class="btn btn-alt-primary" type="button" data-dismiss="modal">Done</button>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection

@section('moreJS')
    <script>
        
    </script>
    <script src="{{ asset('js/devextreme/dx.all.js') }}"></script>

    <!-- Page JS Plugins -->
    <script src="{{ asset('codebase/src/assets/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('codebase/src/assets/js/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <!-- Page JS Code -->
    <script src="{{ asset('codebase/src/assets/js/pages/be_tables_datatables.min.js')}}"></script>
@endsection