@extends('layout.admin')

@section('content')
<div class="h-10">
    <h4 class="text-2xl text-slate-900 text-center">
        Halaman Aset Desa
    </h4>
</div>
<div class="min-h-screen bg-slate-100 py-10">
    <div class="mx-auto w-full max-w-6xl px-4 sm:px-6 lg:px-8">
        <div class="rounded-3xl bg-white p-8 shadow-xl ring-1 ring-slate-200">
            <div class="mb-8 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <a href="{{ route('aset.create') }}" class="inline-flex items-center justify-center rounded-2xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white shadow-sm shadow-blue-500/20 transition hover:bg-blue-700">+ Tambah Data</a>
            </div>

            <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <form method="GET" class="w-full sm:w-auto sm:flex sm:gap-2">
                    <label for="keyword" class="sr-only">Cari aset</label>
                    <input id="keyword" type="text" name="keyword" value="{{ request('keyword') }}" placeholder="Cari aset..." class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-100">
                    <button type="submit" class="mt-2 w-full rounded-2xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white transition hover:bg-slate-800 sm:mt-0 sm:w-auto">Search</button>
                </form>
            </div>

            <div class="overflow-x-auto rounded-3xl border border-slate-200">
                <table class="min-w-full divide-y divide-slate-200 bg-white text-left text-sm text-slate-700">
                    <thead class="bg-slate-950 text-slate-100">
                        <tr>
                            <th class="px-4 py-4 font-medium">Jenis Aset</th>
                            <th class="px-4 py-4 font-medium">Kegunaan</th>
                            <th class="px-4 py-4 font-medium">Luas</th>
                            <th class="px-4 py-4 font-medium">Nomor Sertifikat</th>
                            <th class="px-4 py-4 font-medium">Foto</th>
                            <th class="px-4 py-4 font-medium">Latitude</th>
                            <th class="px-4 py-4 font-medium">Longitude</th>
                            <th class="px-4 py-4 font-medium text-center">Editing</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 bg-slate-50">
                        @forelse ($asetdesa as $row)
                        <tr class="hover:bg-slate-100">
                            <td class="px-4 py-4 align-top">{{ $row->nama }}</td>
                            <td class="px-4 py-4 align-top">{{ $row->kegunaan }}</td>
                            <td class="px-4 py-4 align-top">{{ $row->luas }}</td>
                            <td class="px-4 py-4 align-top">{{ $row->no_sertifikat }}</td>
                            <td class="px-4 py-4 align-top">
                                <img src="{{ asset('img/aset/'.$row->foto) }}" alt="Foto Aset" class="h-24 w-24 rounded-2xl object-cover border border-slate-200">
                            </td>
                            <td class="px-4 py-4 align-top">{{ $row->latitude }}</td>
                            <td class="px-4 py-4 align-top">{{ $row->longitude }}</td>
                            <td class="px-4 py-4 align-top text-center">
                                <div class="inline-flex flex-col gap-2 sm:flex-row sm:justify-center">
                                    <a href="{{ route('aset.edit', $row->id) }}" class="rounded-2xl bg-blue-600 px-4 py-2 text-xs font-semibold text-white transition hover:bg-blue-700">Ubah</a>
                                    <form action="{{ route('aset.delete', $row->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data aset ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="rounded-2xl bg-rose-600 px-4 py-2 text-xs font-semibold text-white transition hover:bg-rose-700">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr class="bg-white">
                            <td colspan="7" class="px-4 py-8 text-center text-sm text-slate-500">Data aset belum tersedia.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-6 flex flex-col items-center gap-3 sm:flex-row sm:justify-between">
                <div class="text-sm text-slate-500">Halaman {{ $asetdesa->currentPage() }} dari {{ $asetdesa->lastPage() }}</div>
                <div>{{ $asetdesa->links() }}</div>
            </div>

            <div id="map" class="mt-8 h-[400px] rounded-3xl border border-slate-200"></div>
        </div>
    </div>
</div>

<!-- LEAFLET -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"></script>

<script id="aset-data" type="application/json">
    {!! json_encode($asetdesa->items(), JSON_THROW_ON_ERROR) !!}
</script>

<script>
const asetdesa = JSON.parse(document.getElementById('aset-data').textContent || '[]');

const map = L.map("map").setView([-7.553486, 110.632467], 16);

L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png").addTo(map);

asetdesa.forEach(d => {
    L.marker([d.latitude, d.longitude]).addTo(map)
        .bindPopup(`
         <p>
        <i class="fas fa-building"></i>
        <b>Jenis Aset</b> : ${d.nama}
        </p>
        <p>
        <i class="fas fa-edit"></i>
        <b>Kegunaan</b> : ${d.kegunaan}
        </p>
        <p>
        <i class="fas fa-thumbtack"></i>
        <b>Luas</b> : ${d.luas}
        </p>
        <p>
        <i class="fas fa-marker"></i>
        <b>Nomor Sertifikat</b> : ${d.no_sertifikat}
        </p>
        <p>
        ${d.foto ? `<img src="/img/aset/${d.foto}" width="300" style="margin-top:5px;border-radius:8px;">` : ''}
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