@extends('layouts.public')

@section('title', $berita->judul . ' | Berita Dinkes Sumenep')

@section('content')
<section class="py-5" style="background:#f6f8fb;">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm" style="border-radius:18px; overflow:hidden;">
                    @if($berita->gambar)
                        <img src="{{ asset('storage/'.$berita->gambar) }}" alt="{{ $berita->judul }}"
                             style="width:100%;height:340px;object-fit:cover;">
                    @endif

                    <div class="card-body p-4 p-md-5">
                        <div class="d-flex flex-wrap gap-2 align-items-center mb-3">
                            <span class="badge bg-success-subtle text-success">
                                <i class="bi bi-tag-fill me-1"></i>{{ $berita->kategori ?? 'Umum' }}
                            </span>
                            <span class="text-muted small">
                                <i class="bi bi-calendar3 me-1"></i>
                                {{ optional($berita->published_at)->translatedFormat('l, d F Y') ?? $berita->created_at->translatedFormat('l, d F Y') }}
                            </span>
                        </div>

                        <h1 class="fw-bold mb-3" style="line-height:1.15;">{{ $berita->judul }}</h1>

                        @if($berita->ringkasan)
                            <p class="text-muted fs-5">{{ $berita->ringkasan }}</p>
                            <hr>
                        @endif

                        <article class="lh-lg" style="color:#111827;">
                            {!! $berita->konten !!}
                        </article>
                    </div>
                </div>

                <div class="mt-4">
                    <a href="{{ route('berita.public.index') }}" class="btn btn-outline-success rounded-pill fw-bold">
                        <i class="bi bi-arrow-left me-2"></i>Kembali ke Berita
                    </a>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card border-0 shadow-sm" style="border-radius:18px;">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-3">Berita Terkait</h5>

                        @forelse($terkait as $t)
                            <a class="d-flex gap-3 text-decoration-none mb-3"
                               href="{{ route('berita.public.show', $t->slug) }}">
                                <div style="width:72px;height:72px;border-radius:14px;overflow:hidden;background:#e9ecef;flex:0 0 auto;">
                                    @if($t->gambar)
                                        <img src="{{ asset('storage/'.$t->gambar) }}" alt="{{ $t->judul }}"
                                             style="width:100%;height:100%;object-fit:cover;">
                                    @else
                                        <div class="h-100 d-flex align-items-center justify-content-center text-muted">
                                            <i class="bi bi-image"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="min-w-0">
                                    <div class="fw-bold text-dark" style="line-height:1.2;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">
                                        {{ $t->judul }}
                                    </div>
                                    <div class="text-muted small mt-1">
                                        {{ optional($t->published_at)->translatedFormat('d M Y') ?? $t->created_at->translatedFormat('d M Y') }}
                                    </div>
                                </div>
                            </a>
                        @empty
                            <div class="text-muted">Belum ada berita terkait.</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
