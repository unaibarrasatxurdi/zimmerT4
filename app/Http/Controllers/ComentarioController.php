<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use Illuminate\Http\Request;

class ComentarioController extends Controller {
    
    function create(Request $request) {

        $comentario = new Comentario();
        $comentario->contenido = $request->get("contenido");
        $comentario->hotel_id = $request->get("hotel_id");
        $comentario->user_id = $request->get("user_id");
        $comentario->save();

        return redirect($request->url());

    }

    function delete(Request $request, $comentario_id) {

        $comentario = Comentario::FindOrFail($comentario_id);
        $comentario->delete();

        return redirect("/hoteles/" + $request->get("hotel_id"));

    }
}
