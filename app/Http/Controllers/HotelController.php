<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HotelController extends Controller {

    function index() {
        return view("hotel.index");
    }

    function show($id) {
        $user = Auth::user();
        $comentarios = Comentario::where("hotel_id", "LIKE", $id)->orderBy("created_at", "DESC")->get();
        return view("hotel.show", ["id" => $id, "user" => $user, "comentarios" => $comentarios]);
    }

}
