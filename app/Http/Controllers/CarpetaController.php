<?php

namespace App\Http\Controllers;

use App\Carpeta;
use Illuminate\Http\Request;

class CarpetaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('carpetas');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nombre = $request->input('nombre');
        $user = auth()->user()->id;
        $carpeta = new Carpeta;
        $carpeta->nombre = $nombre;
        $carpeta->user_id = $user;
        $carpeta->save();

        return $carpeta;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Carpeta  $carpeta
     * @return \Illuminate\Http\Response
     */
    public function show(Carpeta $carpeta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Carpeta  $carpeta
     * @return \Illuminate\Http\Response
     */
    public function edit(Carpeta $carpeta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Carpeta  $carpeta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $carpeta = Carpeta::find($id);
        $nombre = $request->input('nombre');
        $carpeta->nombre = $nombre;
        $carpeta->save();
        return $carpeta;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Carpeta  $carpeta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $carpeta = Carpeta::find($id);
        $carpeta->delete();
        return 'eliminado';
    }
}
