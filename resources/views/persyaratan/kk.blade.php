@extends('layout.apps')
@section('title', 'Kartu Keluarga')
@section('content')
<style>
body {
    background-image: url(/abc2.jpg);
}
</style>

<!-- HEADER -->
<div class="text-black p-4 text-center">
    <h1 class="text-xl font-bold">Persyaratan Penerbitan</h1>
    <h2 class="text-lg">Kartu Keluarga</h2>
</div>

<!-- CONTENT -->
<div class="flex justify-center p-4 min-h-screen">
    <div class="bg-white rounded-xl shadow-md p-4 w-full max-w-sm">
        <!-- IMAGE -->
        <img src="{{ asset('img/persyaratan/1.jpg') }}"
             class="w-full rounded-lg mb-4"
             alt="Persyaratan KK">
    </div>
</div>

@endsection