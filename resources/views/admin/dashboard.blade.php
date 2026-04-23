@extends('layout.admin')

@section('content')

<style>
.loading{
    margin:0;
    position:absolute;
    top:50%;
    left:50%;
    transform:translate(-50%,-50%);
}
</style>

<!-- LOADING -->
<div align="center" class="loading">
    <div class="row"></div>
    <div class="row">
        <div class="spinner-grow text-muted"></div>
        <div class="spinner-grow text-primary"></div>
        <div class="spinner-grow text-success"></div>
        <div class="spinner-grow text-info"></div>
        <div class="spinner-grow text-warning"></div>
        <div class="spinner-grow text-danger"></div>
        <div class="spinner-grow text-secondary"></div>
        <div class="spinner-grow text-dark"></div>
        <div class="spinner-grow text-light"></div>
    </div>
</div>

<!-- MAIN -->
<div style="display:none;" class="utama">

    <h2 style="text-align:center; padding-top:20px;">Halaman Dashboard</h2>
    <hr>

    <!-- ROW 1 -->
    <div style="display:grid; grid-template-columns: repeat(4,1fr);">

        <div class="col">
            <div class="card" style="width:18rem; margin:10px; background-color:brown;">
                <img src="{{ asset('dashboard/penting1.png') }}">
                <div class="card-body text-center">
                    <a href="{{ route('kependudukan') }}" class="btn btn-light">
                        Peta Kependudukan Desa
                    </a>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card" style="width:18rem; margin:10px; background-color:blue;">
                <img src="{{ asset('dashboard/1.png') }}">
                <div class="card-body text-center">
                    <a href="{{ route('aset-admin') }}" class="btn btn-light">
                        Peta Aset Desa
                    </a>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card" style="width:18rem; margin:10px; background-color:goldenrod;">
                <img src="{{ asset('dashboard/2.png') }}">
                <div class="card-body text-center">
                    <a href="{{ route('umkm') }}" class="btn btn-light">
                        Peta UMKM
                    </a>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card" style="width:18rem; margin:10px; background-color:yellowgreen;">
                <img src="{{ asset('dashboard/5.png') }}">
                <div class="card-body text-center">
                    <a href="{{ route('grafik') }}" class="btn btn-light">
                        Buku Tamu
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- ROW 2 -->
    <div style="display:grid; grid-template-columns: repeat(4,1fr); margin-top:20px;">

        <div class="col">
            <div class="card" style="width:18rem; margin:10px; background-color:blueviolet;">
                <img src="{{ asset('dashboard/3.png') }}">
                <div class="card-body text-center">
                    <a href="{{ route('ternak') }}" class="btn btn-light">
                        Peta Ternak Tani
                    </a>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card" style="width:18rem; margin:10px; background-color:greenyellow;">
                <img src="{{ asset('dashboard/4.png') }}">
                <div class="card-body text-center">
                    <a href="{{ route('industri') }}" class="btn btn-light">
                        Peta Industri
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- SCRIPT -->
<script src="https://code.jquery.com/jquery-3.4.0.min.js"></script>

<script>
$(document).ready(function (){
    $(".loading").fadeOut(3000,function(){
        $(".utama").fadeIn(1000);
        $("footer").fadeIn(1000);
    });
});
</script>

@endsection