<x-app-layout>
    <h4 class="fw-bold mb-3">Edit Berita</h4>

    <form action="{{ route('admin.berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data" class="card p-4 shadow-sm border-0 rounded-4">
        @csrf @method('PUT')

        <div class="mb-3">
            <label class="form-label fw-semibold">Judul</label>
            <input type="text" name="judul" class="form-control" value="{{ old('judul',$berita->judul) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Kategori</label>
            <input type="text" name="kategori" class="form-control" value="{{ old('kategori',$berita->kategori) }}">
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Gambar</label>
            <input type="file" name="gambar" class="form-control">
            @if($berita->gambar)
                <div class="mt-2">
                    <img src="{{ asset('storage/'.$berita->gambar) }}" style="width:140px;border-radius:12px;">
                </div>
            @endif
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Ringkasan</label>
            <textarea name="ringkasan" class="form-control" rows="3">{{ old('ringkasan',$berita->ringkasan) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Konten</label>
            <textarea name="konten" class="form-control" rows="8" required>{{ old('konten',$berita->konten) }}</textarea>
        </div>

        <div class="form-check mb-4">
            <input class="form-check-input" type="checkbox" name="is_publish" value="1" id="publish"
                   {{ old('is_publish',$berita->is_publish) ? 'checked' : '' }}>
            <label class="form-check-label fw-semibold" for="publish">Publish</label>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('admin.berita.index') }}" class="btn btn-light">Kembali</a>
            <button class="btn btn-success fw-bold">Update</button>
        </div>
    </form>
</x-app-layout>
