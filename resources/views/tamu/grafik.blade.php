@extends('layout.apps')

@section('content')

<div class="p-3 md:p-6">

    <!-- HEADER -->
    <div class="bg-purple-500 text-white p-4 rounded-xl text-center mb-4 shadow">
        <h1 class="text-base md:text-lg font-bold">Grafik Pelayanan</h1>
        <p class="text-xs md:text-sm opacity-90">Desa Butuh, Boyolali</p>
    </div>

    <!-- CARD CHART -->
    <div class="bg-white p-3 md:p-5 rounded-xl shadow">

        <!-- SCROLL KHUSUS MOBILE -->
        <div class="overflow-x-auto">
            <div id="chart_div" class="w-full h-[300px] md:h-[400px]"></div>
        </div>

    </div>

</div>

<!-- GOOGLE CHART -->
<script src="https://www.gstatic.com/charts/loader.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

        let data = google.visualization.arrayToDataTable([
            ['Jenis Keperluan', 'Jumlah', { role: 'style' }],

            ['Umum', {{ $umum }}, '#8b5cf6'],
            ['Usaha', {{ $usaha }}, '#6b7280'],
            ['Domisili', {{ $domisili }}, '#f59e0b'],
            ['Pengantar', {{ $pengantar }}, '#10b981'],
            ['Lain', {{ $lain }}, '#ef4444'],
        ]);

        let options = {
            height: window.innerWidth < 640 ? 300 : 400,

            legend: { position: "none" },

            chartArea: {
                width: '85%',
                height: '70%'
            },

            hAxis: {
                textStyle: {
                    fontSize: window.innerWidth < 640 ? 10 : 12
                }
            },

            vAxis: {
                minValue: 0,
                textStyle: {
                    fontSize: window.innerWidth < 640 ? 10 : 12
                }
            }
        };

        let chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
        chart.draw(data, options);
    }

    // RESPONSIVE RESIZE
    window.addEventListener('resize', drawChart);

});
</script>

@endsection