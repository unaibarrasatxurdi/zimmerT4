@extends('layouts.app')

@section('content')

<div>

    <div id="home-header">
        <div class="text-center">
            <h1>Ongi etorri Zimmer-era!</h1>
        </div>
    </div>

    <div class="destinations container d-flex justify-content-around flex-wrap my-5">
        <div>
            <span class="d-block fw-bold">Araba</span>
            <a href="/hoteles?probintzia=araba">
                <img src="img/gasteiz.jpg" width="300px" class="shadow-sm">
            </a>
        </div>
        <div>
            <span class="d-block fw-bold">Bizkaia</span>
            <a href="/hoteles?probintzia=bizkaia">
                <img src="img/bilbo.jpg" width="300px" class="shadow-sm">
            </a>
        </div>
        <div>
            <span class="d-block fw-bold">Gipuzkoa</span>
            <a href="/hoteles?probintzia=gipuzkoa">
                <img src="img/donosti.jpg" width="300px" class="shadow-sm">
            </a>
        </div>
    </div>

    <hr></hr>

    <div class="motak container d-flex justify-content-around flex-wrap my-5" id="motak">
        <div>
            <span class="d-block fw-bold">Hotel</span>
            <a href="/hoteles?sartutakoOstatzeMota=hoteles">
                <img src="img/hotel.jpg" width="300px" class="shadow-sm">
            </a>
        </div>
        <div>
            <span class="d-block fw-bold">Apartamento</span>
            <a href="/hoteles?sartutakoOstatzeMota=apartamento">
                <img src="img/APARTAMENTO.jpg" width="300px" class="shadow-sm">
            </a>
        </div>
        <div>
            <span class="d-block fw-bold">Apartahotel</span>
            <a href="/hoteles?sartutakoOstatzeMota=hotel-apartamento">
                <img src="img/apartahotel.jpg" width="300px" class="shadow-sm">
            </a>
        </div>
        <div>
            <span class="d-block fw-bold">Pension</span>
            <a href="/hoteles?sartutakoOstatzeMota=pensiones">
                <img src="img/pennsion.jpg" width="300px" class="shadow-sm">
            </a>
        </div>
    </div>

</div>

@endsection
