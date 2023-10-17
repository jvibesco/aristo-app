@extends('layouts.app', ['title' => 'Material'])

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
                    <h1 class="m-0">Master Material</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                        <li class="breadcrumb-item active">Master</li>
                        <li class="breadcrumb-item active">Material</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <form method="post" action="{{ Route('material.store') }}">
                @csrf
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">Tambah Material</h3>
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
                                    <label for="namaMaterial" class="form-label">Nama Material</label>
                                    <input type="text" class="form-control @error('namaMaterial') is-invalid @enderror"
                                        id="namaMaterial" name="namaMaterial" autofocus>
                                    @error('namaMaterial')
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
                    <h3 class="card-title">Daftar Material</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            @if ($materials->count())
                                <table id="example0" class="table table-striped table-hover table-sm">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Nama Material</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($materials as $material)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $material->namaMaterial }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="mr-2">
                                                            <a href="{{ route('material.edit', $material) }}"
                                                                class="btn btn-warning btn-sm"><i
                                                                    class="far fa-edit"></i></a>
                                                        </div>
                                                        <div class="mr-2">
                                                            <form action="{{ route('material.destroy', $material) }}"
                                                                method="POST" class="d-inline">
                                                                @method('delete')
                                                                @csrf
                                                                <button class="btn btn-danger btn-sm border-0"
                                                                    onclick="return confirm('Yakin ingin menghapus?')"><i
                                                                        class="fas fa-trash-alt"></i></button>
                                                            </form>
                                                        </div>
                                                    </div>
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
