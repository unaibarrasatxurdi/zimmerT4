@extends('layouts.base')

@section('content')
<div>
    <div id="home-header">
        <div class="text-center">
            <h1 class="mb-4">Bienvenido a Zimmer!</h1>
            <div class="container d-flex gap-3 w-50">
                <input type="text" class="form-control" placeholder="Buscar hoteles en euskadi">
                <button class="btn btn-primary">Buscar</button>
            </div>
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
            <a href="/hoteles?destination=bilbao">
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
</div>
@endsection