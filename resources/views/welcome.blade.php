@extends('layout.apps')

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
                ['title'=>'Kependudukan','icon'=>'P','color'=>'bg-blue','route'=>'kependudukan'],
                ['title'=>'Aset Desa','icon'=>'A','color'=>'bg-purple','route'=>'aset'],
                ['title'=>'UMKM','icon'=>'U','color'=>'bg-green','route'=>'umkm'],
                ['title'=>'Ternak & Tani','icon'=>'T','color'=>'bg-yellow','route'=>'ternak'],
                ['title'=>'Industri','icon'=>'I','color'=>'bg-red','route'=>'industri'],
                ['title'=>'Informasi','icon'=>'Info','color'=>'bg-indigo','route'=>'informasi'],
            ];
            @endphp

            @foreach($menus as $menu)
            <a href="{{ route($menu['route']) }}" class="card">
                <div class="card-inner">
                    <div class="icon-circle {{ $menu['color'] }}">
                        <span class="icon-letter">{{ $menu['icon'] }}</span>
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
                ['title'=>'Grafik Tamu','icon'=>'G','color'=>'bg-blue-light','route'=>'grafik'],
                ['title'=>'Administrasi','icon'=>'A','color'=>'bg-green','url'=>'https://pemdesbutuh.id/layanan/login'],
                ['title'=>'Persyaratan','icon'=>'P','color'=>'bg-purple','route'=>'persyaratan'],
                ['title'=>'Masukan','icon'=>'M','color'=>'bg-red','route'=>'masukan'],
            ];
            @endphp

            @foreach($fitur as $item)
            <a href="{{ $item['url'] ?? route($item['route']) }}" class="card">
                <div class="card-inner">
                    <div class="icon-circle {{ $item['color'] }}">
                        <span class="icon-letter">{{ $item['icon'] }}</span>
                    </div>
                    <span class="text-sm font-semibold">{{ $item['title'] }}</span>
                </div>
            </a>
            @endforeach

        </div>
    </div>
</section>

@endsection


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