<x-app-layout>
    <h4 class="fw-bold mb-3">Edit Halaman</h4>

    <form action="{{ route('admin.halaman.update', $halaman->id) }}" method="POST" enctype="multipart/form-data" class="card p-4 shadow-sm border-0 rounded-4">
        @csrf @method('PUT')

        <div class="mb-3">
            <label class="form-label fw-semibold">Judul</label>
            <input type="text" name="judul" class="form-control" value="{{ old('judul',$halaman->judul) }}" required>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label fw-semibold">Kategori</label>
                <select name="kategori" class="form-select" required>
                    <option value="profil" {{ old('kategori',$halaman->kategori)=='profil' ? 'selected' : '' }}>Profil</option>
                    <option value="layanan" {{ old('kategori',$halaman->kategori)=='layanan' ? 'selected' : '' }}>Layanan</option>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-semibold">Sub Kategori</label>
                <select name="sub_kategori" class="form-select">
                    <option value="">-- Tidak ada --</option>
                    <option value="visi_misi" {{ old('sub_kategori',$halaman->sub_kategori)=='visi_misi' ? 'selected' : '' }}>Visi & Misi</option>
                    <option value="struktur" {{ old('sub_kategori',$halaman->sub_kategori)=='struktur' ? 'selected' : '' }}>Struktur Organisasi</option>
                    <option value="sosmed" {{ old('sub_kategori',$halaman->sub_kategori)=='sosmed' ? 'selected' : '' }}>Media Sosial</option>
                </select>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Gambar</label>
            <input type="file" name="gambar" class="form-control" accept="image/*">
            @if($halaman->gambar)
                <div class="mt-2">
                    <img src="{{ asset('storage/'.$halaman->gambar) }}" style="width:140px;border-radius:12px;">
                </div>
            @endif
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Konten</label>
            <textarea name="konten" class="form-control" rows="10" required>{{ old('konten',$halaman->konten) }}</textarea>
        </div>

        <div class="form-check mb-4">
            <input class="form-check-input" type="checkbox" name="is_publish" value="1" id="publish"
                   {{ old('is_publish',$halaman->is_publish) ? 'checked' : '' }}>
            <label class="form-check-label fw-semibold" for="publish">Publish</label>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('admin.halaman.index') }}" class="btn btn-light">Kembali</a>
            <button class="btn btn-success fw-bold">Update</button>
        </div>
    </form>
</x-app-layout>
