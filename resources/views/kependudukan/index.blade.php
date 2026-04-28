@extends('layout.apps')

@section('title', 'Kita Butuh Peta')

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" />
<script src="https://code.iconify.design/iconify-icon/1.0.0/iconify-icon.min.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;400&family=Poppins:ital,wght@0,300;1,400&display=swap" rel="stylesheet"/>
<script src="https://kit.fontawesome.com/a81368914c.js"></script>
<style>
body {
    background-image: url(/abc2.jpg);
}
</style>
@endpush

@section('content')

<!-- HEADER -->
<div class="text-center py-4">
    <h1 class="kependudukan-title">Peta</h1>
    <h2 class="kependudukan-subtitle">Kependudukan Per-RT/RW</h2>
</div>

<!-- MAIN MENU -->
<div class="d-flex justify-content-center">
    <div class="sh-box mt-3" style="width: 100%; max-width: 800px;">
        <div class="row m-2">
            @foreach($menuItems as $item)
                <div class="col-4 d-flex justify-content-center">
                    <div>
                        <a href="{{ route('penduduk.show', $item['id']) }}" 
                                    id="{{ $item['id'] }}" 
                                    class="d-flex flex-column align-items-center menu-item">
                            <img class="icon-menu" src="{{ asset('icon/' . $item['icon']) }}" alt="{{ $item['name'] }}" loading="lazy" />
                            <p class="text-gray font-10" style="height: 35px; font-size: 12px; text-align: center;">{{ $item['name'] }}</p>
                        </a>
                    </div>
                </div>

                {{-- Add row break after every 8 items (end of RW1) and after 16 items (end of RW2) --}}
                @if($loop->iteration == 8 || $loop->iteration == 16)
                    </div>
                    <div class="row m-2">
                @endif
            @endforeach
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
@endpush
