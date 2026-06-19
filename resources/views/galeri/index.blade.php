@extends('layouts.public')

@section('title', 'Galeri')

@section('content')
<div class="container py-5">
    <h2 class="fw-bold text-center mb-1">Galeri</h2>
    <p class="text-muted text-center mb-5">Dokumentasi kegiatan Dinas Kesehatan Kabupaten Sumenep</p>

    <div class="row g-4">
        @forelse($data as $item)
            <div class="col-lg-4 col-md-6">
                <a href="{{ route('galeri.show', $item->id) }}" class="text-decoration-none">
                    <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden gallery-card">
                        <div class="position-relative" style="height:260px;overflow:hidden;">
                            <img src="{{ asset('storage/'.$item->gambar) }}"
                                 alt="{{ $item->judul }}"
                                 class="w-100 h-100"
                                 style="object-fit:cover;transition:transform .4s ease;">
                            @if($item->kategori)
                                <span class="position-absolute top-0 start-0 badge bg-primary m-2 px-3 py-2">
                                    {{ $item->kategori }}
                                </span>
                            @endif
                        </div>
                        <div class="card-body">
                            <h6 class="fw-bold text-dark mb-1">{{ $item->judul }}</h6>
                            @if($item->deskripsi)
                                <p class="text-muted small mb-0">{{ Str::limit($item->deskripsi, 100) }}</p>
                            @endif
                            <small class="text-muted">{{ $item->published_at ? $item->published_at->format('d M Y') : '' }}</small>
                        </div>
                    </div>
                </a>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <i class="bi bi-images display-1 text-muted"></i>
                <p class="text-muted mt-3">Belum ada galeri.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-4 d-flex justify-content-center">
        {{ $data->links() }}
    </div>
</div>

<style>
.gallery-card:hover img {
    transform: scale(1.08);
}
</style>
@endsection
