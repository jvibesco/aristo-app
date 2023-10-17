@extends('layouts.app', ['title' => 'Users'])

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
                    <h1 class="m-0">Users</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                        <li class="breadcrumb-item active">Users</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Daftar User</h3>
                </div>
                {{-- card-header --}}
                <div class="card-body">
                    <div class="row mb-4">
                        <a href="" data-toggle="modal" data-target="#addModal"><button type="button"
                                class="btn btn-success form-control" id="btn-add">Tambah
                                User</button></a>
                    </div>
                    {{-- /.row --}}
                    <div class="row">
                        <div class="table-responsive col-lg-12">
                            <table id="example0" class="table table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama Lengkap</th>
                                        <th scope="col">NIK</th>
                                        <th scope="col">Role</th>
                                        <th scope="col" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $user->nama }}</td>
                                            <td>{{ $user->nik }}</td>
                                            <td>{{ $user->role->role }}</td>
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    <div class="mr-2">
                                                        <a href="#modaloyy" class="btn btn-warning btn-sm"
                                                            data-toggle="modal"
                                                            data-target="#editModal{{ $user->id }}"><i
                                                                class="far fa-edit"></i></a>
                                                    </div>

                                                    <div class="mr-2">
                                                        <form action="{{ route('user.destroy', $user->id) }}" method="POST"
                                                            class="d-inline">
                                                            @method('delete')
                                                            @csrf
                                                            <button class="btn btn-danger btn-sm border-0"
                                                                onclick="return confirm('Yakin ingin menghapus user?')"><i
                                                                    class="fas fa-trash-alt"></i></button>
                                                        </form>
                                                    </div>
                                                </div>
                                                @include('user.modal.edit')
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    {{-- /.row --}}
                </div>
                {{-- /.card-body --}}
            </div>
            {{-- /.card --}}
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->

    {{-- modal create user --}}
    @include('user.modal.create')
@endsection
