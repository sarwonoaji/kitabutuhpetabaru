@extends('layout.admin')
@section('title', 'Pembaruan')
@section('content')
<div class="h-10">
    <h4 class="text-2xl text-slate-900 text-center">
        Komentar Pembaruan
    </h4>
</div>
<div class="min-h-screen bg-slate-100 py-10">
    <div class="mx-auto w-full max-w-6xl px-4 sm:px-6 lg:px-8">
        <div class="rounded-3xl bg-white p-8 shadow-xl ring-1 ring-slate-200">
            

            <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <form method="GET" class="w-full sm:w-auto sm:flex sm:gap-2">
                    <label for="keyword" class="sr-only">Cari masukan</label>
                    <input id="keyword" type="text" name="keyword" value="{{ request('keyword') }}" placeholder="Cari masukan..." class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-100">
                    <button type="submit" class="mt-2 w-full rounded-2xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white transition hover:bg-slate-800 sm:mt-0 sm:w-auto">Search</button>
                </form>
            </div>

            <div class="overflow-x-auto rounded-3xl border border-slate-200">
                <table class="min-w-full divide-y divide-slate-200 bg-white text-left text-sm text-slate-700">
                    <thead class="bg-slate-950 text-slate-100">
                        <tr>
                            <th class="px-4 py-4 font-medium">Nama Kepala Keluarga</th>
                            <th class="px-4 py-4 font-medium">Keterangan</th>
                            <th class="px-4 py-4 font-medium">Foto</th> 
                            <th class="px-4 py-4 font-medium text-center">Editing</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 bg-slate-50">
                        @forelse ($masukan as $row)
                        <tr class="hover:bg-slate-100">
                            <td class="px-4 py-4 align-top">{{ $row->nama }}</td>
                            <td class="px-4 py-4 align-top">{{ $row->keterangan }}</td>
                            <td class="px-4 py-4 align-top">
                                <img src="{{ asset('img/masukan/'.$row->foto) }}" alt="Foto Masukan" class="h-24 w-24 rounded-2xl object-cover border border-slate-200">
                            </td>
                            <td class="px-4 py-4 align-top text-center">
                                <div class="inline-flex flex-col gap-2 sm:flex-row sm:justify-center">
                                    <form action="{{ route('masukan.delete', $row->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data Masukan ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="rounded-2xl bg-rose-600 px-4 py-2 text-xs font-semibold text-white transition hover:bg-rose-700">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr class="bg-white">
                            <td colspan="7" class="px-4 py-8 text-center text-sm text-slate-500">Data Masukan belum tersedia.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-6 flex flex-col items-center gap-3 sm:flex-row sm:justify-between">
                <div class="text-sm text-slate-500">Halaman {{ $masukan->currentPage() }} dari {{ $masukan->lastPage() }}</div>
                <div>{{ $masukan->links() }}</div>
            </div>
        </div>
    </div>
</div>



@endsection