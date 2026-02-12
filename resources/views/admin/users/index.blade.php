<x-app-layout>
    <div class="p-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h4 class="fw-bold mb-0">Data User</h4>
                <div class="text-muted small">Admin bisa membuat akun pegawai dan admin.</div>
            </div>
            <a href="{{ route('admin.users.create') }}" class="btn btn-success rounded-pill">
                + Tambah User
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success rounded-4">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger rounded-4">{{ session('error') }}</div>
        @endif

        <form class="row g-2 mb-3" method="GET">
            <div class="col-md-6">
                <input type="text" name="q" value="{{ $q }}" class="form-control"
                       placeholder="Cari nama/email/instansi/jabatan...">
            </div>
            <div class="col-md-2">
                <button class="btn btn-outline-primary w-100">Cari</button>
            </div>
        </form>

        <div class="card rounded-4 border-0 shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Instansi</th>
                            <th>Jabatan</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($users as $u)
                            <tr>
                                <td>{{ $u->id }}</td>
                                <td class="fw-semibold">{{ $u->name }}</td>
                                <td>{{ $u->email }}</td>
                                <td>
                                    <span class="badge {{ $u->role === 'admin' ? 'bg-danger' : 'bg-secondary' }}">
                                        {{ strtoupper($u->role) }}
                                    </span>
                                </td>
                                <td>{{ $u->instansi ?? '-' }}</td>
                                <td>{{ $u->jabatan ?? '-' }}</td>
                                <td class="text-end">
                                    <a href="{{ route('admin.users.edit', $u->id) }}"
                                       class="btn btn-sm btn-warning rounded-pill">Edit</a>

                                    <form action="{{ route('admin.users.destroy', $u->id) }}"
                                          method="POST" class="d-inline"
                                          onsubmit="return confirm('Hapus user ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger rounded-pill">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="7" class="text-center text-muted">Belum ada user.</td></tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                {{ $users->withQueryString()->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
