<div class="modal fade" id="modalEdit{{ $flowproses->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    @php
        use Carbon\Carbon;
    @endphp
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Flow Proses</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('flowproses.update', $flowproses->id) }}" method="POST">
                    @csrf
                    @method('put')
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="jo_part" class="form-label">No. Job Order</label>
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
                                    <label for="nama_barang" class="form-label">Nama Barang</label>
                                    <input type="text" class="form-control"
                                        value="{{ $flowproses->joborder->nama_barang }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="qty" class="form-label">Quantity</label>
                                    <input type="text" class="form-control" value="{{ $flowproses->joborder->qty }}"
                                        readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="qty" class="form-label">Duedate</label>
                                    <input type="text" class="form-control"
                                        value="{{ Carbon::parse($flowproses->joborder->order->tglPoAkhir)->format('d/m/Y') }}"
                                        readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="namaMaterial" class="form-label">Material</label>
                                    <select class="form-control" style="width: 100%;" id="material_id"
                                        name="material_id">
                                        <option value="-" data-nama="" selected disabled>PILIH MATERIAL</option>
                                        @foreach ($materials as $material)
                                            @if ($material->id == $flowproses->material_id)
                                                <option value="{{ $material->id }}" selected>
                                                    {{ $material->namaMaterial }}
                                                </option>
                                            @else
                                                <option value="{{ $material->id }}">{{ $material->namaMaterial }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <table id="table-add-{{ $flowproses->id }}"
                            class="table table-striped table-bordered table-hover table-sm w-100">
                            <thead>
                                <tr>
                                    <th class="text-center" scope="col">No</th>
                                    <th class="text-center" scope="col">Proses</th>
                                    <th class="text-center" scope="col">Plan Waktu (menit)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($flowproses->flowprosesdetails as $detail)
                                    <input type="hidden" name="detail_id[]" value="{{ $detail->id }}">
                                    <tr id="row-add-{{ $loop->iteration }}">
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="text-center">
                                            <select class="form-control" name="proses_id[]">
                                                <option value="-" data-nama="" selected disabled>PILIH PROSES
                                                </option>
                                                @foreach ($proseses as $proses)
                                                    @if ($detail->proses_id == $proses->id)
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
                                        <td class="text-center"><input type="number" class="form-control"
                                                name="planningJam[]" value="{{ $detail->planningJam }}">
                                        </td>
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
