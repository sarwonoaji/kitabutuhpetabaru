@extends('layout.landing')

@section('title', 'Kita Butuh Peta')
@section('content')

<!-- TEKS SAMBUTAN -->
<section class="hero">
    <div class="container">
        <h1 class="title">Hallo,</h1>
        <p class="subtitle muted">Selamat Datang!</p>
    </div>
</section>

<!-- HERO SLIDER -->
<!-- HERO SLIDER -->
<section class="slider-section">
    <div class="container">
        <div id="carouselLocal" class="carousel-local">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('slider/1.jpg') }}" alt="Slide 1">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('slider/2.jpg') }}" alt="Slide 2">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('slider/3.jpg') }}" alt="Slide 3">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- MENU UTAMA -->
<section class="section-pad" style="background:#fff">
    <div class="container">
        <div class="grid-2">

            @php
            $menus = [
                ['title'=>'Kependudukan','image'=>asset('icon/penduduk.png'),'route'=>'kependudukan'],
                ['title'=>'Aset Desa','image'=>asset('icon/aset.png'),'route'=>'aset'],
                ['title'=>'UMKM','image'=>asset('icon/umkm.png'),'route'=>'umkm'],
                ['title'=>'Ternak & Tani','image'=>asset('icon/ternak.png'),'route'=>'ternak'],
                ['title'=>'Industri','image'=>asset('icon/industri.png'),'route'=>'industri'],
                ['title'=>'Informasi','image'=>asset('icon/informasi.png'),'route'=>'informasi'],
            ];
            @endphp

            @foreach($menus as $menu)
            <a href="{{ route($menu['route']) }}" class="card">
                <div class="card-inner">
                    <div class="icon-circle">
                        <img src="{{ $menu['image'] }}" class="icon-img">
                    </div>
                    <span class="text-sm font-semibold">{{ $menu['title'] }}</span>
                </div>
            </a>
            @endforeach

        </div>
    </div>
</section>

<!-- FITUR -->

    <section class="section-pad" style="background:var(--bg-gray)">
    <div class="container">
         <h2 class="title-lg">Layanan Administrasi & Buku Tamu Klik dibawah ini</h2>
        {{-- <h3><img src="{{ asset('icon/layanan.png') }}" alt="Informasi" class="icon-img"> Layanan Administrasi & Buku Tamu Klik dibawah ini</h3>
         --}}
        <div class="grid-2">

            @php
            $fitur = [
                ['title'=>'Grafik Tamu','image'=>asset('icon/grafik-tamu.png'),'route'=>'grafik'],
                ['title'=>'Administrasi','image'=>asset('icon/layanan-admin.png'),'url'=>'https://pemdesbutuh.id/layanan/login'],
                ['title'=>'Persyaratan','image'=>asset('icon/persyaratan.png'),'route'=>'persyaratan'],
                ['title'=>'Masukan','image'=>asset('icon/masukan.png'),'route'=>'masukan.create'],
            ];
            @endphp

            @foreach($fitur as $item)
            <a href="{{ $item['url'] ?? route($item['route']) }}" class="card">
                <div class="card-inner">
                    <div class="icon-circle">
                        <img src="{{ $item['image'] }}" class="icon-img">
                    </div>
                    <span class="text-sm font-semibold text-center">{{ $item['title'] }}</span>
                </div>
            </a>
            @endforeach

        </div>
    </div>
</section>

@endsection


{{-- STYLE --}}
@push('styles')
<style>
.icon-circle {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 3px 10px rgba(0,0,0,0.15);
}

.icon-img {
    width: 40px;
    height: 40px;
    object-fit: contain;
}

.title-lg-icon {
    width: 40px;
    height: 40px;
    object-fit: contain;
    vertical-align: middle;
    margin-right: 8px;
}

.card-inner {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 8px;
}
</style>
@endpush


{{-- SCRIPT SLIDER --}}
@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function () {
    const carousel = document.getElementById('carouselLocal');
    if (!carousel) return;

    const inner = carousel.querySelector('.carousel-inner');
    const items = carousel.querySelectorAll('.carousel-item');
    let idx = 0;

    function goTo(i){
        inner.style.transform = `translateX(-${i * 100}%)`;
    }

    function next(){
        idx = (idx + 1) % items.length;
        goTo(idx);
    }

    // start
    console.log('carouselLocal init', items.length);
    goTo(0);
    const intervalId = setInterval(next, 3000);
    // expose for debug
    window.__carouselLocal = {goTo, next, items, intervalId};
});
</script>
@endpush