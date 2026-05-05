@extends('layouts.landing')

@section('content')

{{-- ================= HERO ================= --}}
<section class="hero" style="
    background: linear-gradient(135deg,#1f7a5c,#2e8b57);
    padding:100px 0;
    color:white;
">
    <div class="container">
        <div class="row align-items-center">

            {{-- TEXT --}}
            <div class="col-lg-7">
                <div class="mb-3">
                    <span class="badge bg-warning text-dark px-3 py-2 fw-bold">
                        <i class="bi bi-shield-lock-fill me-1"></i>
                        E-GOVERNMENT • SUMENEP
                    </span>
                </div>

                <h1 class="fw-bold mb-3">
                    Visi & Misi<br>
                    <span class="text-warning">Dinas Kesehatan</span>
                </h1>

                <p class="mb-4" style="max-width:500px;">
                    Komitmen Dinas Kesehatan Kabupaten Sumenep dalam memberikan pelayanan terbaik,
                    meningkatkan kualitas kesehatan masyarakat, dan mewujudkan sistem kesehatan
                    yang terintegrasi.
                </p>

                <a href="{{ route('home') }}" class="btn btn-light text-success fw-bold">
                    Kembali <i class="bi bi-arrow-left ms-2"></i>
                </a>
            </div>

            {{-- LOGO --}}
            <div class="col-lg-5 text-center d-none d-lg-block">
                <img src="/images/avatar/Lambang_Kabupaten_Sumenep.png" width="280">
            </div>

        </div>
    </div>
</section>

{{-- ================= CONTENT ================= --}}
<div class="container py-5">

    <div class="row g-4">

        {{-- VISI --}}
        <div class="col-md-6">
            <div class="menu-card text-center h-100">
                <i class="bi bi-bullseye fs-1 text-success"></i>
                <h4 class="mt-3 fw-bold">Visi</h4>
                <p class="text-muted mt-3">
                    Mewujudkan pelayanan kesehatan yang berkualitas, merata,
                    dan terjangkau bagi seluruh masyarakat Kabupaten Sumenep.
                </p>
            </div>
        </div>

        {{-- MISI --}}
        <div class="col-md-6">
            <div class="menu-card text-center h-100">
                <i class="bi bi-list-check fs-1 text-success"></i>
                <h4 class="mt-3 fw-bold">Misi</h4>
                <ul class="text-muted text-start mt-3">
                    <li>Meningkatkan kualitas pelayanan kesehatan</li>
                    <li>Meningkatkan SDM kesehatan</li>
                    <li>Meningkatkan fasilitas kesehatan</li>
                    <li>Meningkatkan kesadaran hidup sehat</li>
                </ul>
            </div>
        </div>

    </div>

</div>

@endsection
