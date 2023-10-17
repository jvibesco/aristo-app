<div class="modal fade" id="editModal{{ $user->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="{{ route('user.update', $user->id) }}">
                @method('PUT')
                @csrf
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="nama" class="col-form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="nama" name="nama"
                                        value="{{ $user->nama }}" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="nik" class="col-form-label">Nomor Induk Karyawan (NIK)</label>
                                    <input type="number" class="form-control" id="nik" name="nik"
                                        value="{{ $user->nik }}" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="role" class="col-form-label">Role</label>
                                    <select class="form-control" id="role" name="role_id">
                                        <option value="" data-nama="" disabled>PILIH ROLE</option>
                                        @foreach ($roles as $role)
                                            @if ($user->role_id == $role->id)
                                                <option value="{{ $role->id }}" selected>
                                                    {{ $role->role }}
                                                </option>
                                            @else
                                                <option value="{{ $role->id }}">
                                                    {{ $role->role }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
            </form>
        </div>
    </div>
</div>
