@extends('layout.apps')

@section('title', 'Peta Ternak Tani')
@section('content')

<!-- Header -->
<div style="background-color:#a099ff;" class="text-white py-8 p-4 flex items-center justify-center">
    <a href="{{ url('/') }}" class="mr-3 text-xl"></a>
    <h1 class="text-lg font-semibold text-center">Peta Ternak Tani</h1>
</div>

<!-- Search -->
<div class="p-4 bg-white shadow">
    <form method="GET">
        <div class="flex gap-2">
            <input 
                type="text" 
                name="keyword" 
                value="{{ request('keyword') }}"
                placeholder="Cari ternak..." 
                class="w-full p-3 rounded-xl border">

            <button class="bg-blue-500 text-white px-4 rounded-xl">
                Cari
            </button>
        </div>
    </form>
</div>

<!-- Map -->
<div class="p-4 bg-gray-100">
    <div id="map" style="height:400px;" class="w-full rounded-xl"></div>
</div>

<!-- Leaflet -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css"/>
<script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    // INIT MAP
    let map = L.map('map').setView([-7.553486, 110.632467], 15); //hardcode lokasi

    // TILE MAP
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
    }).addTo(map);

    // DATA LARAVEL
    let ternaktani = @json($ternaktani);
    console.log("DATA ASET:", ternaktani);

    // ICON MARKER
    let iconAset = L.icon({
        iconUrl: "{{ asset('aset.png') }}",
        iconSize: [35, 35]
    });

    let markers = [];

    // LOOP DATA
    ternaktani.forEach(function(d){

        if(d.latitude && d.longitude){

            let marker = L.marker([d.latitude, d.longitude], {
                icon: iconAset
            }).addTo(map);

            // POPUP + BUTTON RUTE
            marker.bindPopup(`
                <p>
                <i class="fas fa-tags"></i>
                <b>Nama</b> : ${d.nama}
                </p>
                <p>
                <i class="far fa-file-alt"></i>
                <b>Deskripsi</b> : ${d.deskripsi}
                </p>
                <p>
                <i class="fas fa-chart-line"></i>
                <b>Jumlah</b> : ${d.jumlah}
                </p>
                <p>
                <i class="fas fa-wallet"></i>
                <b>Harga</b> : ${d.harga}
                </p>
                    ${d.foto ? `<img src="/img/ternak-tani/${d.foto}" width="200" style="margin-top:5px;border-radius:8px;">` : ''}

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
                        📍 Rute ke Lokasi
                    </a>
                </div>
            `);

            markers.push(marker);
        }

    });

    // AUTO ZOOM
    if(markers.length > 0){
        let group = L.featureGroup(markers);
        map.fitBounds(group.getBounds());
    }

});
</script>

@endsection