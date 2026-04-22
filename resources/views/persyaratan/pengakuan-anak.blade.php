@extends('layout.apps')

@section('content')

<!-- HEADER -->
<div class="bg-purple-500 text-white p-4 text-center">
    <h1 class="text-lg font-bold">Pencatatan Akta</h1>
    <h2 class="text-sm">Pengakuan Anak</h2>
</div>

<!-- CONTENT -->
<div class="flex justify-center p-4 bg-gray-100 min-h-screen">

    <div class="bg-white rounded-xl shadow-md p-4 w-full max-w-sm">

        <!-- IMAGE -->
        <img src="{{ asset('img/persyaratan/12.jpg') }}" 
             class="w-full rounded-lg mb-4"
             alt="Persyaratan Pengakuan Anak">
    </div>

</div>

@endsection