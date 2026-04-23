@extends('layout.admin')

@section('content')

<h2 class="text-center mt-4">Halaman Aset Desa</h2>
<hr>

<div class="container">

    <!-- BUTTON -->
    <a href="#" class="btn btn-primary mb-3">+ Tambah Data</a>

    <!-- SEARCH -->
    <form method="GET" class="d-flex mb-3" style="max-width:400px;">
        <input type="text" name="keyword" class="form-control" placeholder="Cari..." value="{{ request('keyword') }}">
        <button class="btn btn-outline-primary">Search</button>
    </form>

    <!-- TABLE -->
    <div class="table-responsive">
        <table class="table table-dark table-hover text-center">
            <tr>
                <th>Jenis Aset</th>
                <th>Kegunaan</th>
                <th>Luas</th>
                <th>No Sertifikat</th>
                <th>Foto</th>
                <th>Lat</th>
                <th>Long</th>
                <th>Aksi</th>
            </tr>

            @foreach ($asetdesa as $row)
            <tr>
                <td>{{ $row->nama }}</td>
                <td>{{ $row->kegunaan }}</td>
                <td>{{ $row->luas }}</td>
                <td>{{ $row->no_sertifikat }}</td>
                <td>
                    <img src="{{ asset('admin/'.$row->foto) }}" width="150">
                </td>
                <td>{{ $row->latitude }}</td>
                <td>{{ $row->longitude }}</td>
                <td>
                    <a href="#" class="btn btn-sm btn-primary">Ubah</a>
                    <a href="#" class="btn btn-sm btn-danger">Hapus</a>
                </td>
            </tr>
            @endforeach

        </table>
    </div>

    <!-- PAGINATION -->
    {{ $asetdesa->links() }}

    <!-- MAP -->
    <div id="map" style="width:100%; height:400px;" class="mt-4"></div>

</div>

<!-- LEAFLET -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"></script>

<script>
let asetdesa = @json($asetdesa->items());

var map = L.map("map").setView([-7.553486, 110.632467], 16);

L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png").addTo(map);

asetdesa.map(d => {
    L.marker([d.latitude, d.longitude]).addTo(map)
    .bindPopup(`
        <b>${d.nama}</b><br>
        ${d.kegunaan}<br>
        <img src="/img/${d.foto}" width="200">
    `);
});
</script>

@endsection