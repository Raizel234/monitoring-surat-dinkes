<x-app-layout>
    <div class="p-4">
        <h4 class="fw-bold mb-3">Tambah User</h4>

        @if ($errors->any())
            <div class="alert alert-danger rounded-4">
                <ul class="mb-0">
                    @foreach($errors->all() as $e) <li>{{ $e }}</li> @endforeach
                </ul>
            </div>
        @endif

        <div class="card rounded-4 border-0 shadow-sm">
            <div class="card-body">
                <form method="POST" action="{{ route('admin.users.store') }}">
                    @csrf

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Nama</label>
                            <input name="name" class="form-control" value="{{ old('name') }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input name="email" class="form-control" value="{{ old('email') }}" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Password</label>
                            <input name="password" type="password" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Role</label>
                            <select name="role" class="form-select" required>
                                <option value="pegawai" {{ old('role')=='pegawai'?'selected':'' }}>Pegawai</option>
                                <option value="atasan" {{ old('role')=='atasan'?'selected':'' }}>Atasan</option>
                                <option value="admin" {{ old('role')=='admin'?'selected':'' }}>Admin</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Instansi</label>
                            <input name="instansi" class="form-control" value="{{ old('instansi') }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Jabatan</label>
                            <input name="jabatan" class="form-control" value="{{ old('jabatan') }}">
                        </div>
                    </div>

                    <div class="mt-4 d-flex gap-2">
                        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary rounded-pill">Kembali</a>
                        <button class="btn btn-success rounded-pill px-4">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
