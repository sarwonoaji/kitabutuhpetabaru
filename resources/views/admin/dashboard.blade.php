@extends('layout.admin')

@section('content')


<!DOCTYPE html>
<html lang="en">
  <head>
    <title>DASHBOARD</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" />
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet" />
   <script src="https://code.jquery.com/jquery-3.4.0.min.js" integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style2.css') }}" />
    <style>
      .loading{
        margin :0;
        position:absolute;
        top:50%;
        left:50%;
        margin-right:-50%;
        transform:translate(-50%,-50%);
      }
    </style>
  </head>
  <body  style="background-color: gainsboro;">
  <div align="center" class="loading">
      <div class="row">
      </div>
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

  <div style="display:none;"  class="utama">
 
    <div class="container-fluid"></div>

    <h2 style="text-align:center; padding-top:20px; font-family: verdana; font-size:2rem; background-color:#ffffff; padding:16px;">Halaman Dashboard</h2>
    <hr>
    <div class=" row-cols-1 row-cols-md-3 g-4" style="display: grid; grid-template-columns: repeat(4,1fr);">
        <div class="col">
          <div class="card h-100" style="width: 18rem; padding: 10px 10px 10px 10px; margin-left:10px; margin-right:10px; background-color: brown;">
            <img src="{{ asset('dashboard/penting1.png') }}" class="card-img-top" alt="...">
            <div class="card-body">
              <a style="text-align: center; font-family: poppins; font-size: 14px" href="{{ route('penduduk') }}" class="btn btn-light">Peta Kependudukan Desa</a>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card h-100" style="width: 18rem; padding: 10px 10px 10px 10px; margin-left:10px; margin-right:10px; background-color: blue;">
            <img src="{{ asset('dashboard/1.png') }}" class="card-img-top" alt="...">
            <div class="card-body">
              <a style="text-align: center; font-family: poppins; font-size: 14px" href="{{ route('aset.index') }}" class="btn btn-light">Peta Aset Desa</a>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card h-100" style="width: 18rem; padding: 10px 10px 10px 10px; margin-left:10px; margin-right:10px; background-color: goldenrod;">
            <img src="{{ asset('dashboard/2.png') }}" class="card-img-top" alt="...">
            <div class="card-body">
              <a style="text-align: center; font-family: poppins; font-size: 14px" href="{{ route('umkm.index') }}" class="btn btn-light">Peta UMKM</a>
            </div>
          </div>
        </div>
        <div class="col">
            <div class="card h-100" style="width: 18rem; padding: 10px 10px 10px 10px; margin-left:10px; margin-right:10px; background-color: yellowgreen;">
              <img src="{{ asset('dashboard/5.png') }}" class="card-img-top" alt="...">
              <div class="card-body">
                <a style="text-align: center; font-family: poppins; font-size: 14px" class="btn btn-light" href="{{ route('grafik') }}">Buku Tamu</a>
              </div>
            </div>
          </div>
      </div>

      <h2 style="text-align:center; padding-top:30px;"></h2>
      <div class=" row-cols-1 row-cols-md-3 g-4" style="display: grid; grid-template-columns: repeat(4,1fr);">
        <div class="col">
            <div class="card h-100" style="width: 18rem; padding: 10px 10px 10px 10px; margin-left:10px; margin-right:10px; background-color: blueviolet;">
              <img src="{{ asset('dashboard/3.png') }}" class="card-img-top" alt="...">
              <div class="card-body">
                <a style="text-align: center; font-family: poppins; font-size: 14px" href="{{ route('ternaktani.index') }}" class="btn btn-light">Peta Ternak Tani</a>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card h-100" style="width: 18rem; padding: 10px 10px 10px 10px; margin-left:10px; margin-right:10px; background-color: greenyellow;">
              <img src="{{ asset('dashboard/4.png') }}" class="card-img-top" alt="...">
              <div class="card-body">
                <a style="text-align: center; font-family: poppins; font-size: 14px" href="{{ route('industri.index') }}" class="btn btn-light">Peta Industri</a>
              </div>
            </div>
          </div>
           <div class="col">
            <div class="card h-100" style="width: 18rem; padding: 10px 10px 10px 10px; margin-left:10px; margin-right:10px; background-color: brown;">
              <img src="{{ asset('dashboard/pink2.png') }}" class="card-img-top" alt="...">
              <div class="card-body">
                <a style="text-align: center; font-family: poppins; font-size: 14px" href="{{ route('industri.index') }}" class="btn btn-light">Masukkan</a>
              </div>
            </div>
          </div>
              </div>
            </div>


    </div>
    <br>
    <footer style="background-color: #a099ff; padding-bottom: 10px; display:none">
      <div class="align-items-center">
        <p></p>
        <p style="font-family: fangsong; text-align: center; padding-top: 30px; font-size: 17px">Kita Butuh Peta</p>
      </div>
    </footer>
  </div>
  </body>
  <script>
    $(document).ready(function (){
      // console.log("oke")
        $(".loading").fadeOut(3000,function(){
          // console.log("oke");
          $(".utama").fadeIn(1000);
          $("footer").fadeIn(1000);
        });
    })
  </script>
</html>

@endsection