@extends('layouts.public') {{-- kalau kamu belum punya, ganti jadi layout kamu atau langsung HTML --}}
@section('content')

<section class="py-5" style="background:#f6f8fb;">
    <div class="container">
        <div class="d-flex flex-wrap align-items-end justify-content-between gap-3 mb-4">
            <div>
                <h2 class="fw-bold mb-1">Berita & Kegiatan</h2>
                <p class="text-muted mb-0">Informasi resmi dan kegiatan terbaru Dinas Kesehatan Kabupaten Sumenep.</p>
            </div>
            <span class="badge rounded-pill bg-success-subtle text-success px-3 py-2">
                <i class="bi bi-megaphone-fill me-1"></i> Informasi Resmi Instansi
            </span>
        </div>

        @if($beritas->count() === 0)
            <div class="text-center py-5">
                <div class="mx-auto mb-3 d-flex align-items-center justify-content-center rounded-circle"
                     style="width:72px;height:72px;background:#fff;border:1px solid rgba(0,0,0,.08);">
                    <i class="bi bi-info-circle fs-2 text-muted"></i>
                </div>
                <div class="text-muted">Belum ada berita dipublikasikan.</div>
            </div>
        @else
            <div class="row g-4">
                @foreach($beritas as $b)
                    <div class="col-lg-4 col-md-6">
                        <a href="{{ route('berita.public.show', $b->slug) }}" class="text-decoration-none">
                            <div class="card h-100 border-0 shadow-sm" style="border-radius:18px; overflow:hidden;">
                                <div style="height:190px; background:#e9ecef;">
                                    @if($b->gambar)
                                        <img
                                            src="{{ asset('storage/'.$b->gambar) }}"
                                            alt="{{ $b->judul }}"
                                            style="width:100%;height:190px;object-fit:cover;">
                                    @else
                                        <div class="d-flex h-100 align-items-center justify-content-center text-muted">
                                            <i class="bi bi-image fs-1"></i>
                                        </div>
                                    @endif
                                </div>

                                <div class="card-body p-4">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span class="badge bg-success-subtle text-success">
                                            <i class="bi bi-tag-fill me-1"></i>{{ $b->kategori ?? 'Umum' }}
                                        </span>
                                        <small class="text-muted">
                                            <i class="bi bi-calendar3 me-1"></i>
                                            {{ optional($b->published_at)->translatedFormat('d M Y') ?? $b->created_at->translatedFormat('d M Y') }}
                                        </small>
                                    </div>

                                    <h5 class="fw-bold text-dark mb-2" style="line-height:1.25;">
                                        {{ $b->judul }}
                                    </h5>

                                    <p class="text-muted mb-0" style="display:-webkit-box;-webkit-line-clamp:3;-webkit-box-orient:vertical;overflow:hidden;">
                                        {{ $b->ringkasan ?? \Illuminate\Support\Str::limit(strip_tags($b->konten), 130) }}
                                    </p>
                                </div>

                                <div class="card-footer bg-white border-0 px-4 pb-4 pt-0">
                                    <span class="btn btn-sm btn-outline-success rounded-pill fw-bold">
                                        Baca Selengkapnya <i class="bi bi-arrow-right ms-1"></i>
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>

            <div class="mt-4">
                {{ $beritas->links() }}
            </div>
        @endif
    </div>
</section>

@endsection
