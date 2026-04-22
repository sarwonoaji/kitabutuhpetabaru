@extends('layout.landing')

@section('content')

<!-- TEKS SAMBUTAN -->
<section class="hero">
    <div class="container">
        <h1 class="title">Hallo,</h1>
        <p class="subtitle muted">Selamat Datang!</p>
    </div>
</section>

<!-- HERO SLIDER -->
<section class="slider-section">
    <div class="container slider-wrapper">
        <div id="slider">
            <div class="slide" style="background-image:url('{{ asset('slider/1.jpg') }}');">
                <div class="overlay">
                    <div>
                        <h1 style="font-size:20px;font-weight:700">Kitab Utuh Peta</h1>
                        <p style="margin-top:6px">Sistem Informasi Desa Digital</p>
                    </div>
                </div>
            </div>
            <div class="slide" style="background-image:url('{{ asset('slider/2.jpg') }}');">
                <div class="overlay">
                    <div>
                        <h1 style="font-size:20px;font-weight:700">Peta Aset Desa</h1>
                        <p style="margin-top:6px">Kelola data aset dengan mudah</p>
                    </div>
                </div>
            </div>
            <div class="slide" style="background-image:url('{{ asset('slider/3.jpg') }}');">
                <div class="overlay">
                    <div>
                        <h1 style="font-size:20px;font-weight:700">Smart Village</h1>
                        <p style="margin-top:6px">Digitalisasi Desa Modern</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="dots">
            <span class="dot"></span>
            <span class="dot"></span>
            <span class="dot"></span>
        </div>
    </div>
</section>

<!-- MENU UTAMA -->
<section class="section-pad" style="background:var(--bg-gray)">
    <div class="container">
        <div class="grid-2">

            @php
            $menus = [
                ['title'=>'Kependudukan','image'=>'https://i.ibb.co/CKfz2yF/11-removebg-preview.png','route'=>'kependudukan'],
                ['title'=>'Aset Desa','image'=>'https://i.ibb.co/wdb9j6V/12-removebg-preview.png','route'=>'aset'],
                ['title'=>'UMKM','image'=>'https://i.ibb.co/jvv6kf4/umkmtoko-removebg-preview.png','route'=>'umkm'],
                ['title'=>'Ternak & Tani','image'=>'https://i.ibb.co/1zP06Z6/ternaktani.png','route'=>'ternak'],
                ['title'=>'Industri','image'=>'https://i.ibb.co/PW36Chc/pabrikindustri.png','route'=>'industri'],
                ['title'=>'Informasi','image'=>asset('informasi.png'),'route'=>'informasi'],
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
<section class="section-pad" style="background:#fff">
    <div class="container">
        <h2 class="title-lg">Layanan Administrasi & Buku Tamu</h2>
        <div class="grid-2">

            @php
            $fitur = [
                ['title'=>'Grafik Tamu','image'=>'https://i.ibb.co/qs6ZQpb/buku-tamu.png','route'=>'grafik'],
                ['title'=>'Administrasi','image'=>'https://i.ibb.co/vLtVZ70/layanan.png','url'=>'https://pemdesbutuh.id/layanan/login'],
                ['title'=>'Persyaratan','image'=>'https://i.ibb.co/C2pWnMD/informasi.png','route'=>'persyaratan'],
                ['title'=>'Masukan','image'=>asset('pink.png'),'route'=>'masukan'],
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

    let index = 0;

    const slider = document.getElementById('slider');
    const dots = document.querySelectorAll('.dot');

    if (!slider) return;

    function showSlide(i) {
        slider.style.transform = `translateX(-${i * 100}%)`;

        dots.forEach((dot, idx) => {
            dot.style.opacity = (idx === i) ? "1" : "0.4";
        });
    }

    function nextSlide() {
        index = (index + 1) % 3;
        showSlide(index);
    }

    showSlide(0);
    setInterval(nextSlide, 3000);

});
</script>
@endpush