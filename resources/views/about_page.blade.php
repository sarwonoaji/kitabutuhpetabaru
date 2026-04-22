@extends('layout.apps')

@section('content')

<div style="background-color:#a099ff;" class="text-white py-8 p-4 flex items-center justify-center">
    <a href="{{ url('/') }}" class="mr-3 text-xl"></a>
    <h1 class="text-lg font-semibold text-center">Tentang</h1>
</div>

<div class="container py-4">

    <!-- HEADER -->
    <!-- <div class="bg-purple-500 text-white p-4 rounded-xl shadow mb-4">
        <h1 class="text-center text-lg font-semibold">Tentang</h1>
    </div> -->

    <!-- CARD -->
    <div class="bg-white rounded-xl shadow overflow-hidden">

        <!-- HEADER CARD -->
        <div class="p-4 text-center border-b">
            <img src="{{ asset('Kitabutuhpeta.png') }}" alt="logo"
                 class="w-20 mx-auto mb-2">

            <h5 class="font-semibold text-sm">
                Desa Butuh, Boyolali
            </h5>
        </div>

        <!-- BODY -->
        <div class="p-4 text-sm space-y-3 text-gray-700 text-center">

            <p>
                Aplikasi Kita Butuh Peta mendukung pelibatan masyarakat dalam pemetaan sosial.
            </p>

            <p>
                🌐
                <a href="https://pemdesbutuh.id" target="_blank"
                   class="text-blue-600 font-semibold">
                    pemdesbutuh.id
                </a>
            </p>

            <p>
                📷
                <a href="https://www.instagram.com/pemdesbutuh/" target="_blank"
                   class="text-blue-600 font-semibold">
                    @pemdesbutuh
                </a>
            </p>

            <p>
                📧
                <a href="mailto:pemdesbutuhmojo9@gmail.com"
                   class="text-blue-600 font-semibold">
                    pemdesbutuhmojo9@gmail.com
                </a>
            </p>

            <p>
                Dibuat oleh Mahasiswa D3 Teknik Telekomunikasi Politeknik Negeri Semarang.
            </p>

        </div>

        <!-- FOOTER -->
        <div class="bg-gray-100 text-center text-xs py-2 text-gray-500">
            KitaButuhPeta
        </div>

    </div>

    <!-- BUTTON BACK -->
    <div class="mt-4">
    <a href="{{ url('/') }}"
       style="background-color:#a099ff;"
       class="inline-block text-white px-4 py-2 rounded-lg text-sm shadow hover:opacity-90 transition">
        Tutup
    </a>
</div>

</div>

@endsection