@extends ('master')
@section('contenido')


		<breadcrumb nombrecarpeta="{{$nombreCarpeta}}"></breadcrumb>
<div class="columns">
	<div class="column is-12">
		<h1 class="title">fotos</h1>
		
		</div>
</div>

	
	
          <div class="columns">
          	<div class="column">
          		<a @click="activarModalWeb = true" class="button is-primary nav-item ">
              <span class="icon">
                <i class="fa fa-cloud-upload"></i>
              </span>
              <span>Subir imagenes en la web</span>
            </a>
          	</div>
          	<div class="column">
          		<a @click="activarModal = true" class="button is-primary nav-item ">
              <span class="icon">
                <i class="fa fa-cloud-upload"></i>
              </span>
              <span>Subir imagenes localmente</span>
            </a>
          	</div>
          	<div class="column">
          		 <a @click="activarModalEnlace = true" class="button is-primary nav-item ">
             	 <span class="icon">
                <i class="fa fa-cloud-upload"></i>
              	</span>
              <span>Subir imagenes por url</span>
            </a>
          	</div>
          </div>
              
              
          
          <hr>

		<div v-show="cargando" class="cargando">Cargando...</div>
		<fotos idcarpeta="{{$idcarpeta}}" nombrecarpeta="{{$nombreCarpeta}}" @cargado="data => cargando = data"></fotos>
	
	
		
	
	

@stop