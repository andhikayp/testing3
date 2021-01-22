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
    <span class="breadcrumb-item active">Tambah Jadwal Ujian</span>
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
        <form action="{{ url('ujian/save') }}" method="POST">
            {{csrf_field()}}
            <div class="block">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Tambah Jadwal Ujian</h3>
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
                                <option value="" disabled="" selected="">Pilih Mata Pelajaran</option>
                                @foreach($mapel as $m)
                                    <option value="{{ $m->id }}">{{ $m->kurikulum }} - {{ $m->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row justify-content-center">
                        <label class="col-sm-8" for="block-form-password3">Sesi</label>
                        <div class="col-sm-8">
                            <select class="form-control js-example-basic-single" id="sesi" name="sesi" style="width: 100%" required="">
                                <option value="" disabled="" selected="">Pilih Sesi</option>
                                @for ($i = 1; $i < 4; $i++)
                                    <option value="{{$i}}">Sesi {{$i}}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="form-group row justify-content-center">
                        <label class="col-sm-8" for="block-form-password3">Tanggal Ujian</label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" id="date" name="date" required="">
                        </div>
                    </div>
                    <div class="form-group row justify-content-center">
                        <label class="col-sm-8" for="block-form-password3">Waktu Mulai</label>
                        <div class="col-sm-8">
                            <input type="time" class="form-control" id="waktu_mulai" name="waktu_mulai" required="">
                        </div>
                    </div>
                    <div class="form-group row justify-content-center">
                        <label class="col-sm-8" for="block-form-password3">Durasi (menit)</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" id="durasi" name="durasi" placeholder="misal: 120" min="0" max="180" required="">
                        </div>
                    </div>
                    <div class="form-group row justify-content-center">
                        <label class="col-sm-8" for="block-form-password3">Kategori Ujian</label>
                        <div class="col-sm-8">
                            <select class="form-control js-example-basic-single" id="kategori" name="kategori" style="width: 100%" required="">
                                <option value="" disabled="" selected="">Pilih Kategori</option>
                                <option value="UTAMA">Utama</option>
                                <option value="SUSULAN">Susulan</option>
                                <option value="OFFLINE">Offline</option>
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