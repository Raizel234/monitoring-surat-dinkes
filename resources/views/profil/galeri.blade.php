@extends('layouts.landing')

@section('content')
<div class="container py-5 text-center">
    <h2 class="fw-bold mb-4">Galeri</h2>

    <div class="row">
        <div class="col-md-4">
            <img src="{{ asset('images/galeri1.jpg') }}" class="img-fluid rounded">
        </div>
    </div>
</div>
@endsection
