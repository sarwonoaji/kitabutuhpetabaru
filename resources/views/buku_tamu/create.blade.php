@extends('layout.apps')

@section('title', 'Tambah Data Pada Buku Tamu')
@section('content')
<div style="background-color:#a099ff;" class="text-black py-8 p-4 flex items-center justify-center">
    <a href="{{ url('/') }}" class="mr-3 text-xl"></a>
    <h1 class="text-2xl font-semibold text-center">Tambah Data Pada Buku Tamu</h1>
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

            <form action="{{ route('bKtamu.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                    <!-- Nama -->
                    <div>
                        <label class="mb-2 block text-sm font-medium text-slate-700">Nama</label>
                        <input type="text" name="nama" value="{{ old('nama') }}" placeholder="Masukkan Nama Anda" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-100" required>
                    </div>

                    <!-- Jenis Kelamin -->
                    <div>
                        <label class="mb-3 block text-sm font-medium text-slate-700">Jenis Kelamin</label>
                        <div class="flex gap-6">
                            <div class="flex items-center">
                                <input type="radio" id="laki_laki" name="jenis_kelamin" value="Laki-Laki" {{ old('jenis_kelamin') == 'Laki-Laki' ? 'checked' : '' }} class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-2 focus:ring-blue-500" required>
                                <label for="laki_laki" class="ml-2 text-sm text-slate-700">Laki-Laki</label>
                            </div>
                            <div class="flex items-center">
                                <input type="radio" id="perempuan" name="jenis_kelamin" value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'checked' : '' }} class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-2 focus:ring-blue-500" required>
                                <label for="perempuan" class="ml-2 text-sm text-slate-700">Perempuan</label>
                            </div>
                        </div>
                    </div>

                    <!-- Alamat -->
                    <div>
                        <label class="mb-2 block text-sm font-medium text-slate-700">Alamat</label>
                        <input type="text" name="alamat" value="{{ old('alamat') }}" placeholder="Masukkan Alamat Anda" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-100" required>
                    </div>

                    <!-- Instansi -->
                    <div>
                        <label class="mb-2 block text-sm font-medium text-slate-700">Instansi</label>
                        <input type="text" name="instansi" value="{{ old('instansi') }}" placeholder="Masukkan Nama Instansi" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-100">
                    </div>

                    <!-- Keperluan -->
                    <div>
                        <label class="mb-3 block text-sm font-medium text-slate-700">Keperluan</label>
                        <div class="space-y-3">
                            <div class="flex items-center">
                                <input type="radio" id="surat_umum" name="keperluan" value="Surat Keterangan Umum" {{ old('keperluan') == 'Surat Keterangan Umum' ? 'checked' : '' }} class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-2 focus:ring-blue-500" required>
                                <label for="surat_umum" class="ml-2 text-sm text-slate-700">Surat Keterangan Umum</label>
                            </div>
                            <div class="flex items-center">
                                <input type="radio" id="surat_usaha" name="keperluan" value="Surat Keterangan Usaha" {{ old('keperluan') == 'Surat Keterangan Usaha' ? 'checked' : '' }} class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-2 focus:ring-blue-500">
                                <label for="surat_usaha" class="ml-2 text-sm text-slate-700">Surat Keterangan Usaha</label>
                            </div>
                            <div class="flex items-center">
                                <input type="radio" id="surat_domisili" name="keperluan" value="Surat Keterangan Domisili" {{ old('keperluan') == 'Surat Keterangan Domisili' ? 'checked' : '' }} class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-2 focus:ring-blue-500">
                                <label for="surat_domisili" class="ml-2 text-sm text-slate-700">Surat Keterangan Domisili</label>
                            </div>
                            <div class="flex items-center">
                                <input type="radio" id="surat_pengantar" name="keperluan" value="Surat Pengantar" {{ old('keperluan') == 'Surat Pengantar' ? 'checked' : '' }} class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-2 focus:ring-blue-500">
                                <label for="surat_pengantar" class="ml-2 text-sm text-slate-700">Surat Pengantar</label>
                            </div>
                            <div class="flex items-center">
                                <input type="radio" id="keperluan_lain" name="keperluan" value="Keperluan Lain" {{ old('keperluan') == 'Keperluan Lain' ? 'checked' : '' }} class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-2 focus:ring-blue-500">
                                <label for="keperluan_lain" class="ml-2 text-sm text-slate-700">Keperluan Lain</label>
                            </div>
                        </div>
                    </div>

                    <!-- Nomor HP -->
                    <div>
                        <label class="mb-2 block text-sm font-medium text-slate-700">Nomor HP</label>
                        <input type="text" name="hp_telp" value="{{ old('hp_telp') }}" placeholder="Masukkan Nomor HP Anda" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-100" required>
                    </div>

                <div class="flex flex-col gap-3 sm:flex-row sm:justify-end">
                    <a href="/" class="inline-flex items-center justify-center rounded-full border border-slate-300 bg-white px-4 py-2 text-sm font-medium text-slate-700 shadow-sm transition hover:bg-slate-50">Kembali</a>
                    <button type="submit" class="inline-flex items-center justify-center rounded-2xl bg-blue-600 px-6 py-3 text-sm font-semibold text-white shadow-sm shadow-blue-500/10 transition hover:bg-blue-700">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection