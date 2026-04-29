@extends('layout.admin')

@section('title', 'Tambah Data Penduduk RT 2 / RW 2')
@section('content')
<div class="h-10">
    <h4 class="text-2xl text-slate-900 text-center">
        Tambah Data Peta Kependudukan RT 2 / RW 2
    </h4>
</div>
<div class="min-h-screen bg-slate-100 py-10">
    <div class="mx-auto w-full max-w-4xl px-4 sm:px-6 lg:px-8">
        <div class="rounded-3xl bg-white p-8 shadow-xl ring-1 ring-slate-200">
            @if(session('success'))
                <div class="mb-6 rounded-2xl bg-emerald-50 px-5 py-4 text-sm text-emerald-900 ring-1 ring-emerald-200">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="mb-6 rounded-2xl bg-rose-50 px-5 py-4 text-sm text-rose-900 ring-1 ring-rose-200">
                    <ul class="list-inside list-disc space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('penduduk22.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                    <div>
                        <label class="mb-2 block text-sm font-medium text-slate-700">Nama Kepala Keluarga</label>
                        <input type="text" name="nama" value="{{ old('nama') }}" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-100" required>
                    </div>
                    <div>
                        <label class="mb-2 block text-sm font-medium text-slate-700">Keterangan</label>
                        <input type="text" name="keterangan" value="{{ old('keterangan') }}" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-100" required>
                    </div>
                    <div>
                        <label class="mb-2 block text-sm font-medium text-slate-700">Foto (Maksimal 1 MB)</label>
                        <input type="file" name="foto" class="block w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-100">
                    </div>
                    <div>
                        <label class="mb-2 block text-sm font-medium text-slate-700">Latitude</label>
                        <input type="text" name="latitude" value="{{ old('latitude') }}" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-100" required>
                    </div>
                    <div>
                        <label class="mb-2 block text-sm font-medium text-slate-700">Longitude</label>
                        <input type="text" name="longitude" value="{{ old('longitude') }}" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-100" required>
                    </div>
                <div class="flex flex-col gap-3 sm:flex-row sm:justify-end">
                    <a href="{{ route('penduduk22.index') }}" class="inline-flex items-center rounded-full border border-slate-300 bg-white px-4 py-2 text-sm font-medium text-slate-700 shadow-sm transition hover:bg-slate-50">Kembali</a>
                    <button type="submit" class="inline-flex items-center justify-center rounded-2xl bg-blue-600 px-6 py-3 text-sm font-semibold text-white shadow-sm shadow-blue-500/10 transition hover:bg-blue-700">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection