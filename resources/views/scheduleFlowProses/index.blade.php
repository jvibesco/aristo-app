@extends('layouts.app', ['title' => 'Schedule Flow Proses'])

@section('konten')
    @php
        use Carbon\Carbon;
    @endphp

    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
            <strong>{{ session('success') }}</strong>
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
                    <h1 class="m-0">Schedule Flow Proses</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                        <li class="breadcrumb-item active">Schedule Flow Proses</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            {{-- CARD 1 --}}
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Daftar Flow Proses</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                {{-- card-header --}}
                <div class="card-body">
                    {{-- /.row --}}
                    <div class="row">
                        <div class="table-responsive col-lg-12">
                            <table class="display table table-striped table-bordered table-sm">
                                <thead>
                                    <tr>
                                        <th class="text-center" scope="col">No</th>
                                        <th class="text-center" scope="col">Job Order</th>
                                        <th class="text-center" scope="col">No. PO</th>
                                        <th class="text-center" scope="col">Nama Part</th>
                                        <th class="text-center" scope="col">Material</th>
                                        <th class="text-center" scope="col">Qty</th>
                                        <th class="text-center" scope="col">Duedate</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($flowproseses as $flowproses)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $flowproses->joborder->no_jo }}</td>
                                            <td>{{ $flowproses->joborder->order->noPo }}</td>
                                            <td>{{ $flowproses->joborder->nama_barang }}</td>
                                            <td>{{ $flowproses->material->namaMaterial }}</td>
                                            <td class="text-center">{{ $flowproses->joborder->qty }}</td>
                                            <td class="text-center">
                                                {{ Carbon::parse($flowproses->joborder->order->tglPoAkhir)->format('d/m/Y') }}
                                            </td>
                                            <td>
                                                @if ($flowproses->schedules->isEmpty())
                                                    <div class="d-flex justify-content-center">
                                                        <div>
                                                            <a href="#" class="btn btn-success btn-sm"
                                                                data-toggle="modal"
                                                                data-target="#modalCreate{{ $flowproses->id }}"><i
                                                                    class="fas fa-calendar-plus"></i></a>
                                                            @include('scheduleFlowProses.modal.create')
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="d-flex justify-content-center">
                                                        <div class="mr-2">
                                                            <a href="#" class="btn btn-info btn-sm"
                                                                data-toggle="modal"
                                                                data-target="#modalShow{{ $flowproses->id }}"><i
                                                                    class="fas fa-eye"></i></a>
                                                            @include('scheduleFlowProses.modal.show')
                                                        </div>
                                                        <div>
                                                            <a href="#" class="btn btn-warning btn-sm"
                                                                data-toggle="modal"
                                                                data-target="#modalEdit{{ $flowproses->id }}"><i
                                                                    class="far fa-edit"></i></a>
                                                            @include('scheduleFlowProses.modal.edit')
                                                        </div>
                                                    </div>
                                                @endif
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

            {{-- CARD 2 --}}

            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Jadwal Produksi</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5>Filter by:</h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="namaCustomer" class="col-form-label">Proses</label>
                            <select id="proses" style="width: 100%;" name="proses_id" class="select3">
                                <option value="" data-nama="" disabled required selected>Pilih Proses</option>
                                @foreach ($proseses as $proses)
                                    <option value="{{ $proses->id }}">{{ $proses->namaProses }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tanggal" class="col-form-label">Tanggal</label>
                                <input type="date" id="tanggal" class="form-control" name="tanggal"
                                    value={{ now() }}>
                            </div>
                        </div>
                        <div class="col-md-4 d-flex">
                            <div class="form-group mr-2">
                                <label for="tanggal" class="col-form-label" style="opacity: 0">Display</label>
                                <button class="btn btn-success d-block" onclick="reloadTable()">Display</button>
                            </div>
                            <div class="form-group">
                                <label for="tanggal" class="col-form-label" style="opacity: 0">Clear</label>
                                <button class="btn btn-secondary d-block" onclick="clearForm3(event)">Clear</button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="table-responsive col-lg-12">
                            <table id="tableData" class="table table-striped table-bordered table-sm">
                                <thead>
                                    <tr>
                                        <th class="text-center" scope="col">No</th>
                                        <th class="text-center" scope="col">Job Order</th>
                                        <th class="text-center" scope="col">Proses</th>
                                        <th class="text-center" scope="col">Plan Waktu (Menit)</th>
                                        <th class="text-center" scope="col">Plan Tanggal</th>
                                        <th class="text-center" scope="col">Act Tanggal</th>
                                        <th class="text-center" scope="col">Jam Mulai</th>
                                        <th class="text-center" scope="col">Jam Selesai</th>
                                        <th class="text-center" scope="col">Operator</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- /.content -->
    {{-- <script>
        function addRow(id) {
            var index = $(`#table-add-${id} tbody tr`).length + 1;
            console.log(index);
            var orders =
                `
                <tr id="row-add-${index}">
                    <td class="text-center">
                        <button class="btn btn-xs btn-plain" type="button" onclick="hapusRowAdd(${id}, ${index})">
                            <i class="fas fa-minus text-danger"></i>
                        </button>
                    </td>
                    <td class="text-center">${index}</td>
                    <td class="text-center">
                        <select
                        class="form-control @error('proses_id') is-invalid @enderror"
                        name="proses_id[]" id="mySelect2">
                        <option value="" data-nama="" selected>PILIH PROSES
                        </option>
                        @foreach ($proseses as $proses)
                            @if (old('proses_id') == $proses->id)
                                <option value="{{ $proses->id }}" selected>
                                    {{ $proses->namaProses }}
                                </option>
                            @else
                                <option value="{{ $proses->id }}">{{ $proses->namaProses }}
                                </option>
                            @endif
                        @endforeach
                        </select>
                    </td>
                    <td class="text-center"><input type="number" class="form-control" name="planningJam[]" value=""
                            required></td>
                </tr>
                `;
            $(`#table-add-${id} tbody`).append(orders);
        }

        function hapusRowAdd(id, noRow) {
            $(`#table-add-${id} tbody tr#row-add-${noRow}`).remove();

            let trLength = $(`#table-add-${id} tbody tr`).length;
            let tr;
            for (let i = 0; i < trLength; i++) {
                tr = $(`#table-add-${id} tbody tr:eq(${i})`);
                tr.attr('id', `row-add-${(i + 1)}`);
                tr.find('td:eq(0) button').attr('onclick', `hapusRowAdd(${id} ,${(i + 1)})`);
                tr.find('td:eq(1)').html((i + 1));
            }
        }
    </script> --}}
@endsection
