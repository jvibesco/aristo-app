@extends('layouts.app', ['title' => 'Master Proses'])

@section('konten')
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Master Proses</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                        <li class="breadcrumb-item active">Master</li>
                        <li class="breadcrumb-item active">Proses</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <form method="post" action="{{ route('proses.store') }}">
                @csrf
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">Tambah Proses</h3>
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
                                    <label for="namaProses" class="form-label">Nama Proses</label>
                                    <input type="text" class="form-control @error('namaProses') is-invalid @enderror"
                                        id="namaProses" name="namaProses" autofocus>
                                    @error('namaProses')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
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

            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Daftar Proses</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            @if ($proseses->count())
                                <table id="example0" class="table table-striped table-hover table-sm">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Nama Proses</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($proseses as $proses)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $proses->namaProses }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="mr-2">
                                                            <a href="#" class="btn btn-warning btn-sm"
                                                                data-toggle="modal"
                                                                data-target="#modalEdit{{ $proses->id }}"><i
                                                                    class="far fa-edit"></i></a>
                                                        </div>
                                                        <div class="mr-2">
                                                            <form action="{{ route('proses.destroy', $proses->id) }}" method="POST" class="d-inline">
                                                                @method('delete')
                                                                @csrf
                                                                <button class="btn btn-danger btn-sm border-0"
                                                                    onclick="return confirm('Yakin ingin menghapus?')"><i
                                                                        class="fas fa-trash-alt"></i></button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    @include('proses.modal.edit')
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div class="text-center">Data is empty!</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection
