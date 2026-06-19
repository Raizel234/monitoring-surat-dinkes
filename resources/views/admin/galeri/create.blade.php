<x-app-layout>
    <h4 class="fw-bold mb-3">Tambah Galeri</h4>

    <form action="{{ route('admin.galeri.store') }}" method="POST" enctype="multipart/form-data" class="card p-4 shadow-sm border-0 rounded-4">
        @csrf

        <div class="mb-3">
            <label class="form-label fw-semibold">Judul</label>
            <input type="text" name="judul" class="form-control" value="{{ old('judul') }}" required>
            @error('judul') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="3">{{ old('deskripsi') }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Kategori</label>
            <input type="text" name="kategori" class="form-control" value="{{ old('kategori') }}" placeholder="contoh: Kegiatan / Acara">
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Gambar</label>
            <input type="file" name="gambar" class="form-control" accept="image/*" required>
            @error('gambar') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="form-check mb-4">
            <input class="form-check-input" type="checkbox" name="is_publish" value="1" id="publish">
            <label class="form-check-label fw-semibold" for="publish">Publish sekarang</label>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('admin.galeri.index') }}" class="btn btn-light">Kembali</a>
            <button class="btn btn-success fw-bold">Simpan</button>
        </div>
    </form>
</x-app-layout>
