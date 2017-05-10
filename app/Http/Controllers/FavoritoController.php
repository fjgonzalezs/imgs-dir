<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class FavoritoController extends Controller
{
    public function index()
    {
        return view('favoritos');
    }
    public function todas()
    {
    	 $fotos = DB::table('fotos')
            ->join('carpetas', 'fotos.carpeta_id', '=', 'carpetas.id')
            ->join('users', 'carpetas.user_id', '=', 'users.id')
            ->where([
            	['users.id',auth()->user()->id],
            	['fotos.favorito', true]
            	])
           // ->where('users.id',auth()->user()->id)
            ->select('fotos.*')
            ->orderBy('fotos.id', 'desc')
            ->get();
            return $fotos;
    }
}
