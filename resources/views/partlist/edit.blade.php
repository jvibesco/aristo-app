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
                        <li class="breadcrumb-item"><a href="{{ route('joborder.index') }}">Part List</a></li>
                        <li class="breadcrumb-item active">Update Partlist</li>
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
                    <h3 class="card-title">Update Partlist</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form action="{{ route('partlist.update', $partlist->id) }}" method="POST">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="noPartList" class="form-label">No.
                                        Part List</label>
                                    <input type="text" class="form-control" id="noPartList" name="noPartList"
                                        value="{{ $partlist->noPartList }}" disabled>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tglPartList" class="form-label">Tanggal Part List</label>
                                    <input type="date" class="form-control" id="tglPartList" name="tglPartList"
                                        value="{{ $partlist->tglPartList }}" disabled>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Dibuat oleh</label>
                                    <input type="text" class="form-control" value="{{ $partlist->createdBy }}" disabled>

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 border p-2">
                                <div class="table-responsive col-lg-12">
                                    <table id="my-table" class="table table-bordered table-striped table-sm">
                                        <thead>
                                            <h4><small>List Material</small></h4>
                                            <hr class="mt-1">
                                            <tr>
                                                <th class="text-center" scope="col">No</th>
                                                <th class="text-center" scope="col">No JO</th>
                                                <th class="text-center" scope="col">Nama Barang</th>
                                                <th class="text-center" scope="col">Material</th>
                                                <th class="text-center" scope="col">Qty</th>
                                                <th class="text-center" scope="col">Diameter</th>
                                                <th class="text-center" scope="col">Panjang</th>
                                                <th class="text-center" scope="col">Lebar</th>
                                                <th class="text-center" scope="col">Tinggi</th>
                                                <th class="text-center" scope="col">Stock/Order</th>
                                                <th class="text-center" scope="col">Tgl Material</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($parts as $part)
                                                <tr>
                                                    <input type="hidden" name="part_id[]" value="{{ $part->id }}">
                                                    <td class="text-center">{{ $loop->iteration }}</td>
                                                    <td class="text-center">{{ $part->jo_part }}</td>
                                                    <td class="text-center">{{ $part->joborder->nama_barang }}</td>
                                                    <td class="text-center">{{ $part->material->namaMaterial }}</td>
                                                    <td class="text-center">{{ $part->qtyMaterial }}</td>
                                                    <td class="text-center">{{ $part->diameter }}</td>
                                                    <td class="text-center">{{ $part->panjang }}</td>
                                                    <td class="text-center">{{ $part->lebar }}</td>
                                                    <td class="text-center">{{ $part->tinggi }}</td>
                                                    <td>
                                                        <select class="form-control" name="status[]">
                                                            <option value="" selected>PILIH
                                                                STATUS</option>
                                                            @if ($part->status == 'STOCK')
                                                                <option value="{{ $part->status }}" selected>
                                                                    {{ $part->status }}
                                                                </option>
                                                                <option value="ORDER">ORDER</option>
                                                            @elseif ($part->status == 'ORDER')
                                                                <option value="{{ $part->status }}" selected>
                                                                    {{ $part->status }}
                                                                </option>
                                                                <option value="STOCK">STOCK</option>
                                                            @else
                                                                <option value="STOCK">STOCK</option>
                                                                <option value="ORDER">ORDER</option>
                                                            @endif
                                                        </select>
                                                    </td>
                                                    @if ($partlist->status == 'Sudah divalidasi')
                                                        <td class="text-center"><input type="date"
                                                                class="form-control" name="tglActualMaterial[]"
                                                                value="{{ $part->tglActualMaterial }}"></td>
                                                    @else
                                                        <td class="text-center"><input type="date"
                                                                class="form-control" name="tglActualMaterial[]"
                                                                value="{{ $part->tglActualMaterial }}" disabled></td>
                                                    @endif

                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            {{-- ./col-md-6 --}}
                        </div>
                        <!-- /.row -->
                        <button type="submit" class="btn btn-success mt-3">Simpan</button>
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
