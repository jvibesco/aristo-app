<div class="modal fade" id="modalCreate{{ $flowproses->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    @php
        use Carbon\Carbon;
    @endphp
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Buat Plan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('schedule.store') }}" method="POST">
                    @csrf
                    <div class="container-fluid">
                        <input type="hidden" name="flowproses_id" value="{{ $flowproses->id }}">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="no_jo" class="form-label">Job Order</label>
                                    <input type="text" class="form-control"
                                        value="{{ $flowproses->joborder->no_jo }}" readonly>
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
                                    <label for="qty" class="form-label">Quantity</label>
                                    <input type="text" class="form-control" id="qty"
                                        value="{{ $flowproses->joborder->qty }}" readonly>
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
                        <table id="table-add"
                            class="table table-striped table-bordered table-hover table-responsive-sm table-sm w-100">
                            <thead>
                                <tr>
                                    <th class="text-center" scope="col">No</th>
                                    <th class="text-center" scope="col">Proses</th>
                                    <th class="text-center" scope="col">Plan Waktu (menit)</th>
                                    <th class="text-center" scope="col">Plan Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($flowproses->flowprosesdetails as $detail)
                                    <tr>
                                        <input type="hidden" name="detail_id[]" value="{{ $detail->id }}">
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="text-center"><input type="text" class="form-control"
                                                value="{{ $detail->proses->namaProses }}" readonly></td>
                                        <td class="text-center"><input type="number" class="form-control"
                                                value="{{ $detail->planningJam }}" readonly></td>
                                        <td class="text-center"><input type="date" class="form-control"
                                                name="planningTanggal[]" min="{{date("Y-m-d")}}" required></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>
