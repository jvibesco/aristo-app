@extends('layouts.app', ['title' => 'Proses Job Order'])

@section('konten')
    @php
        use Carbon\Carbon;
    @endphp
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col">
                    <h1 class="m-0 text-center">Proses Job Order</h1>
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
                    <form>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="joborder_id" class="col-form-label">Job Order</label>
                                    <select id="mySelect" style="width: 100%;" id="joborder_id" name="joborder_id">
                                        <option value="" data-nama="" selected disabled>PILIH JOB ORDER</option>
                                        @foreach ($joborders as $joborder)
                                            @if ($joborder->joborder->id == $joborder_id)
                                                <option value="{{ $joborder->joborder->id }}" selected>JO:
                                                    {{ $joborder->joborder->no_jo }} ~ Part:
                                                    {{ $joborder->joborder->nama_barang }} ~ Qty:
                                                    {{ $joborder->joborder->qty }} ~ DD:
                                                    {{ Carbon::parse($joborder->joborder->order->tglPoAkhir)->format('d/m/Y') }}
                                                </option>
                                            @else
                                                <option value="{{ $joborder->joborder->id }}">JO:
                                                    {{ $joborder->joborder->no_jo }} ~ Part:
                                                    {{ $joborder->joborder->nama_barang }} ~ Qty:
                                                    {{ $joborder->joborder->qty }} ~ Duedate:
                                                    {{ Carbon::parse($joborder->joborder->order->tglPoAkhir)->format('d/m/Y') }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="button-container d-flex justify-content-center">
                            <button class="btn btn-success">Display</button>
                        </div>
                    </form>
                </div>
                @if ($joborder_id)
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="col-form-label">Job Order</label>
                                <input type="text" class="form-control" value="{{ $flowproses->joborder->no_jo }}"
                                    disabled>
                            </div>
                            <div class="col-md-6">
                                <label class="col-form-label">Nama Part</label>
                                <input type="text" class="form-control" value="{{ $flowproses->joborder->nama_barang }}"
                                    disabled>
                            </div>
                            <div class="col-md-6">
                                <label class="col-form-label">Material</label>
                                <input type="text" class="form-control"
                                    value="{{ $flowproses->material->namaMaterial }}" disabled>
                            </div>
                            <div class="col-md-6">
                                <label class="col-form-label">Quantity</label>
                                <input type="text" class="form-control" value="{{ $flowproses->joborder->qty }}"
                                    disabled>
                            </div>
                            <div class="col-md-6">
                                <label class="col-form-label">Duedate</label>
                                <input type="text" class="form-control"
                                    value="{{ Carbon::parse($flowproses->joborder->order->tglPoAkhir)->format('d/m/Y') }}"
                                    disabled>
                            </div>
                        </div>
                        <div class="row">
                            <div class="table-responsive col-lg-12">
                                <table id="my-table" class="table table-bordered table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th class="text-center" scope="col" style="width: 40px">No</th>
                                            <th class="text-center" scope="col">Nama Proses</th>
                                            <th class="text-center" scope="col">Plan Waktu</th>
                                            <th class="text-center" scope="col">Plan Tanggal</th>
                                            <th class="text-center" scope="col">Actual Tanggal</th>
                                            <th class="text-center" scope="col">Operator</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($details as $detail)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>{{ $detail->proses->namaProses }}</td>
                                                @if ($detail->planningJam)
                                                    <td class="text-center">{{ $detail->planningJam }} Menit</td>
                                                @else
                                                    <td></td>
                                                @endif
                                                @if (isset($detail->schedule->planningTanggal))
                                                    <td class="text-center">
                                                        {{ Carbon::parse($detail->schedule->planningTanggal)->format('d/m/Y') }}
                                                    </td>
                                                @else
                                                    <td></td>
                                                @endif
                                                @php
                                                    $act = DB::table('actual_produksis')
                                                        ->where('flowproses_id', $detail->flowproses_id)
                                                        ->where('proses_id', $detail->proses_id)
                                                        ->orderBy('id', 'desc')
                                                        ->first();
                                                @endphp
                                                @if (isset($act->tanggal))
                                                    <td class="text-center">
                                                        {{ Carbon::parse($act->tanggal)->format('d/m/Y') }}</td>
                                                @else
                                                    <td></td>
                                                @endif
                                                @if (isset($act->operator))
                                                    <td>{{ $act->operator }}</td>
                                                @else
                                                    <td></td>
                                                @endif

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        {{-- /.row --}}
                    </div>
                    {{-- /.card-body --}}
                @endif
            </div>
            {{-- /.card --}}
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection
