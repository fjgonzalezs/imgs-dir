<?php

namespace App\Http\Controllers\Carpeta;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\User;
use App\Carpeta;
use App\Foto;
use DB;
use Illuminate\Http\File;
use GuzzleHttp\Client;


class FotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($carpetas)
    {
         $idcarpeta = $carpetas;
         //$nombreCarpeta = Carpeta::find($carpetas)->nombre;
         $eliminado = DB::table('carpetas')->select('deleted_at')->where('id',$carpetas)->first(); //vre como se puede mejorar esto
         $nombreCarpeta = DB::table('carpetas')->select('nombre')->where('id',$carpetas)->first()->nombre;

         //return dd($eliminado->deleted_at);
         if (!is_null($eliminado->deleted_at)) {
              return response('No se puede abrir carpetas eliminadas!!!!', 422);
         }
         else{
           return view('fotos',compact('idcarpeta','nombreCarpeta'));

         }
     
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
    public function store(Request $request, $carpetas)
    {
        $this->validate($request,[
            'files' => 'required|image',
            ]);
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
   // $foto->user_id = auth()->user()->id;
    $foto->carpeta_id = $carpetas;
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
    public function update(Request $request, $carpetaId, $fotoId)
    {
       Foto::find($fotoId)->update($request->all());
       $foto = Foto::find($fotoId);
       return $foto;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($idCarpeta, $idFoto)
    {
       $foto= Foto::find($idFoto);
       $foto->delete();
       return 'eliminado';
    }

    public function todas($carpetas){
        $fotos = DB::table('fotos')
            ->join('carpetas', 'fotos.carpeta_id', '=', 'carpetas.id')
            ->join('users', 'carpetas.user_id', '=', 'users.id')
            ->where('carpetas.id',$carpetas)
             ->whereNull('fotos.deleted_at')
            ->select('fotos.*')
            ->orderBy('fotos.id', 'desc')
            ->get();

            return $fotos;
       // return User::find(auth()->user()->id)->carpetas->fotos->where('carpeta_id',$carpetas);
       /* return Foto::with(['user','carpetas'])->where([
            ['user_id','=', auth()->user()->id ],
            ['carpeta_id', '=', $carpetas],
            ])->get();*/
        //return dd($carpetas);
    }
    public function web(Request $request,$carpetas)
    {
        $this->validate($request, [
            'url' =>'required|url',
            ]);  
        $extensionImagenes = array('jpg'=>'jpg','jpeg'=>'jpeg','gif'=>'gif','png'=>'png','bmp'=>'bmp','svg'=>'svg');
      $extension = pathinfo($request->input('url'), PATHINFO_EXTENSION);

      if(!array_key_exists($extension,$extensionImagenes))
      {
        return response()->json(['url' =>['No es una imagen']],422);
      //  return [!array_key_exists($extension,$extensionImagenes)];
      }

      $nombre = str_random(40). '.' .$extension;
        $client = new Client();
        $response = $client->get($request->input('url'), ['connect_timeout' => 10, 'timeout' => 60]);
       if($response->getStatusCode() == 200){
                 Storage::put('/public/'.$nombre, $response->getBody()); //lo guarda en la carpet public
            }
        $url = url(Storage::url($nombre));
       $bbcode = '[img='.$url.']';

       $foto = new Foto;
    $foto->url = $url;
    $foto->bbcode = $bbcode;
    $foto->carpeta_id = $carpetas;
    $foto->save();
     return $foto;

        
        
      //$datos = file_get_contents($request->input('url'));
      // copy($request->input('url'),storage_path('imagenmaki.jpg'));
     /* $extension = pathinfo($request->input('url'), PATHINFO_EXTENSION);
      $nombre = str_random(40). '.' .$extension;
      
      Storage::put('/public/'.$nombre, $datos); //lo guarda en la carpet public
     
      // $nombre = 'imagenalias.jpg'; 
       //$nombre = $datos->hashName();
       $url = url(Storage::url($nombre));
       $bbcode = '[img='.$url.']';

       $foto = new Foto;
    $foto->url = $url;
    $foto->bbcode = $bbcode;
    $foto->carpeta_id = $carpetas;
    $foto->save();
     return $foto;*/

      /* Solo si se quiere guardar el enlace y usar la url que se copio*/ 
   /* $foto = new Foto;
    $foto->url = $request->input('url');
    $foto->bbcode = $request->input('bbcode');
    $foto->carpeta_id = $carpetas;
    $foto->save();
     return $foto;*/
    }

}
