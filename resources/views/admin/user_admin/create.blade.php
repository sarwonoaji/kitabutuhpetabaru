@extends('layout.admin')

@section('content')
<!-- Header -->
<div style="background-color:#a099ff;" class="text-white py-8 p-4 flex items-center justify-center">
    <a href="{{ url('/') }}" class="mr-3 text-xl"></a>
    <h1 class="text-2xl font-semibold text-center">Tambah User</h1>
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

            <form action="{{ route('useradmin.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                    <div>
                        <label class="mb-2 block text-sm font-medium text-slate-700">Username</label>
                        <input type="text" name="username" value="{{ old('username') }}" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-100" required>
                    </div>
                    <div>
                        <label class="mb-2 block text-sm font-medium text-slate-700">Password</label>
                        <input type="password" name="password" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-100" required>
                    </div>
                    <div>
                        <label class="mb-2 block text-sm font-medium text-slate-700">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-100" required>
                    </div>
                <div class="flex flex-col gap-3 sm:flex-row sm:justify-end">
                   <button type="submit" class="inline-flex items-center justify-center rounded-2xl bg-blue-600 px-6 py-3 text-sm font-semibold text-white shadow-sm shadow-blue-500/10 transition hover:bg-blue-700">Kirim</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection