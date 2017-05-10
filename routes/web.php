<?php
use Illuminate\Support\Facades\Auth;
use App\Foto;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Filesystem\Filesystem;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
	
Route::get('/', function () {
	$fotos = Foto::all();
	return view('index',['fotos' => $fotos]);

});

Route::group(['middleware' => 'guest'], function () {
  Route::resource('login','loginController', ['names' => [
    'index' => 'login'
]]);
});

Route::get('logout',function(){
	Auth::logout();
	return 'deslogeado';
});
Route::get('fotos/todas',function(){
	//return Foto::where('user_id','>=',1)->orderBy('id', 'desc')->get();
	return User::find(auth()->user()->id)->fotos;
	
	//return response()->json(Foto::all());
})->middleware('auth');
Route::get('carpetas/todas',function(){ //ordenar las rutas
	//return Foto::where('user_id','>=',1)->orderBy('id', 'desc')->get();
	return User::find(auth()->user()->id)->carpetas()->orderBy('id', 'desc')->get();
	
	//return response()->json(Foto::all());

})->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
	Route::get('/asd', function () {
	return view('carpetas');
});

Route::resource('carpetas','CarpetaController');
Route::resource('fotos','fotoController'); //tal vez de error en algunas versiones de php por las mayusculas cuando es clase (revisar si sirve)

Route::get('favoritos','FavoritoController@index');
Route::get('favoritos/todas','FavoritoController@todas');

Route::get('papelera','PapeleraController@index');
Route::get('papelera/fotos','PapeleraController@mostrarFotos');
Route::patch('papelera/fotos/restaurar','PapeleraController@restaurarFotos');


Route::get('papelera/carpetas','PapeleraController@mostrarCarpetas');
Route::patch('papelera/carpetas/restaurar','PapeleraController@restaurarCarpetas');

Route::post('carpetas/{carpetas}/fotos/web', 'Carpeta\FotoController@web');
Route::get('carpetas/{carpetas}/fotos/todas', 'Carpeta\FotoController@todas');
Route::resource('carpetas/{carpetas}/fotos', 'Carpeta\FotoController');


});



