@extends('layouts.app', ['title' => 'Laporan Produksi'])

@section('konten')
    @php
        use Carbon\Carbon;
    @endphp
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col">
                    <h1 class="m-0 text-center">Laporan Produksi</h1>
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
                            <div class="col-md-6">
                                <label for="tanggal_awal" class="col-form-label">Tanggal Awal</label>
                                <input type="date" class="form-control" id="tanggal_awal" name="tanggal_awal" value="{{ $tanggal_awal }}">
                                {{-- value="{{ $tanggal_awal ? $tanggal_awal : now()->toDateString() }}" --}}
                            </div>
                            <div class="col-md-6">
                                <label for="tanggal_akhir" class="col-form-label">Tanggal Akhir</label>
                                <input type="date" class="form-control" id="tanggal_akhir" name="tanggal_akhir"
                                    value="{{ $tanggal_akhir }}">
                                {{-- value="{{ $tanggal_akhir ? $tanggal_akhir : now()->toDateString() }}" --}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="joborder_id" class="col-form-label">Job Order</label>
                                <select id="mySelect" style="width: 100%;" name="joborder_id">
                                    <option value="" data-nama="" selected>-</option>
                                    @foreach ($joborders as $joborder)
                                        @if ($joborder_id == $joborder->joborder->id)
                                            <option value="{{ $joborder->joborder->id }}" selected>JO:
                                                {{ $joborder->joborder->no_jo }} ~ Part:
                                                {{ $joborder->joborder->nama_barang }} ~ Qty:
                                                {{ $joborder->joborder->qty }}
                                            </option>
                                        @else
                                            <option value="{{ $joborder->joborder->id }}">JO:
                                                {{ $joborder->joborder->no_jo }} ~ Part:
                                                {{ $joborder->joborder->nama_barang }} ~ Qty:
                                                {{ $joborder->joborder->qty }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="user_id" class="col-form-label">Operator</label>
                                <select id="mySelect2" style="width: 100%;" id="user_id" name="user_id">
                                    <option value="" data-nama="" selected>ALL</option>
                                    @foreach ($users as $user)
                                        @if ($user_id == $user->id)
                                            <option value="{{ $user->id }}" selected>
                                                {{ $user->nama }}
                                            </option>
                                        @else
                                            <option value="{{ $user->id }}">
                                                {{ $user->nama }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="button-container d-flex justify-content-center mt-3">
                            <button class="btn btn-success mr-3">Display</button>
                            <button class="btn btn-secondary" style="width: 80px" onclick="clearForm2(event)">Clear</button>
                        </div>
                    </form>
                </div>

                @if ($tanggal_awal || $tanggal_akhir || $joborder_id || $user_id)
                    <div class="card-body">
                        {{-- /.row --}}
                        <div class="row">
                            <div class="table-responsive col-lg-12">
                                <table id="example0" class="table table-bordered table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th class="text-center" scope="col">No</th>
                                            <th class="text-center" scope="col">Job Order</th>
                                            <th class="text-center" scope="col">Nama Part</th>
                                            <th class="text-center" scope="col">Material</th>
                                            <th class="text-center" scope="col">Qty</th>
                                            <th class="text-center" scope="col">Duedate</th>
                                            <th class="text-center" scope="col">Proses</th>
                                            <th class="text-center" scope="col">Plan Tanggal</th>
                                            <th class="text-center" scope="col">Act Tanggal</th>
                                            <th class="text-center" scope="col">Lama Proses</th>
                                            <th class="text-center" scope="col">Operator</th>
                                            <th class="text-center" scope="col">Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($produksi as $p)
                                            @php
                                                $plan = DB::table('flow_proses_details')
                                                    ->join('schedules', 'schedules.flow_proses_detail_id', '=', 'flow_proses_details.id')
                                                    ->where('flow_proses_details.flowproses_id', $p->flowproses_id)
                                                    ->where('flow_proses_details.proses_id', $p->proses_id)
                                                    ->first();
                                            @endphp

                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>{{ $p->no_jo }}</td>
                                                <td>{{ $p->nama_barang }}</td>
                                                <td>{{ $p->namaMaterial }}</td>
                                                <td class="text-center">{{ $p->qty }}</td>
                                                <td class="text-center">
                                                    {{ Carbon::parse($p->tglPoAkhir)->format('d/m/Y') }}</td>
                                                <td>{{ $p->namaProses }}</td>
                                                <td class="text-center">
                                                    @if (isset($plan->planningTanggal))
                                                        {{ Carbon::parse($plan->planningTanggal)->format('d/m/Y') }}
                                                    @endif
                                                </td>

                                                @if (isset($plan->planningTanggal))
                                                    @if ($p->tanggal > $plan->planningTanggal)
                                                        <td class="text-center" style="background-color: red">
                                                            {{ Carbon::parse($p->tanggal)->format('d/m/Y') }}</td>
                                                    @else
                                                        <td class="text-center">
                                                            {{ Carbon::parse($p->tanggal)->format('d/m/Y') }}
                                                        </td>
                                                    @endif
                                                @else
                                                    <td class="text-center">
                                                        {{ Carbon::parse($p->tanggal)->format('d/m/Y') }}
                                                    </td>
                                                @endif

                                                @if (isset($plan->planningJam))
                                                    @if ($p->durasi - $plan->planningJam <= 0)
                                                        <td class="text-center">
                                                            {{ $p->durasi }} Menit</td>
                                                    @else
                                                        <td class="text-center" style="background-color: red"
                                                            data-toggle="tooltip" data-placement="top"
                                                            title="Lebih {{ $p->durasi - $plan->planningJam }} menit dari waktu plan">
                                                            {{ $p->durasi }} Menit</td>
                                                    @endif
                                                @else
                                                    <td class="text-center">
                                                        {{ $p->durasi }}</td>
                                                @endif
                                                <td>{{ $p->operator }}</td>
                                                <td>{{ $p->ket_selesai }}</td>
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
