<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Foto;
use Illuminate\Support\Facades\Storage;

class fotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       /* $test = 'hola variable';
      return view('fotos',compact('test'));*/
      return view('fotos');
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
        $path = $request->file('files')->store('public'); // primero el nombre del archivo (se genera automanticamente cuando se guarda) y luego la carpeta
    $nombre = $request->file('files')->hashName(); //el nombre en hash que se guarda
    //$url = url($request->file('files')->hashName()); //otra forma de conseguir la url
    $url = url(Storage::url($nombre));
    $bbcode = '[img='.$url.']';
    //$url =  asset('storage/'.$nombre); // otra forma (?

    $foto = new Foto;
    $foto->url = $url;
    $foto->bbcode = $bbcode;
    $foto->favorito = false; //nueva columna
    $foto->user_id = auth()->user()->id;
    $foto->save();

    
    /*$path = $request->file('file')->storeAs(
    'files', $request->user()->id .'.gif' // dando un nombre al archivo
);*/



    //return response()->json('');
    return $foto;
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        /*$foto = Foto::find($id);
        $foto->created_at = $request->input('created_at');
        $foto->save();
        return $foto;*/
        // return $request->all();
          Foto::findOrFail($id)->update($request->all());
       /*$foto = Foto::find($id);
       return $foto;*/
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Foto::destroy($id);
       $foto= Foto::find($id);
       $foto->delete();
       return 'eliminado';
       //return dd($id);
    }
}
