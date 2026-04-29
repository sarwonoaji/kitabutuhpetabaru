@extends('layout.admin')

@section('title', 'Tentang')
@section('content')

<div class="h-10">
    <h4 class="text-xl text-slate-900 text-center">
        Tentang Kita Butuh Peta
    </h4>
</div>
<div class="container py-4">

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
        </div>

      
    </div>
      
    <br>
        <footer style="background-color: #a099ff; padding-bottom: 10px; display:block">
      <div class="align-items-center">
        <p></p>
        <p style="font-family: fangsong; text-align: center; padding-top: 30px; font-size: 17px">Kita Butuh Peta</p>
      </div>
    </footer>
</div>



@endsection