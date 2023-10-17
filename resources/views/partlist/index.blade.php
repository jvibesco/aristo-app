@extends('layouts.app', ['title' => 'Part List'])

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
                    <h1 class="m-0">Part List</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                        <li class="breadcrumb-item active">Part List</li>
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
                    <h3 class="card-title">Daftar Part List</h3>
                </div>
                {{-- card-header --}}
                <div class="card-body">
                    {{-- /.row --}}
                    <div class="row">
                        <div class="table-responsive col-lg-12">
                            @if ($partlists->count())
                                <table class="table table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th class="text-center" scope="col">No</th>
                                            <th class="text-center" scope="col">No. PO</th>
                                            <th class="text-center" scope="col">No. Part List</th>
                                            <th class="text-center" scope="col">Tanggal Part List</th>
                                            <th class="text-center" scope="col">Dibuat Oleh</th>
                                            <th class="text-center" scope="col">Status</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($partlists as $partlist)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td class="text-center">{{ $partlist->order->noPo }}</td>
                                                <td class="text-center">{{ $partlist->noPartList }}</td>
                                                <td class="text-center">{{ $partlist->tglPartList }}</td>
                                                <td class="text-center">{{ $partlist->createdBy }}</td>
                                                @if ($partlist->status == 'Baru')
                                                    <td class="text-center text-danger">{{ $partlist->status }}</td>
                                                @elseif ($partlist->status == 'Sudah diproses')
                                                    <td class="text-center text-info">{{ $partlist->status }}</td>
                                                @elseif ($partlist->status == 'Sudah divalidasi')
                                                    <td class="text-center text-success">{{ $partlist->status }}</td>
                                                @else
                                                    <td class="text-center">{{ $partlist->status }}</td>
                                                @endif
                                                <td>
                                                    <div class="d-flex content-center">
                                                        <div class="mr-2" title="Detail">
                                                            <a href="{{ route('partlist.show', $partlist->id) }}"
                                                                class="btn btn-info btn-sm"><i class="fas fa-info-circle"></i></a>
                                                        </div>

                                                        <div class="mr-2" title="Update">
                                                            <a href="{{ route('partlist.edit', $partlist->id) }}"
                                                                class="btn btn-warning btn-sm"><i
                                                                    class="far fa-edit"></i></a>
                                                        </div>

                                                        <div class="mr-2" title="Hapus">
                                                            <form action="{{ route('partlist.destroy', $partlist->id) }}" method="POST" class="d-inline">
                                                                @method('delete')
                                                                @csrf
                                                                <button class="btn btn-danger btn-sm border-0"
                                                                    onclick="return confirm('Yakin ingin menghapus Part List?')"><i
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
                    {{-- /.row --}}
                </div>
                {{-- /.card-body --}}
            </div>
            {{-- /.card --}}
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
    
@endsection
