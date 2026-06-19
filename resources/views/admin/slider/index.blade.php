<x-app-layout>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold mb-0">Manajemen Slider</h4>
        <a href="{{ route('admin.slider.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle me-1"></i>Tambah Slide
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
                            <th>Urutan</th>
                            <th>Status</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data as $s)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    @if($s->gambar)
                                        <img src="{{ asset('storage/'.$s->gambar) }}" style="width:100px;height:50px;object-fit:cover;border-radius:6px;">
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td class="fw-semibold">{{ $s->judul }}</td>
                                <td>{{ $s->urutan }}</td>
                                <td>
                                    @if($s->is_active)
                                        <span class="badge bg-success">Aktif</span>
                                    @else
                                        <span class="badge bg-secondary">Nonaktif</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('admin.slider.edit', $s->id) }}" class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.slider.destroy', $s->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus slide ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">Belum ada slider.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">{{ $data->links() }}</div>
        </div>
    </div>
</x-app-layout>
