<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="_token" content="{{ csrf_token() }}">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>imgkn3</title>
	<link rel="stylesheet" href="{{asset('css/bulma.css')}}">
	<link rel="stylesheet" href="{{asset('css/breadcrumb.css')}}">
	<link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
	<link href="https://unpkg.com/animate.css@3.5.1/animate.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="{{asset('css/cargando.css')}}">
	<style type="text/css" media="screen">
		.posicion{
		position: fixed !important; top: 0; left: 0; right: 0;
     z-index: 1;
		}
		
		.fondo-oscuro{
			background-color: #232B2D;
			min-height: 100vh;
			/* padding-top: 40px; */
		}
		.fondoOscuro ul {
  color: #6F7B7E;
  font-size: 15px;
  /* font-weight: bold; */
  text-transform: uppercase;
}
.pie {
  position: absolute;
  right: 0;
  bottom: 0;
  left: 0;
  padding: 2rem;
  background-color: #efefef;
  text-align: center;
} 
.seccion {
	padding-top: 50px;
	
    margin-right: 0px;

}
/* Menu */
.menu-list a {
    border-radius: 2px;
    color: #6F7B7E;
    display: block;
    padding: .5em .75em;
}
.menu-list a:hover {
     background-color: transparent; 
    color: #dbdbdb;
}
.menu-list a.is-active {
    background-color: transparent;
    color: #fff;
    font-weight: bold;
}
	</style>
</head>
<body>
<div id="app">

@include('header')
	
		
			
			<div class="columns ">
			
			@if(auth()->check())
			
				@include('aside')
				
				@endif
			
			<div class="column  ">
			
				@yield('contenido')
				
			</div>
							
				
			
			</div>

		

		
	
	 <vue-progress-bar></vue-progress-bar>
	 <modal  v-show="activarModal" @cerrar-modal="activarModal= false" ></modal>
	 <modal-web v-show="activarModalWeb" @cerrar-modal="activarModalWeb= false"></modal-web>
	 <modal-enlace v-show="activarModalEnlace" @cerrar-modal="activarModalEnlace = false"></modal-enlace>
	@include('footer')
	</div>
	<script>
    window.Laravel = {!! json_encode([
        'csrfToken' => csrf_token(),
    ]) !!};
</script>
	<script src="/js/app.js"></script>

	<script>
		function actualiza(fecha,id) {
         fecha = document.getElementById(fecha).value;
         // id =  document.getElementById(id).value;
          axios.put('/fotos/'+ id, {'created_at': fecha})
            .then(function (res) {
             
            })
            .catch(function (err) {
             
            });
       
      }
	</script>
</body>
</html>