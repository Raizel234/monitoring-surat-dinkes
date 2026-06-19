@extends('layouts.public')

@section('title', $item->judul)

@section('content')
<div class="container py-5">
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ route('galeri.index') }}">Galeri</a></li>
            <li class="breadcrumb-item active">{{ $item->judul }}</li>
        </ol>
    </nav>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <img src="{{ asset('storage/'.$item->gambar) }}"
                     alt="{{ $item->judul }}"
                     class="w-100"
                     style="object-fit:cover;max-height:500px;">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 p-4">
                @if($item->kategori)
                    <span class="badge bg-primary d-inline-block mb-2 px-3 py-2" style="width:fit-content;">{{ $item->kategori }}</span>
                @endif
                <h4 class="fw-bold mb-2">{{ $item->judul }}</h4>
                <small class="text-muted d-block mb-3">
                    <i class="bi bi-calendar3 me-1"></i>{{ $item->published_at ? $item->published_at->format('d F Y') : '' }}
                </small>
                @if($item->deskripsi)
                    <p class="text-muted">{{ $item->deskripsi }}</p>
                @endif
            </div>

            @if($terkait->count())
                <div class="card border-0 shadow-sm rounded-4 p-4 mt-4">
                    <h6 class="fw-bold mb-3">Foto Lainnya</h6>
                    <div class="row g-2">
                        @foreach($terkait as $t)
                            <div class="col-6">
                                <a href="{{ route('galeri.show', $t->id) }}">
                                    <img src="{{ asset('storage/'.$t->gambar) }}"
                                         alt="{{ $t->judul }}"
                                         class="w-100 rounded-3"
                                         style="height:80px;object-fit:cover;">
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>

    <div class="text-center mt-4">
        <a href="{{ route('galeri.index') }}" class="btn btn-outline-primary rounded-pill px-4">
            <i class="bi bi-arrow-left me-1"></i>Kembali ke Galeri
        </a>
    </div>
</div>
@endsection
