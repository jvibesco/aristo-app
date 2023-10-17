@extends('layouts.app', ['title' => 'Customer'])

@section('konten')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Customer</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                        <li class="breadcrumb-item active">Master</li>
                        <li class="breadcrumb-item active">Customer</li>
                        <li class="breadcrumb-item active">Edit Customer</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <form method="post" action="{{ route('customer.update', $customer) }}">
                @method('put')
                @csrf
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">Edit Customer</h3>
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
                                    <label for="namaCustomer" class="form-label">Nama Customer</label>
                                    <input type="text" class="form-control @error('namaCustomer') is-invalid @enderror"
                                        id="namaCustomer" name="namaCustomer" value="{{ $customer->namaCustomer }}">
                                    @error('namaCustomer')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <!-- /.form-group -->
                                <div class="form-group">
                                    <label for="joAkhir" class="form-label">Job Order Terakhir</label>
                                    <input type="text" class="form-control @error('joAkhir') is-invalid @enderror"
                                        id="joAkhir" name="joAkhir" value="{{ $customer->joAkhir }}">
                                    @error('joAkhir')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="kodeCustomer"
                                        class="form-label @error('kodeCustomer') is-invalid @enderror">Kode Customer</label>
                                    <input type="text" class="form-control " id="kodeCustomer" name="kodeCustomer"
                                        value="{{ $customer->kodeCustomer }}">
                                    @error('kodeCustomer')
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
