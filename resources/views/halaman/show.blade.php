@extends('layouts.public')

@section('title', $halaman->judul)

@section('content')
<div class="container py-5">
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Beranda</a></li>
            <li class="breadcrumb-item active">{{ $halaman->judul }}</li>
        </ol>
    </nav>

    <div class="row g-4">
        @if($halaman->gambar)
            <div class="col-lg-4">
                <img src="{{ asset('storage/'.$halaman->gambar) }}"
                     alt="{{ $halaman->judul }}"
                     class="w-100 rounded-4 shadow-sm"
                     style="object-fit:cover;max-height:400px;">
            </div>
            <div class="col-lg-8">
                <h2 class="fw-bold mb-3">{{ $halaman->judul }}</h2>
                <article class="konten-cms">
                    {!! $halaman->konten !!}
                </article>
            </div>
        @else
            <div class="col-12">
                <h2 class="fw-bold mb-3">{{ $halaman->judul }}</h2>
                <article class="konten-cms">
                    {!! $halaman->konten !!}
                </article>
            </div>
        @endif
    </div>
</div>

<style>
.konten-cms h1, .konten-cms h2, .konten-cms h3 { margin-top: 1.5rem; }
.konten-cms p { line-height: 1.8; margin-bottom: 1rem; }
.konten-cms img { max-width: 100%; border-radius: 12px; }
.konten-cms ul, .konten-cms ol { margin-bottom: 1rem; }
.konten-cms blockquote {
    border-left: 4px solid #0d6efd;
    padding-left: 1rem;
    color: #6c757d;
    font-style: italic;
}
</style>
@endsection
