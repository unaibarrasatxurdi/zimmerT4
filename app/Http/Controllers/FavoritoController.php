<?php

namespace App\Http\Controllers;

use Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Favorito;


class FavoritoController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function index() {
        $favorito=Auth::user(); /* Gorde $user aldagaian saioa hasi duen erabiltzailea eta bistara bidali */
        return view('gogokoa.index', ['gogoko'=>$favorito]);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    
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
