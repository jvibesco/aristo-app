@php
    use Carbon\Carbon;
@endphp
<div class="modal fade" id="showModal{{ $actual->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Info Produksi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="part_id" class="col-form-label">Job Order</label>
                                <input type="text" class="form-control"
                                    value="{{ $actual->flowproses->joborder->no_jo }}" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="part_id" class="col-form-label">Nama Part</label>
                                <input type="text" class="form-control"
                                    value="{{ $actual->flowproses->joborder->nama_barang }}" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="part_id" class="col-form-label">Material</label>
                                <input type="text" class="form-control"
                                    value="{{ $actual->flowproses->material->namaMaterial }}" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="part_id" class="col-form-label">Quantity</label>
                                <input type="text" class="form-control"
                                    value="{{ $actual->flowproses->joborder->qty }}" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tanggal" class="col-form-label">Tanggal Proses</label>
                                <input type="text" class="form-control" value="{{ $actual->tanggal }}" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="proses_id" class="col-form-label">Proses</label>
                                <input type="text" class="form-control" value="{{ $actual->proses->namaProses }}"
                                    disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-form-label">Jam Mulai</label>
                                <input type="text" class="form-control"
                                    value="{{ Carbon::parse($actual->jam_mulai)->format('H:i') }}" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-form-label">Jam Selesai</label>
                                <input type="text" class="form-control"
                                    value="{{ Carbon::parse($actual->jam_selesai)->format('H:i') }}" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Keterangan</label>
                        <textarea class="form-control" disabled>{{ $actual->ket_selesai }}</textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
