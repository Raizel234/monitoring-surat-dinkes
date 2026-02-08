<x-app-layout>
    <h4 class="fw-bold mb-3">Tambah Berita</h4>

    <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data" class="card p-4 shadow-sm border-0 rounded-4">
        @csrf

        <div class="mb-3">
            <label class="form-label fw-semibold">Judul</label>
            <input type="text" name="judul" class="form-control" value="{{ old('judul') }}" required>
            @error('judul') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Kategori</label>
            <input type="text" name="kategori" class="form-control" value="{{ old('kategori') }}" placeholder="contoh: Kegiatan / Pengumuman">
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Gambar (thumbnail)</label>
            <input type="file" name="gambar" class="form-control">
            @error('gambar') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Ringkasan</label>
            <textarea name="ringkasan" class="form-control" rows="3">{{ old('ringkasan') }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Konten</label>
            <textarea name="konten" class="form-control" rows="8" required>{{ old('konten') }}</textarea>
            @error('konten') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="form-check mb-4">
            <input class="form-check-input" type="checkbox" name="is_publish" value="1" id="publish">
            <label class="form-check-label fw-semibold" for="publish">
                Publish sekarang
            </label>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('admin.berita.index') }}" class="btn btn-light">Kembali</a>
            <button class="btn btn-success fw-bold">Simpan</button>
        </div>
    </form>
</x-app-layout>
