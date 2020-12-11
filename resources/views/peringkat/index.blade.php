@extends('template.base.app')
@section('title', ' Detail Ujian')

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
    <span class="breadcrumb-item active">Peringkat</span>
</nav>
<div class="row">
    <div class="col-lg-12">
        <div class="block">
            <ul class="nav nav-tabs nav-tabs-block" data-toggle="tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" href="#btabs-animated-slideright-home">Peringkat Sekolah</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#btabs-animated-slideright-profile">Peringkat Siswa</a>
                </li>
                {{-- <li class="nav-item ml-auto">
                    <a class="nav-link" href="#btabs-animated-slideright-settings"><i class="si si-settings"></i></a>
                </li> --}}
            </ul>
            <div class="block-content tab-content overflow-hidden">
                <div class="tab-pane fade fade-right show active" id="btabs-animated-slideright-home" role="tabpanel">
                    {{-- <h4 class="font-w400">Home Content</h4>
                    <p>Content slides in to the right..</p> --}}
                    {{-- <div class="demo-container">
                        <div id="chart"></div>
                    </div> --}}
                    <div class="block-content block-content-full">
                        <div id="nilai"></div>
                    </div>
                </div>
                <div class="tab-pane fade fade-right" id="btabs-animated-slideright-profile" role="tabpanel">
                    {{-- <h4 class="font-w400">Profile Content</h4>
                    <p>Content slides in to the right..</p> --}}
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-basic-example" id="users-table">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Tanggal</th>
                                    <th>Pelaksanaan</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                {{-- <div class="tab-pane fade fade-right" id="btabs-animated-slideright-settings" role="tabpanel">
                    <h4 class="font-w400">Settings Content</h4>
                    <p>Content slides in to the right..</p>
                </div> --}}
            </div>
        </div>
    </div>
</div>
@endsection
@section('moreJS')
        <script src="{{ asset('js/devextreme/dx.all.js') }}"></script>
    
    <!-- Page JS Plugins -->
    <script src="{{ asset('codebase/src/assets/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('codebase/src/assets/js/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <!-- Page JS Code -->
    <script src="{{ asset('codebase/src/assets/js/pages/be_tables_datatables.min.js')}}"></script>
@endsection