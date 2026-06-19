<x-app-layout>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold mb-0">Manajemen Halaman</h4>
        <a href="{{ route('admin.halaman.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle me-1"></i>Tambah Halaman
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table align-middle table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Sub Kategori</th>
                            <th>Status</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data as $h)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="fw-semibold">{{ $h->judul }}</td>
                                <td><span class="badge bg-info text-dark">{{ $h->kategori }}</span></td>
                                <td>{{ $h->sub_kategori ?? '-' }}</td>
                                <td>
                                    @if($h->is_publish)
                                        <span class="badge bg-success">Publish</span>
                                    @else
                                        <span class="badge bg-secondary">Draft</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('admin.halaman.edit', $h->id) }}" class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.halaman.destroy', $h->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus halaman ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">Belum ada halaman.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">{{ $data->links() }}</div>
        </div>
    </div>
</x-app-layout>
