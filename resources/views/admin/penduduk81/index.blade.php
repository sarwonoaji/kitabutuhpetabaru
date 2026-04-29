@extends('layout.admin')

@section('title', 'RT 8 / RW 1')
@section('content')
<div class="h-10">
    <h4 class="text-2xl text-slate-900 text-center">
        Peta Kependudukan RT 8 / RW 1
    </h4>
</div>
<div class="min-h-screen bg-slate-100 py-10">
    <div class="mx-auto w-full max-w-6xl px-4 sm:px-6 lg:px-8">
        <div class="rounded-3xl bg-white p-8 shadow-xl ring-1 ring-slate-200">
            <div class="mb-8 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <a href="{{ route('penduduk81.create') }}" class="inline-flex items-center justify-center rounded-2xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white shadow-sm shadow-blue-500/20 transition hover:bg-blue-700">+ Tambah Data</a>
            </div>

            <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <form method="GET" class="w-full sm:w-auto sm:flex sm:gap-2">
                    <label for="keyword" class="sr-only">Cari penduduk81</label>
                    <input id="keyword" type="text" name="keyword" value="{{ request('keyword') }}" placeholder="Cari penduduk81..." class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-100">
                    <button type="submit" class="mt-2 w-full rounded-2xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white transition hover:bg-slate-800 sm:mt-0 sm:w-auto">Search</button>
                </form>
            </div>

            <div class="overflow-x-auto rounded-3xl border border-slate-200">
                <table class="min-w-full divide-y divide-slate-200 bg-white text-left text-sm text-slate-700">
                    <thead class="bg-slate-950 text-slate-100">
                        <tr>
                            <th class="px-4 py-4 font-medium">Nama Kepala Keluarga</th>
                            <th class="px-4 py-4 font-medium">Keterangan</th>
                            <th class="px-4 py-4 font-medium">Latitude</th>
                            <th class="px-4 py-4 font-medium">Longitude</th>
                            <th class="px-4 py-4 font-medium">Foto</th> 
                            <th class="px-4 py-4 font-medium text-center">Editing</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 bg-slate-50">
                        @forelse ($penduduk81 as $row)
                        <tr class="hover:bg-slate-100">
                            <td class="px-4 py-4 align-top">{{ $row->nama }}</td>
                            <td class="px-4 py-4 align-top">{{ $row->keterangan }}</td>
                            <td class="px-4 py-4 align-top">{{ $row->latitude }}</td>
                            <td class="px-4 py-4 align-top">{{ $row->longitude }}</td>
                            <td class="px-4 py-4 align-top">
                                <img src="{{ asset('img/penduduk81/'.$row->foto) }}" alt="Foto Penduduk81" class="h-24 w-24 rounded-2xl object-cover border border-slate-200">
                            </td>
                            <td class="px-4 py-4 align-top text-center">
                                <div class="inline-flex flex-col gap-2 sm:flex-row sm:justify-center">
                                    <a href="{{ route('penduduk81.edit', $row->id) }}" class="rounded-2xl bg-blue-600 px-4 py-2 text-xs font-semibold text-white transition hover:bg-blue-700">Ubah</a>
                                    <form action="{{ route('penduduk81.delete', $row->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data Penduduk81 ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="rounded-2xl bg-rose-600 px-4 py-2 text-xs font-semibold text-white transition hover:bg-rose-700">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr class="bg-white">
                            <td colspan="7" class="px-4 py-8 text-center text-sm text-slate-500">Data Penduduk81 belum tersedia.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-6 flex flex-col items-center gap-3 sm:flex-row sm:justify-between">
                <div class="text-sm text-slate-500">Halaman {{ $penduduk81->currentPage() }} dari {{ $penduduk81->lastPage() }}</div>
                <div>{{ $penduduk81->links() }}</div>
            </div>

            <div id="map" class="mt-8 h-[400px] rounded-3xl border border-slate-200"></div>
        </div>
    </div>
</div>

<!-- LEAFLET -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"></script>

<script id="penduduk81-data" type="application/json">
    {!! json_encode($penduduk81->items(), JSON_THROW_ON_ERROR) !!}
</script>

<script>
const penduduk81 = JSON.parse(document.getElementById('penduduk81-data').textContent || '[]');

const map = L.map("map").setView([-7.553486, 110.632467], 16);

L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png").addTo(map);

penduduk81.forEach(d => {
    L.marker([d.latitude, d.longitude]).addTo(map)
        .bindPopup(`
        <p>
        <i class="fas fa-user"></i>
        <b>Nama Kepala Keluarga</b> : ${d.nama}
        </p>
        <p>
        <i class="fas fa-home"></i>
        <b>Keterangan</b> : ${d.keterangan}
        </p>
        <p>
        ${d.foto ? `<img src="/img/penduduk81/${d.foto}" width="300" style="margin-top:5px;border-radius:8px;">` : ''}
        </p>
        <br><br>
            <a href="https://www.google.com/maps/dir/?api=1&destination=${d.latitude},${d.longitude}"
                target="_blank"
                style="
                    display:inline-block;
                    padding:8px 12px;
                    background:#2563eb;
                    color:white;
                    border-radius:8px;
                    text-decoration:none;
                    font-size:12px;
                    margin-top:8px;
                ">
                Rute
            </a>
        `);
});
</script>

@endsection