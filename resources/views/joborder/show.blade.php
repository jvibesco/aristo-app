@extends('layouts.app', ['title' => 'Show Order'])

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
                    <a href="{{ route('joborder.index') }}" class="btn btn-danger"><i
                            class="fas fa-arrow-left mr-2"></i>Kembali</a>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                        <li class="breadcrumb-item active"> <a href="{{ route('joborder.index') }}">Order</a></li>
                        <li class="breadcrumb-item active">Show</li>
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
                    <h3 class="card-title">Show</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form action="{{ route('joborder.update', $order->id) }}" method="POST">
                        @method('put')
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="customer_id" class="form-label">Nama Customer</label>
                                    <input type="text" class="form-control" value="{{ $order->customer->namaCustomer }}"
                                        disabled>
                                </div>
                                <!-- /.form-group -->

                                <div class="form-group">
                                    <label for="noPo" class="form-label">No. PO</label>
                                    <input type="text" class="form-control" id="noPo" name="noPo"
                                        value="{{ $order->noPo }}" disabled>
                                </div>
                                <!-- /.form-group -->
                                @if ($order->dokumen)
                                    <div class="form-group">
                                        <label for="dokumen" class="form-label">Dokumen </label>
                                        {{-- {{ asset('storage/' . $order->dokumen) }} --}}
                                        <a href="{{ route('getGambar', $order->id) }}" target='_blank'
                                            class="btn btn-warning d-block" style="width:30%"><i
                                                class="fas fa-file mr-2"></i>Lihat Dokumen</a>
                                    </div>
                                @endif
                                <!-- /.form-group -->
                            </div>
                            {{-- ./col-md-6 --}}

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tglPo" class="form-label">Tanggal PO</label>
                                    <input type="date" class="form-control" id="tglPo" name="tglPo"
                                        value="{{ $order->tglPo }}" disabled>
                                </div>
                                {{-- ./form-group --}}

                                <div class="form-group">
                                    <label for="tglPoAkhir" class="form-label">Due date</label>
                                    <input type="date" class="form-control" id="tglPoAkhir" name="tglPoAkhir"
                                        value="{{ $order->tglPoAkhir }}" disabled>
                                </div>
                                {{-- ./form-group --}}

                            </div>
                            {{-- ./col-md-6 --}}

                            <div class="table-responsive col-lg-12">
                                <hr>
                                <table id="table-add" class="table table-bordered table-striped table-hover table-sm">
                                    <thead>
                                        <tr>
                                            <th class="text-center" scope="col">No</th>
                                            <th class="text-center" scope="col">Job Order</th>
                                            <th class="text-center" scope="col">Nama Part</th>
                                            <th class="text-center" scope="col">Qty</th>
                                            <th class="text-center" scope="col">Harga/Pcs</th>
                                            <th class="text-center" scope="col">Total Harga</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($joborders as $joborder)
                                            <tr id="row-add-1">
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>{{ $joborder->no_jo }}</td>
                                                <td>{{ $joborder->nama_barang }}</td>
                                                <td class="text-center">{{ $joborder->qty }}</td>
                                                <td class="text-right">Rp
                                                    {{ number_format($joborder->harga_satuan, 0, ',', '.') }}</td>
                                                <td class="text-right">Rp
                                                    {{ number_format($joborder->total_harga, 0, ',', '.') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="5" class="text-center"> TOTAL </td>
                                            <td class="text-right">Rp {{ number_format($order->totalPo, 0, ',', '.') }}
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <!-- /.row -->
                        {{-- <div class="col">
                            @if ($order->partlist)
                                <a href=""><button type="button" class="btn btn-warning form-control"
                                        id="btn-add">Ubah Partlist</button></a>
                            @else
                                <a href="{{ route('partlist.create', $order->id) }}"><button type="button"
                                        class="btn btn-primary form-control" id="btn-add">Buat Partlist</button></a>
                            @endif
                        </div> --}}
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection
