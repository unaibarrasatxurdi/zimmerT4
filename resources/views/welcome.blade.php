@extends('layouts.app')

@section('content')

<div>

    <div id="home-header">
        <div class="text-center">
            <h1>Bienvenido a Zimmer!</h1>
        </div>
    </div>

    <div class="destinations container d-flex justify-content-around flex-wrap my-5">
        <div>
            <span class="d-block fw-bold">Gasteiz</span>
            <a href="/hoteles?destination=gasteiz">
                <img src="img/gasteiz.jpg" width="300px" class="shadow-sm">
            </a>
        </div>
        <div>
            <span class="d-block fw-bold">Bilbo</span>
            <a href="/hoteles?territory=Bizkaia">
                <img src="img/bilbo.jpg" width="300px" class="shadow-sm">
            </a>
        </div>
        <div>
            <span class="d-block fw-bold">Donosti / San Sebastian</span>
            <a href="/hoteles?destination=donosti">
                <img src="img/donosti.jpg" width="300px" class="shadow-sm">
            </a>
        </div>
    </div>

    <hr></hr>

    <div class="motak container d-flex justify-content-around flex-wrap my-5" id="motak">
        <div>
            <span class="d-block fw-bold">Hotel</span>
            <a href="#">
                <img src="img/hotel.jpg" width="300px" class="shadow-sm">
            </a>
        </div>
        <div>
            <span class="d-block fw-bold">Apartamento</span>
            <a href="#">
                <img src="img/APARTAMENTO.jpg" width="300px" class="shadow-sm">
            </a>
        </div>
        <div>
            <span class="d-block fw-bold">Apartahotel</span>
            <a href="#">
                <img src="img/apartahotel.jpg" width="300px" class="shadow-sm">
            </a>
        </div>
        <div>
            <span class="d-block fw-bold">Pension</span>
            <a href="#">
                <img src="img/pennsion.jpg" width="300px" class="shadow-sm">
            </a>
        </div>
    </div>

</div>

@endsection
