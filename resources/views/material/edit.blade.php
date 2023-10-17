@extends('layouts.app', ['title' => 'Material'])

@section('konten')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Master Material</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                        <li class="breadcrumb-item active">Master</li>
                        <li class="breadcrumb-item active">Material</li>
                        <li class="breadcrumb-item active">Edit Material</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <form method="post" action="{{ route('material.update', $material) }}">
                @method('put')
                @csrf
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">Edit Material</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="namaMaterial"
                                        class="form-label @error('namaMaterial') is-invalid @enderror">Nama Material</label>
                                    <input type="text" class="form-control " id="namaMaterial" name="namaMaterial"
                                        value="{{ $material->namaMaterial }}">
                                    @error('namaMaterial')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </form>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection
