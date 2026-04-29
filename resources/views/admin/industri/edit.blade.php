@extends('layout.admin')

@section('title', 'Ubah Data Peta Industri')
@section('content')
<div class="h-10">
    <h4 class="text-2xl text-slate-900 text-center">
        Ubah Data Pada Peta Industri
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

            <form action="{{ route('industri.update', $industri->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')
                    <div>
                        <label class="mb-2 block text-sm font-medium text-slate-700">Nama Industri</label>
                        <input type="text" name="nama" value="{{ old('nama', $industri->nama) }}" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-100" required>
                    </div>
                    <div>
                        <label class="mb-2 block text-sm font-medium text-slate-700">Keterangan</label>
                        <input type="text" name="deskripsi" value="{{ old('deskripsi', $industri->deskripsi) }}" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-100" required>    
                    </div>
                    <div>
                        <label class="mb-2 block text-sm font-medium text-slate-700">Jumlah</label>
                        <input type="text" name="jumlah" value="{{ old('jumlah', $industri->jumlah) }}" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-100" required>
                    </div>
                    <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">Foto (Maksimal 1 MB)</label>
                    <input type="file" name="foto" class="block w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-100">
                    @if($industri->foto)
                        <div class="mt-3 flex items-center gap-4 rounded-2xl border border-slate-200 bg-slate-50 p-4">
                            <img src="{{ asset('img/industri/'.$industri->foto) }}" alt="Foto Industri" class="h-20 w-20 rounded-xl object-cover">
                            <div class="text-sm text-slate-600">Foto saat ini. Biarkan kosong jika tidak ingin mengganti.</div>
                        </div>
                    @endif
                </div>
                    <div>
                        <label class="mb-2 block text-sm font-medium text-slate-700">Latitude</label>
                        <input type="text" name="latitude" value="{{ old('latitude', $industri->latitude) }}" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-100" required>
                    </div>
                    <div>
                        <label class="mb-2 block text-sm font-medium text-slate-700">Longitude</label>
                        <input type="text" name="longitude" value="{{ old('longitude', $industri->longitude) }}" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-100" required>
                    </div>
                <div class="flex flex-col gap-3 sm:flex-row sm:justify-end">
                    <button href="{{ route('industri.index') }}" class="inline-flex items-center justify-center rounded-2xl border border-slate-300 bg-white px-6 py-3 text-sm font-medium text-slate-700 transition hover:bg-slate-50">Kembali</button>
                    <button type="submit" class="inline-flex items-center justify-center rounded-2xl bg-blue-600 px-6 py-3 text-sm font-semibold text-white shadow-sm shadow-blue-500/10 transition hover:bg-blue-700">Ubah Data</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection