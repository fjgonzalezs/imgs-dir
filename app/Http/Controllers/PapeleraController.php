<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Foto;
use App\Carpeta;
use App\User;
class PapeleraController extends Controller
{
    public function index()
    {
    	return view('papelera');
    	
    }

    public function mostrarFotos()
    {
    	 $fotos = DB::table('fotos')
            ->join('carpetas', 'fotos.carpeta_id', '=', 'carpetas.id')
            ->join('users', 'carpetas.user_id', '=', 'users.id')
            ->where('users.id',auth()->user()->id)
             ->whereNotNull('fotos.deleted_at')
            ->select('fotos.*')
            ->orderBy('fotos.id', 'desc')
            ->get();

            return $fotos;
    }
    public function mostrarCarpetas()
    {
    	// return User::find(auth()->user()->id)->carpetas()->orderBy('id', 'desc')->get();
    	 $carpetas = User::find(auth()->user()->id)
    		    ->carpetas()
    		    ->onlyTrashed()
    		    ->orderBy('id', 'desc')
                ->get();
        return $carpetas;
    }
    public function restaurarFotos(Request $request)
    {
    	$id = $request->input('id');
    	//return dd($id);
    	$foto = Foto::withTrashed()
        ->where('id', $id)
        ->restore();
    	
    	return 'restaurado';
    }

    public function restaurarCarpetas(Request $request)
    {
    	$id = $request->input('id');
    	//return dd($id);
    	$carpeta = Carpeta::withTrashed()
        ->where('id', $id)
        ->restore();
    	
    	return 'restaurado';
    }
}
