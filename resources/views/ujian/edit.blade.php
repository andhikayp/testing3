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
    <a class="breadcrumb-item" href="{{ url('/ujian') }}">Detail Ujian</a>
    <span class="breadcrumb-item active">Edit Jadwal Ujian</span>
</nav>
<div class="row">
    <div class="col-md-12">
        @if(session('error'))
            <div class="alert alert-danger">
                <strong>Submit Form Tidak Berhasil!</strong>
                {{ session('error') }}
            </div>
        @elseif(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}                        
            </div>
        @endif
        <form action="{{ url('ujian/edit/save') }}" method="POST">
            <input type="text" hidden="" id="id" name="id" required="" value="{{ $ujian->id }}">
            {{csrf_field()}}
            <div class="block">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Edit Jadwal Ujian</h3>
                    <div class="block-options">
                        <button type="submit" class="btn btn-sm btn-alt-primary">
                            <i class="fa fa-check"></i> Submit
                        </button>
                        <a href="{{ url('/ujian/tambah') }}" class="btn btn-sm btn-alt-danger">
                            <i class="fa fa-repeat"></i> Reset
                        </a>
                    </div>
                </div>
                <div class="block-content">
                    <div class="form-group row justify-content-center">
                        <label class="col-sm-8" for="block-form-username3">Mata Pelajaran</label>
                        <div class="col-sm-8">
                            <select class="form-control js-example-basic-single" id="pelajaran" name="pelajaran" style="width: 100%" required="">
                                <option value="{{ $mapel_pilihan->id }}" selected="">{{ $mapel_pilihan->kurikulum }} - {{ $mapel_pilihan->nama }}</option>
                                @foreach($mapel as $m)
                                    @if($mapel_pilihan->id != $m->id)
                                        <option value="{{ $m->id }}">{{ $m->kurikulum }} - {{ $m->nama }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row justify-content-center">
                        <label class="col-sm-8" for="block-form-password3">Sesi</label>
                        <div class="col-sm-8">
                            <select class="form-control js-example-basic-single" id="sesi" name="sesi" style="width: 100%" required="">
                                <option value="{{ $ujian->sesi }}" selected="">Sesi {{ $ujian->sesi }}</option>
                                @for ($i = 1; $i < 4; $i++)
                                    @if($ujian->sesi != $i)
                                        <option value="{{$i}}">Sesi {{$i}}</option>
                                    @endif
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="form-group row justify-content-center">
                        <label class="col-sm-8" for="block-form-password3">Tanggal Ujian</label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" id="date" name="date" required="" value="{{ date('Y-m-d', strtotime("$ujian->waktu_mulai")) }}">
                        </div>
                    </div>
                    <div class="form-group row justify-content-center">
                        <label class="col-sm-8" for="block-form-password3">Waktu Mulai</label>
                        <div class="col-sm-8">
                            <input type="time" class="form-control" id="waktu_mulai" name="waktu_mulai" required="" value="{{ date('H:i', strtotime("$ujian->waktu_mulai")) }}">
                        </div>
                    </div>
                    <div class="form-group row justify-content-center">
                        <label class="col-sm-8" for="block-form-password3">Durasi (menit)</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" value="{{ $ujian->durasi }}" id="durasi" name="durasi" placeholder="misal: 120" min="0" max="180" required="">
                        </div>
                    </div>
                    <div class="form-group row justify-content-center">
                        <label class="col-sm-8" for="block-form-password3">Kategori Ujian</label>
                        <div class="col-sm-8">
                            <select class="form-control js-example-basic-single" id="kategori" name="kategori" style="width: 100%" required="">
                                <option value="{{ $ujian->pelaksanaan }}" selected="">{{ ucfirst(strtolower($ujian->pelaksanaan)) }}</option>
                                @if($ujian->pelaksanaan != "UTAMA")
                                    <option value="UTAMA">Utama</option>
                                @endif
                                @if($ujian->pelaksanaan != "SUSULAN")
                                    <option value="SUSULAN">Susulan</option>
                                @endif
                                @if($ujian->pelaksanaan != "OFFLINE")
                                    <option value="OFFLINE">Offline</option>
                                @endif
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('moreJS')
    <script>
        $('.js-example-basic-single').select2({
            width: 'resolve'
        });
    </script>
    <!-- Page JS Plugins -->
    <script src="{{ asset('codebase/src/assets/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('codebase/src/assets/js/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <!-- Page JS Code -->
    <script src="{{ asset('codebase/src/assets/js/pages/be_tables_datatables.min.js')}}"></script>
@endsection