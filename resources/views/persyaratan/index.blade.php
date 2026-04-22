@extends('layout.apps')

@section('content')

<div class="p-4">

    <!-- HEADER -->
    <div class="bg-purple-400 text-white p-4 rounded-xl text-center mb-4 shadow">
        <h1 class="text-base md:text-lg font-bold">Informasi Pelayanan</h1>
        <p class="text-xs md:text-sm">Administrasi Kependudukan</p>
    </div>

    <!-- BOX -->
    <div class="bg-white rounded-xl shadow p-4 max-w-md mx-auto">

        <div class="flex flex-col gap-3">

            <a href="{{ route('persyaratan.kk') }}" class="bg-green-500 text-white text-center py-2 rounded-lg">Persyaratan Penerbitan KK</a>

            <a href="{{ route('persyaratan.ktp') }}" class="bg-yellow-500 text-white text-center py-2 rounded-lg">Persyaratan Penerbitan KTP</a>

            <a href="{{ route('persyaratan.pindah-datang') }}" class="bg-green-500 text-white text-center py-2 rounded-lg">Persyaratan Pindah Datang</a>

            <a href="{{ route('persyaratan.pindah-keluar') }}" class="bg-red-500 text-white text-center py-2 rounded-lg">Persyaratan Pindah Keluar</a>

            <a href="{{ route('persyaratan.kia') }}" class="bg-yellow-500 text-black text-center py-2 rounded-lg">Persyaratan Penerbitan KIA</a>

            <a href="{{ route('persyaratan.kts') }}" class="bg-cyan-500 text-white text-center py-2 rounded-lg">Kartu Tinggal Sementara</a>

            <a href="{{ route('persyaratan.akta-kelahiran') }}" class="bg-green-600 text-white text-center py-2 rounded-lg">Akta Kelahiran</a>

            <a href="{{ route('persyaratan.pencatatan-perkawinan') }}" class="bg-blue-500 text-white text-center py-2 rounded-lg">Pencatatan Perkawinan</a>

            <a href="{{ route('persyaratan.akta-kematian') }}" class="bg-gray-500 text-white text-center py-2 rounded-lg">Akta Kematian</a>

            <a href="{{ route('persyaratan.perceraian') }}" class="bg-green-700 text-white text-center py-2 rounded-lg">Perceraian</a>

            <a href="{{ route('persyaratan.perubahan-nama') }}" class="bg-red-600 text-white text-center py-2 rounded-lg">Perubahan Nama</a>

            <a href="{{ route('persyaratan.pengakuan-anak') }}" class="bg-yellow-400 text-black text-center py-2 rounded-lg">Pengakuan Anak</a>

            <a href="{{ route('persyaratan.pengesahan-anak') }}" class="bg-cyan-600 text-white text-center py-2 rounded-lg">Pengesahan Anak</a>

            <a href="{{ route('persyaratan.pengangkatan-anak') }}" class="bg-yellow-500 text-black text-center py-2 rounded-lg">Pengangkatan Anak</a>

        </div>

    </div>

</div>

@endsection