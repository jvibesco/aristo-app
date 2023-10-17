@extends('layouts.app', ['title' => 'Order'])

@section('konten')
    @php
        use Carbon\Carbon;
    @endphp
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @elseif (session()->has('failed'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('failed') }}
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
                    <h1 class="m-0">Order</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                        <li class="breadcrumb-item active">Order</li>
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
                    <h3 class="card-title">Daftar Order</h3>
                </div>
                {{-- card-header --}}
                <div class="card-body">
                    @canany(['admin', 'marketing'])
                        <div class="row mb-4">
                            <a href="{{ route('joborder.create') }}" class="btn btn-success"><i
                                    class="fas fa-plus-square mr-2"></i>Tambah Order</a>
                        </div>
                    @endcanany
                    {{-- /.row --}}
                    <div class="row">
                        <div class="table-responsive col-lg-12">
                            @if ($orders->count())
                                <table id="example0" class="table table-striped table-bordered table-sm">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="text-center">No</th>
                                            <th scope="col" class="text-center">PO</th>
                                            <th scope="col" class="text-center">Customer</th>
                                            <th scope="col" class="text-center">Tanggal PO</th>
                                            <th scope="col" class="text-center">Due date</th>
                                            <th scope="col" class="text-center">Total Harga PO</th>
                                            <th scope="col" class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>{{ $order->noPo }}</td>
                                                <td>{{ $order->customer->namaCustomer }}</td>
                                                <td class="text-center">{{ Carbon::parse($order->tglPo)->format('d/m/Y') }}
                                                </td>
                                                <td class="text-center">
                                                    {{ Carbon::parse($order->tglPoAkhir)->format('d/m/Y') }}
                                                    {{-- {{ Carbon::parse($order->tglPoAkhir)->isoFormat('dddd, D MMMM Y') }} --}}
                                                </td>
                                                <td class="text-right">Rp {{ number_format($order->totalPo, 0, ',', '.') }}
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <div class="mr-2">
                                                            <a href="{{ route('joborder.show', $order->id) }}"
                                                                class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                                        </div>
                                                        @canany(['admin', 'marketing'])
                                                            <div class="mr-2">
                                                                <a href="{{ route('joborder.edit', $order->id) }}"
                                                                    class="btn btn-warning btn-sm"><i
                                                                        class="far fa-edit"></i></a>
                                                            </div>
                                                            <div>
                                                                <form action="{{ route('joborder.destroy', $order->id) }}"
                                                                    method="POST" class="d-inline">
                                                                    @method('delete')
                                                                    @csrf
                                                                    <button class="btn btn-danger btn-sm border-0"
                                                                        onclick="return confirm('Yakin ingin menghapus Order?')"><i
                                                                            class="fas fa-trash-alt"></i></button>
                                                                </form>
                                                            </div>
                                                        @endcanany
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
