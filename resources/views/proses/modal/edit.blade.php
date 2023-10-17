<div class="modal fade" id="modalEdit{{ $proses->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Proses</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('proses.update', $proses->id) }}" method="POST">
                @csrf
                @method('put')
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="namaProses" class="form-label">Nama Proses</label>
                                    <input type="text" class="form-control @error('namaProses') is-invalid @enderror"
                                        id="namaProses" name="namaProses"
                                        value="{{ old('namaProses', $proses->namaProses) }}">
                                    @error('namaProses')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
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
