@extends('layouts.app')

@section('content')

<!-- HEADER -->
<div class="bg-purple-500 text-white p-4 text-center">
    <h1 class="text-lg font-bold">Persyaratan Penerbitan</h1>
    <h2 class="text-sm">Pengangkatan Anak</h2>
</div>

<!-- CONTENT -->
<div class="flex justify-center p-4 bg-gray-100 min-h-screen">

    <div class="bg-white rounded-xl shadow-md p-4 w-full max-w-sm">

        <!-- IMAGE -->
        <img src="{{ asset('img/persyaratan/14.jpg') }}" 
             class="w-full rounded-lg mb-4"
             alt="Persyaratan Pengangkatan Anak">

        <!-- OPTIONAL TEXT -->
        <p class="text-sm text-gray-600 text-center">
            Silakan lengkapi persyaratan sesuai gambar di atas.
        </p>

        <!-- BUTTON KEMBALI -->
        <div class="mt-5 text-center">
            <a href="{{ route('persyaratan') }}"
               class="bg-purple-500 text-white px-4 py-2 rounded-lg">
               ⬅️ Kembali
            </a>
        </div>

    </div>

</div>

@endsection