@extends('layouts.app', ['title' => 'Dashboard'])

@section('konten')
    @php
        use Carbon\Carbon;
    @endphp
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="info-box">
                        <span class="info-box-icon bg-success elevation-1"><i
                                class="fas fa-arrow-alt-circle-right"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">JOB ORDER</span>
                            <span class="info-box-text text-uppercase text-danger">BULAN INI</span>
                            <span class="info-box-number">
                                <h1>{{ $joborder->count() }}</h1>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>

                <div class="col-12 col-sm-6 col-md-4">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-spinner"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">JOB ORDER ON PROGRESS</span>
                            <span class="info-box-text text-uppercase text-danger">BULAN INI</span>
                            <span class="info-box-number">
                                <h1>{{ $progress->count() }}</h1>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>

                <div class="col-12 col-sm-6 col-md-4">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-check"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">JOB ORDER FINISH</span>
                            <span class="info-box-text text-uppercase text-danger">BULAN INI</span>
                            <span class="info-box-number">
                                <h1>{{ $done->count() }}</h1>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <div class="col-12 col-sm-6 col-md-4">
                    <div class="info-box">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-spinner"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">JOB ORDER ON PROGRESS</span>
                            <span class="info-box-text text-uppercase text-danger">BULAN LALU</span>
                            <span class="info-box-number">
                                <h1>{{ $previousProgress->count() }}</h1>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>

            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection
