<x-app-layout>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold mb-0">Manajemen Galeri</h4>
        <a href="{{ route('admin.galeri.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle me-1"></i>Tambah Foto
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
                            <th>Gambar</th>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Status</th>
                            <th>Publish</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data as $g)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    @if($g->gambar)
                                        <img src="{{ asset('storage/'.$g->gambar) }}" style="width:60px;height:40px;object-fit:cover;border-radius:6px;">
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td class="fw-semibold">{{ $g->judul }}</td>
                                <td>{{ $g->kategori ?? '-' }}</td>
                                <td>
                                    @if($g->is_publish)
                                        <span class="badge bg-success">Publish</span>
                                    @else
                                        <span class="badge bg-secondary">Draft</span>
                                    @endif
                                </td>
                                <td>{{ $g->published_at ? $g->published_at->format('d/m/Y') : '-' }}</td>
                                <td class="text-end">
                                    <a href="{{ route('admin.galeri.edit', $g->id) }}" class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.galeri.destroy', $g->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus foto ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">Belum ada foto.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">{{ $data->links() }}</div>
        </div>
    </div>
</x-app-layout>
