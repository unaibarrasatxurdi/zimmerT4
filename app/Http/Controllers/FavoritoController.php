<?php

namespace App\Http\Controllers;

use Response;
use Illuminate\Http\Request;

use App\Models\Favorito;


class FavoritoController extends Controller {
    
    function create(Request $request) {
        if ($request->filled("hotel_id") && $request->filled("user_id")) {
            $fav = new Favorito;
            $fav->hotel_id = $request->hotel_id;
            $fav->user_id = $request->user_id;
            $fav->save();
            return response()->json(array('msg'=> "OK"), 200);
        } else {
            return response()->json(array('msg'=> "Failed"), 500);
        }
    }

    function delete(Request $request) {
        if ($request->filled("hotel_id") && $request->filled("user_id")) {
            Favorito::where("hotel_id", "LIKE", $request->hotel_id)->where("user_id", "LIKE", $request->user_id)->delete();
            return response()->json(array('msg'=> "OK"), 200);
        } else {
            return response()->json(array('msg'=> "Failed"), 500);
        }
    }

}
