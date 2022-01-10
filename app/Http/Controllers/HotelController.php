<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HotelController extends Controller {
    
    function index() {
        return view('hoteles.show');
    }

    function show() {
        return view('hoteles.show');
    }

}
