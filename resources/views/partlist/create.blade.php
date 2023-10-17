@extends('layouts.app', ['title' => 'Job Order'])

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
                        <li class="breadcrumb-item active">Buat Partlist</li>
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
                    <h3 class="card-title">Buat Partlist</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <form action="{{ route('partlist.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <input type="hidden" name="order_id" value="{{ $order }}">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="noPartList" class="form-label @error('noPartList') is-invalid @enderror">No.
                                        Part List</label>
                                    <input type="text" class="form-control" id="noPartList" name="noPartList">
                                    @error('noPartList')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tglPartList" class="form-label">Tanggal Part List</label>
                                    <input type="date" class="form-control" id="tglPartList" name="tglPartList"
                                        value="{{ $dateNow }}">
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
                                                <th class="text-center" scope="col" style="width: 150px">No JO</th>
                                                <th class="text-center" scope="col">Nama Barang</th>
                                                <th class="text-center" scope="col" style="width: 165px">Material</th>
                                                <th class="text-center" scope="col" style="width: 70px">Qty</th>
                                                <th class="text-center" scope="col" style="width: 70px">Diameter</th>
                                                <th class="text-center" scope="col" style="width: 70px">Panjang</th>
                                                <th class="text-center" scope="col" style="width: 70px">Lebar</th>
                                                <th class="text-center" scope="col" style="width: 70px">Tinggi</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($joborders as $joborder)
                                                <tr id="row-add-{{ $loop->iteration }}">
                                                    <input type="hidden" name="joborder_id[]" value="{{ $joborder->id }}">
                                                    <td class="text-center">{{ $loop->iteration }}</td>
                                                    <td><input type="text" class="form-control" name="jo_part[]"
                                                            value="{{ $joborder->no_jo }}">
                                                    </td>
                                                    <td><input type="text" class="form-control"
                                                            value="{{ $joborder->nama_barang }}" readonly></td>
                                                    <td>
                                                        <select
                                                            class="form-control @error('material_id') is-invalid @enderror"
                                                            id="mySelect" name="material_id[]" required>
                                                            <option value="" selected>PILIH
                                                                MATERIAL</option>
                                                            @foreach ($materials as $material)
                                                                @if (old('material_id') == $material->id)
                                                                    <option value="{{ $material->id }}" selected>
                                                                        {{ $material->namaMaterial }}
                                                                    </option>
                                                                @else
                                                                    <option value="{{ $material->id }}">
                                                                        {{ $material->namaMaterial }}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td class="text-center"><input type="number" class="form-control"
                                                            name="qtyMaterial[]" value="{{ $joborder->qty }}"></td>
                                                    <td class="text-center"><input type="number" class="form-control"
                                                            name="diameter[]"></td>
                                                    <td class="text-center"><input type="number" class="form-control"
                                                            name="panjang[]"></td>
                                                    <td class="text-center"><input type="number" class="form-control"
                                                            name="lebar[]"></td>
                                                    <td class="text-center"><input type="number" class="form-control"
                                                            name="tinggi[]"></td>
                                                    <td class="text-center"><button class="btn btn-xs btn-plain"
                                                            type="button" onclick="addRow({{ $loop->iteration }})">
                                                            <i class="fas fa-plus"></i>
                                                        </button></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            {{-- ./col-md-6 --}}
                        </div>
                        <!-- /.row -->
                        <div class="row mt-2">
                            <button type="submit" class="btn btn-success mt-2">Simpan</button>
                        </div>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
    <script>
        function addRow(indeks) {
            var index = $(`#my-table tbody tr[id^="row-add-${indeks}-"]`).length + 1;
            var add =
                `
                <tr id='row-add-${indeks}-${index}'>
                    <input type="hidden" name="joborder_id[]" value="">
                    <td colspan="1" class="text-center"></td>
                    <td>
                        <input type="text" class="form-control" name="jo_part[]" value="">
                    </td>
                    <td>
                        <input type="text" class="form-control" value="" readonly>
                    </td>
                    <td>
                        <select
                            class="form-control form-control-sm select2 @error('material_id') is-invalid @enderror"
                            id="mySelect" name="material_id[]" required>
                            <option value="" selected>PILIH
                                MATERIAL</option>
                            @foreach ($materials as $material)
                                @if (old('material_id') == $material->id)
                                    <option value="{{ $material->id }}" selected>
                                        {{ $material->namaMaterial }}
                                    </option>
                                @else
                                    <option value="{{ $material->id }}">
                                        {{ $material->namaMaterial }}</option>
                                @endif
                            @endforeach
                        </select>
                    </td>
                    <td class="text-center"><input type="number" class="form-control" name="diameter[]"></td>
                    <td class="text-center"><input type="number" class="form-control" name="panjang[]"></td>
                    <td class="text-center"><input type="number" class="form-control" name="lebar[]"></td>
                    <td class="text-center"><input type="number" class="form-control" name="tinggi[]"></td>
                    <td class="text-center"><input type="number" class="form-control" name="qtyMaterial[]"></td>
                    <td class="text-center">
                        <button class="btn btn-xs btn-plain"
                            type="button" onclick="hapusRowAdd('${indeks}-${index}')">
                            <i class="fas fa-minus text-danger"></i>
                        </button>
                    </td>
                </tr>
                `;
            $(`#my-table tbody tr#row-add-${indeks}`).after(add);

            let joborder_id = $(`#my-table tbody tr#row-add-${indeks} input:eq(0)`).val();
            $(`#my-table tbody tr#row-add-${indeks}-${index} input:eq(0)`).val(joborder_id);

            let jobOrder = $(`#my-table tbody tr#row-add-${indeks} td:eq(1) input`).val();
            $(`#my-table tbody tr#row-add-${indeks}-${index} td:eq(1) input`).val(jobOrder);

            let jobOrderName = $(`#my-table tbody tr#row-add-${indeks} td:eq(2) input`).val();
            $(`#my-table tbody tr#row-add-${indeks}-${index} td:eq(2) input`).val(jobOrderName);

            console.log(joborder_id, jobOrder)
        }

        function hapusRowAdd(noRow) {
            $(`#my-table tbody tr#row-add-${noRow}`).remove();
        }
    </script>
@endsection
