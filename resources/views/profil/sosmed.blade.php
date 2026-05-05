@extends('layouts.landing')

@section('content')
    <section class="py-5" style="background: #f8fafc;">
        <div class="container">

            <h2 class="fw-bold text-center mb-5">
                Hubungi & Sosial Media
            </h2>

            <div class="row g-4">

                {{-- MAP --}}
                <div class="col-lg-7">
                    <div class="bg-white p-4 rounded-4 shadow-sm h-100">
                        <h5 class="fw-bold mb-3">
                            <i class="bi bi-geo-alt-fill text-danger"></i> Lokasi Kantor
                        </h5>

                        <iframe src="https://www.google.com/maps?q=Jl.%20Jokotole%20No.%2005%20Sumenep&output=embed"
                            width="100%" height="320" style="border:0; border-radius:12px;" allowfullscreen
                            loading="lazy">
                        </iframe>

                        <p class="small text-muted mt-3 mb-0">
                            Dinas Kesehatan Kabupaten Sumenep, Jawa Timur
                        </p>
                    </div>
                </div>

                {{-- CONTACT INFO --}}
                <div class="col-lg-5">
                    <div class="p-4 rounded-4 shadow text-white h-100"
                        style="background: linear-gradient(135deg, #198754, #157347);">

                        <h5 class="fw-bold mb-4 text-warning">
                            <i class="bi bi-chat-dots-fill"></i> Kontak Kami
                        </h5>

                        {{-- ALAMAT --}}
                        <div class="mb-3 d-flex align-items-center gap-3">
                            <i class="bi bi-geo-alt fs-5"></i>
                            <span>Jl. Jokotole No. 05 Sumenep</span>
                        </div>

                        {{-- TELEPON --}}
                        <div class="mb-3 d-flex align-items-start gap-3">
                            <i class="bi bi-telephone fs-5 mt-1"></i>
                            <div>
                                <div>Rizal : 0812-3456-7890</div>
                                <div>Zubil : 0821-9876-5432</div>
                            </div>
                        </div>

                        {{-- EMAIL --}}
                        <div class="mb-3 d-flex align-items-center gap-3">
                            <i class="bi bi-envelope fs-5"></i>
                            <span>dinkessumenep@gmail.com</span>
                        </div>

                        {{-- WHATSAPP --}}
                        <div class="mb-3 d-flex align-items-start gap-3">
                            <i class="bi bi-whatsapp fs-5 mt-1"></i>
                            <div>
                                <div>
                                    Rizal :
                                    <a href="https://wa.me/6281252364692" class="text-white text-decoration-none">
                                        0812-5236-4692
                                    </a>
                                </div>
                                <div>
                                    Zubil :
                                    <a href="https://wa.me/6283114749373" class="text-white text-decoration-none">
                                        0831-1474-9373
                                    </a>
                                </div>
                            </div>
                        </div>

                        {{-- TELEGRAM --}}
                        <div class="mb-3 d-flex align-items-center gap-3">
                            <i class="bi bi-telegram fs-5"></i>
                            <span>Telegram: @dinkes_sumenep</span>
                        </div>

                        <hr style="border-color: rgba(255,255,255,0.2)">

                        <h6 class="fw-bold mb-3">Sosial Media</h6>

                        {{-- SOCIAL ICONS --}}
                        <div class="d-flex flex-wrap gap-3 fs-4">

                            <a href="#" class="text-white">
                                <i class="bi bi-instagram"></i>
                            </a>

                            <a href="#" class="text-white">
                                <i class="bi bi-facebook"></i>
                            </a>

                            <a href="#" class="text-white">
                                <i class="bi bi-twitter"></i>
                            </a>

                            <a href="#" class="text-white">
                                <i class="bi bi-tiktok"></i>
                            </a>

                            <a href="#" class="text-white">
                                <i class="bi bi-youtube"></i>
                            </a>

                        </div>

                        {{-- BUTTON EMAIL --}}
                        <div class="mt-4">
                            <a href="mailto:dinkessumenep@gmail.com" class="btn btn-warning w-100 rounded-pill fw-bold">
                                <i class="bi bi-send-fill me-2"></i>Kirim Email
                            </a>
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </section>
@endsection
