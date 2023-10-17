@extends('layouts.app', ['title' => 'Laporan Status Order'])

@section('konten')
    @php
        use Carbon\Carbon;
    @endphp
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col">
                    <h1 class="m-0 text-center">Laporan Status Order</h1>
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
                    <div class="row">
                        <div class="col">
                            <h5><strong>Filter by</strong></h5>
                        </div>
                    </div>
                    <form>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="start_date" class="col-form-label">Tanggal Awal</label>
                                    <input type="date" id="start_date" class="form-control" name="start_date"
                                        value="{{ $start_date }}">
                                </div>
                            </div>
                            <div class="col">
                                <label for="end_date" class="col-form-label">Tanggal Akhir</label>
                                <input type="date" id="end_date" class="form-control" name="end_date"
                                    value="{{ $end_date }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="namaCustomer" class="col-form-label">Customer</label>
                                <select class="form-control" style="width: 100%;" id="namaCustomer" name="customer_id">
                                    <option value="" data-nama="" selected>SEMUA CUSTOMER</option>
                                    @foreach ($customers as $customer)
                                        @if ($customer_id == $customer->id)
                                            <option value="{{ $customer->id }}" selected>{{ $customer->namaCustomer }}
                                            </option>
                                        @else
                                            <option value="{{ $customer->id }}">{{ $customer->namaCustomer }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="button-container d-flex justify-content-center mt-3">
                            <button class="btn btn-success mr-3" style="width: 80px">Display</button>
                            <button class="btn btn-secondary" style="width: 80px" onclick="clearForm(event)">Clear</button>
                        </div>
                    </form>
                </div>

                @if ($start_date || $end_date || $customer_id)
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h4 class="text-center">LAPORAN STATUS ORDER</h4>
                            </div>
                        </div>
                        @isset($namaCustomer)
                            <div class="row">
                                <div class="col">
                                    <h4 class="text-center">{{ $namaCustomer }}</h4>
                                </div>
                            </div>
                        @endisset
                        <div class="row mb-3">
                            <div class="col">
                                <h5 class="text-center">Tanggal
                                    @if ($start_date == null)
                                        <strong>-</strong>
                                    @else
                                        <strong>{{ Carbon::parse($start_date)->format('d/m/Y') }}</strong>
                                    @endif
                                    s/d
                                    @if ($end_date == null)
                                        <strong>-</strong>
                                    @else
                                        <strong>{{ Carbon::parse($end_date)->format('d/m/Y') }}</strong>
                                    @endif
                                </h5>
                            </div>
                        </div>
                        {{-- /.row --}}
                        <div class="row">
                            <div class="table-responsive col-lg-12">
                                <table id="example1" class="table table-bordered table-sm">
                                    <thead>
                                        <tr>
                                            <th class="text-center" scope="col">No</th>
                                            <th class="text-center" scope="col">Customer</th>
                                            <th class="text-center" scope="col">No. PO</th>
                                            <th class="text-center" scope="col">Tanggal PO</th>
                                            <th class="text-center" scope="col">Due Date</th>
                                            <th class="text-center" scope="col">Job Order</th>
                                            <th class="text-center" scope="col">Nama Part</th>
                                            <th class="text-center" scope="col">Qty</th>
                                            <th class="text-center" scope="col">Status</th>
                                            <th class="text-center" scope="col">Proses Akhir</th>
                                            @canany(['admin', 'leaderProduksi', 'ppic'])
                                                <th class="text-center" scope="col">Aksi</th>
                                            @endcanany
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            // $i = ($parts->currentPage() - 1) * $parts->perPage() + 1;
                                            $i = 0;
                                            $noPo = '';
                                        @endphp
                                        @foreach ($parts as $key => $part)
                                            @php
                                                $fp1 = DB::table('flow_proses_details')
                                                    ->select('flow_proses_details.*', 'proses.*')
                                                    ->join('proses', 'proses.id', '=', 'flow_proses_details.proses_id')
                                                    ->where('flow_proses_details.flowproses_id', $part->flowproses_id)
                                                    ->where('flow_proses_details.proses_id', $part->proses_id)
                                                    ->first();
                                                
                                                $fp2 = DB::table('flow_proses_details')
                                                    ->select('flow_proses_details.*', 'proses.*', 'schedules.planningTanggal')
                                                    ->join('proses', 'proses.id', '=', 'flow_proses_details.proses_id')
                                                    ->join('schedules', 'flow_proses_details.id', '=', 'schedules.flow_proses_detail_id')
                                                    // ->join('schedules', 'schedules.flowproses_id', '=', 'flow_proses_details.flowproses_id')
                                                    ->where('flow_proses_details.flowproses_id', $part->flowproses_id)
                                                    ->get();
                                            @endphp
                                            @if ($part->namaProses == 'DELIVERY')
                                                <tr style="background-color: greenyellow">
                                                @else
                                                <tr>
                                            @endif
                                            @if ($noPo == $part->noPo)
                                                <td></td>
                                                <td>
                                                    <p class="d-none">{{ $part->namaCustomer }}</p>
                                                </td>
                                                <td>
                                                    <p class="d-none">{{ $part->noPo }}</p>
                                                </td>
                                                <td>
                                                    <p class="d-none">{{ Carbon::parse($part->tglPo)->format('d/m/Y') }}
                                                    </p>
                                                </td>
                                                <td>
                                                    <p class="d-none">
                                                        {{ Carbon::parse($part->tglPoAkhir)->format('d/m/Y') }}</p>
                                                </td>
                                            @else
                                                @php
                                                    $i = $i + 1;
                                                @endphp
                                                <td class="text-center">{{ $i }}</td>
                                                <td>{{ $part->namaCustomer }}</td>
                                                <td>{{ $part->noPo }}</td>
                                                <td>{{ Carbon::parse($part->tglPo)->format('d/m/Y') }}</td>
                                                <td>{{ Carbon::parse($part->tglPoAkhir)->format('d/m/Y') }}</td>
                                            @endif
                                            <td>{{ $part->no_jo }}</td>
                                            <td>{{ $part->nama_barang }}</td>
                                            <td class="text-center">{{ $part->qty }}</td>
                                            <td class="text-center"><strong>{{ $part->namaProses }}</strong>
                                                @if (isset($fp1->urutan))
                                                    ({{ $fp1->urutan }}/{{ $fp2->count() }})
                                                @else
                                                    (0/{{ $fp2->count() }})
                                                @endif
                                            </td>
                                            <td class="text-center">{{ $part->tanggal ? Carbon::parse($part->tanggal)->format('d/m/Y') : '' }}
                                            </td>
                                            @canany(['admin', 'leaderProduksi', 'ppic'])
                                                <td>
                                                    @if ($part->namaProses !== 'DELIVERY')
                                                        <div class="d-flex justify-content-center">
                                                            @canany(['admin', 'leaderProduksi'])
                                                                @if ($part->namaProses !== 'QC' && $part->namaProses !== 'DELIVERY')
                                                                    <div>
                                                                        <form action="{{ route('actual.store') }}" method="POST"
                                                                            class="d-inline">
                                                                            @csrf
                                                                            <input type="hidden" name="flowproses_id"
                                                                                value="{{ $part->flowproses_id }}">
                                                                            <input type="hidden" name="namaProses" value="QC">
                                                                            <button class="btn btn-warning btn-sm border-0"
                                                                                onclick="return confirm('Yakin ingin mengubah status menjadi QC?')">QC</button>
                                                                        </form>
                                                                    </div>
                                                                @endif
                                                            @endcanany
                                                            @if ($part->namaProses === 'QC')
                                                                @canany(['admin', 'ppic'])
                                                                    <div>
                                                                        <form action="{{ route('actual.store') }}" method="POST"
                                                                            class="d-inline">
                                                                            @csrf
                                                                            <input type="hidden" name="flowproses_id"
                                                                                value="{{ $part->flowproses_id }}">
                                                                            <input type="hidden" name="namaProses"
                                                                                value="DELIVERY">
                                                                            <button class="btn btn-success btn-sm border-0"
                                                                                onclick="return confirm('Yakin ingin mengubah status menjadi DELIVERY?')">DELIVERY</button>
                                                                        </form>
                                                                    </div>
                                                                @endcanany
                                                            @endif
                                                        </div>
                                                    @endif
                                                </td>
                                            @endcanany
                                            </tr>
                                            @php
                                                $noPo = $part->noPo;
                                            @endphp
                                        @endforeach
                                        {{-- @dd(count($fp)) --}}
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
