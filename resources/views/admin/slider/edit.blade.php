<x-app-layout>
    <h4 class="fw-bold mb-3">Edit Slide</h4>

    <form action="{{ route('admin.slider.update', $slider->id) }}" method="POST" enctype="multipart/form-data" class="card p-4 shadow-sm border-0 rounded-4">
        @csrf @method('PUT')

        <div class="mb-3">
            <label class="form-label fw-semibold">Judul</label>
            <input type="text" name="judul" class="form-control" value="{{ old('judul',$slider->judul) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="2">{{ old('deskripsi',$slider->deskripsi) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Link (opsional)</label>
            <input type="url" name="link" class="form-control" value="{{ old('link',$slider->link) }}" placeholder="https://...">
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label fw-semibold">Urutan</label>
                <input type="number" name="urutan" class="form-control" value="{{ old('urutan',$slider->urutan) }}" min="0">
            </div>
            <div class="col-md-6 pt-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active"
                           {{ old('is_active',$slider->is_active) ? 'checked' : '' }}>
                    <label class="form-check-label fw-semibold" for="is_active">Aktif</label>
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Gambar</label>
            <input type="file" name="gambar" class="form-control" accept="image/*">
            @if($slider->gambar)
                <div class="mt-2">
                    <img src="{{ asset('storage/'.$slider->gambar) }}" style="width:100%;max-height:200px;object-fit:cover;border-radius:12px;">
                </div>
            @endif
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('admin.slider.index') }}" class="btn btn-light">Kembali</a>
            <button class="btn btn-success fw-bold">Update</button>
        </div>
    </form>
</x-app-layout>
