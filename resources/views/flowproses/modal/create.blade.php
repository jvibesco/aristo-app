<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    @php
        use Carbon\Carbon;
    @endphp
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Buat Flow Proses</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('flowproses.store') }}" method="POST">
                    @csrf
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="form-label">Job Order</label>
                                    <select class="select2" style="width: 100%;" id="joborder_id" name="joborder_id"
                                        onchange="getNamaPart(this)" required>
                                        <option value="" data-name="" selected disabled>PILIH JOB ORDER</option>
                                        @foreach ($joborders as $joborder)
                                            @if (!isset($joborder->flowproses))
                                                <option value="{{ $joborder->id }}"
                                                    data-name="{{ $joborder->nama_barang }}">JO: {{ $joborder->no_jo }}
                                                    ~ Part:
                                                    {{ $joborder->nama_barang }} ~ Qty:
                                                    {{ $joborder->qty }} ~ DD:
                                                    {{ Carbon::parse($joborder->order->tglPoAkhir)->format('d/m/Y') }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="material_id" class="form-label">Material</label>
                                    <select class="form-control material" style="width: 100%;" id="material_id"
                                        name="material_id" required>
                                        <option value="" data-nama="" selected disabled>PILIH MATERIAL</option>
                                        @foreach ($materials as $material)
                                            <option value="{{ $material->id }}">{{ $material->namaMaterial }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <table id="table-add"
                            class="table table-striped table-bordered table-hover table-responsive-sm table-sm w-100">
                            <thead>
                                <tr>
                                    <th class="text-center" scope="col" style="width: 45px">
                                        <button id="add" class="btn btn-xs btn-plain" type="button"
                                            onclick="addRow()">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </th>
                                    <th class="text-center" scope="col" style="width: 50px">No</th>
                                    <th class="text-center" scope="col" style="width: 400px">Proses</th>
                                    <th class="text-center" scope="col">Plan Waktu (menit)
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="row-add-1">
                                    <td class="text-center">
                                        <button class="btn btn-xs btn-plain" type="button" disabled>
                                            <i class="fas fa-minus text-danger"></i>
                                        </button>
                                    </td>
                                    <input type="hidden" name="urutan[]" value='1'>
                                    <td class="text-center">1</td>
                                    <td class="text-center">
                                        <select class="form-control" name="proses_id[]" required>
                                            <option value="" data-nama="" selected disabled>PILIH PROSES
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
                                    <td class="text-center"><input type="number" class="form-control"
                                            name="planningJam[]"></td>
                                </tr>
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
