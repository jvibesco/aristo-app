<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    @php
        use Carbon\Carbon;
    @endphp
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Produksi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="{{ route('actual.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="form-group">
                            <label for="thisJob" class="col-form-label">Job Order:</label>
                            <select class="select2" style="width: 100%;" id="thisJob" name="flowproses_id"
                                required onchange="showProses(this)">
                                <option value="" data-nama="" selected disabled>PILIH JOB ORDER</option>
                                @foreach ($flowproseses as $flowproses)
                                    <option value="{{ $flowproses->id }}">JO:
                                        {{ $flowproses->joborder->no_jo }} ~ Part:
                                        {{ $flowproses->joborder->nama_barang }} ~ Qty:
                                        {{ $flowproses->joborder->qty }} ~ Material:
                                        {{ $flowproses->material->namaMaterial }} ~ Duedate:
                                        {{ Carbon::parse($flowproses->joborder->order->tglPoAkhir)->format('d/m/Y') }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        {{-- <div class="form-group">
                            <label for="material" class="col-form-label">Material:</label>
                            <input type="text" class="form-control" id="material" readonly>
                        </div>
                        <div class="form-group">
                            <label for="qtyMaterial" class="col-form-label">Quantity:</label>
                            <input type="text" class="form-control" id="qtyMaterial" readonly>
                        </div> --}}
                        <div id="showProses" class="d-none">
                            <label for="thisProses" class="col-form-label">Proses:</label>
                            <select class="select2" style="width: 100%;" id="thisProses" name="proses_id" required>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Mulai Produksi</button>
                </div>
            </form>
        </div>
    </div>
</div>
