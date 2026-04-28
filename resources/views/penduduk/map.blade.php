@extends('layout.apps')

@section('title', 'Peta Ekonomi')

@section('content')



<div style="background-color:#a099ff;" class="text-white py-8 p-4 flex items-center justify-center">
    <a href="{{ url('/') }}" class="mr-3 text-xl"></a>
    <h1 class="text-xl font-semibold text-center">Peta Penduduk {{ $label }}</h1>
</div>

<!-- SEARCH -->
<div class="p-4 bg-white shadow">
    <form method="GET">
        <div class="flex gap-2">
            <input 
                type="text" 
                name="keyword" 
                value="{{ $keyword }}"
                placeholder="Cari nama / keterangan..." 
                class="w-full p-3 rounded-xl border">

            <button class="bg-blue-500 text-white px-4 rounded-xl">
                Cari
            </button>
        </div>
    </form>
</div>

<!-- MAP -->
<div class="p-4 bg-gray-100">
    <div id="map" style="height:400px;" class="w-full rounded-xl"></div>
</div>

<!-- LEAFLET -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css"/>
<script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    let data = @json($penduduk);

    // DEFAULT VIEW (fallback)
    let map = L.map('map').setView([-7.55, 110.63], 13);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
    }).addTo(map);

    let iconPenduduk = L.icon({
        iconUrl: "{{ asset('industri.png') }}",
        iconSize: [35, 35]
    });

    let markers = [];

    data.forEach(function(d){

        if(d.latitude && d.longitude){

            let marker = L.marker([d.latitude, d.longitude], {
                icon: iconPenduduk
            }).addTo(map);

            marker.bindPopup(`
                    <p>
                    <i class="fas fa-user"></i>
                    <b>Nama Kepala Keluarga</b> : ${d.nama}
                    </p>
                    <p>
                    <i class="fas fa-home"></i>
                    <b>Keterangan</b> : ${d.keterangan}
                    </p>

                    ${d.foto ? `<img src="/img/${d.foto}" width="200" style="margin-top:5px;border-radius:8px;">` : ''}

                    <br><br>

                    <a href="https://www.google.com/maps/dir/?api=1&destination=${d.latitude},${d.longitude}"
                       target="_blank"
                       style="padding:6px 10px;background:#2563eb;color:white;border-radius:6px;text-decoration:none;">
                        📍 Rute
                    </a>
                </div>
            `);

            markers.push(marker);
        }
    });

    // AUTO ZOOM KE MARKER
    if(markers.length > 0){
        let group = L.featureGroup(markers);
        map.fitBounds(group.getBounds());
    }

});
</script>

@endsection