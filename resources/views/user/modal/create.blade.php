<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="{{ route('user.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="nama" class="col-form-label">Nama</label>
                                    <input type="text" class="form-control" id="nama" name="nama"
                                        value="{{ old('username') }}" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="nik" class="col-form-label">Nomor Induk Karyawan (NIK)</label>
                                    <input type="number" class="form-control" id="nik" name="nik" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="password" class="col-form-label">Password</label>
                                    <input type="text" class="form-control" id="password" name="password" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="role" class="col-form-label">Role</label>
                                    <select class="form-control" id="role" name="role_id" required>
                                        <option value="" data-nama="" selected disabled>PILIH ROLE</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->role }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
