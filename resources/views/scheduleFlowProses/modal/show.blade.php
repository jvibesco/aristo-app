<div class="modal fade" id="modalShow{{ $flowproses->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    @php
        use Carbon\Carbon;
    @endphp
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Lihat Plan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="jo_part" class="form-label">Job Order</label>
                                <input type="text" class="form-control" value="{{ $flowproses->joborder->no_jo }}"
                                    readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">No. PO</label>
                                <input type="text" class="form-control"
                                    value="{{ $flowproses->joborder->order->noPo }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="jo_part" class="form-label">Nama Part</label>
                                <input type="text" class="form-control"
                                    value="{{ $flowproses->joborder->nama_barang }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="jo_part" class="form-label">Quantity</label>
                                <input type="text" class="form-control" value="{{ $flowproses->joborder->qty }}"
                                    readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Duedate</label>
                                <input type="text" class="form-control"
                                    value="{{ Carbon::parse($flowproses->joborder->order->tglPoAkhir)->format('d/m/Y') }}"
                                    readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="namaMaterial" class="form-label">Material</label>
                                <input type="text" class="form-control"
                                    value="{{ $flowproses->material->namaMaterial }}" readonly>
                            </div>
                        </div>
                    </div>
                    <table id="table-add" class="table table-striped table-bordered table-responsive-sm table-sm w-100">
                        <thead>
                            <tr>
                                <th class="text-center" scope="col">No</th>
                                <th class="text-center" scope="col">Proses</th>
                                <th class="text-center" scope="col">Plan Waktu (Menit)</th>
                                <th class="text-center" scope="col">Plan Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($flowproses->flowprosesdetails as $detail)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $detail->proses->namaProses }}</td>
                                    <td class="text-center">{{ $detail->planningJam }}</td>
                                    <td class="text-center">
                                        {{ Carbon::parse($detail->schedule->planningTanggal)->format('d/m/Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
