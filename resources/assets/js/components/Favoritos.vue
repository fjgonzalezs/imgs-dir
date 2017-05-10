<template>
	<div>
	<div class="columns">
	<div class="column is-12">
		<h1 class="title">Favoritos</h1>
		
		</div>
</div>
	<div v-if="cargando == true" class="cargando">Cargando...</div>
	
	<transition-group v-for="fotos in chunkFotos"
				 		name="list-complete"
				 		tag="div"
				 		class="columns is-multiline is-mobile "
				 		>
    <div class="column is-2-desktop is-one-third-tablet is-half-mobile list-complete-item" v-for="foto in fotos" v-bind:key="foto.id" >
     <figure class="box image ">
			<a @click="abrirModal(foto)">
			<img :src="foto.url">
			 </a>
			 
			 <br>
			  <nav class="level is-mobile  ">
        <div class="level-left">
          <a class="level-item">
            <span class="icon is-small" @click="abrirModal(foto)"><i class="fa fa-link"></i></span>
          </a>
         
          <a class="level-item corazon" :class="{'favorito' : foto.favorito == true }" @click="cambiarFavorito(foto)">
            <span class="icon is-small "><i class="fa fa-heart"></i></span>
          </a>
        </div>
        <div class="level-right">
        	 <a class="level-item">
            <span class="icon is-small" @click="eliminar(foto)"><i class="fa fa-trash"></i></span>
          </a>
        </div>
      </nav>
				 </figure>
   </div> 
  </transition-group>
		

		 <modal-links  v-if="activarModalLinks" :foto="foto" @cerrar-modal="activarModalLinks= false"></modal-links>
 
	</div>
</template>
<script>
	import Evento from '../Evento.js';
//import eve from '../Evento.js';
	export default{
		props: ['idcarpeta','nombrecarpeta'],
		data(){
			return{
				fotos: [],
				activarModalLinks: false,
				foto:{},
				cargando : true,
				bread: true
				
			}
		},
		created(){
			//console.log(window._.chunk(['a', 'b', 'c', 'd'], 2));
			//console.log(window._.chunk(this.fotos),6)

			//console.log(this.idcarpeta)
			axios.get('favoritos/todas')
			.then(response => {
				this.fotos = response.data
				this.cargando = false
			})

			//this.fotosGenerar(); //debe tener nombre diferente de cualquier dato
			//console.log(window.Laravel.csrfToken)

			Evento.$on('foto', dato =>{
				this.fotos.unshift(dato);
			});
			
		},
		mounted(){
			Evento.$emit('carpeta1',this.idcarpeta);
		},
		computed:{
			chunkFotos(){
			return window._.chunk(this.fotos,6);
			}
		},
		methods:{
						
			abrirModal(foto){
				this.foto = foto
				this.activarModalLinks = true

			},
			eliminar(foto){
				axios.delete('./fotos/'+foto.id,{
					id: foto.id
				}).then(response =>{
					let index = this.fotos.indexOf(foto);
  		this.fotos.splice(index,1);
				})
			},
			cambiarFavorito(data){
				axios.patch('./fotos/'+data.id,{
					favorito: !data.favorito
				})
				.then(response =>{
					this.fotos.find(foto =>{
						if( foto.id == response.data.id ){ //tambien puede ir data.id, no se cual es mejor
							foto.favorito = response.data.favorito
							let index = this.fotos.indexOf(foto);
  							this.fotos.splice(index,1);
						}
					})

				})
			}
		
		}
	}
</script>

<style>
	.list-complete-item {
  transition: all 1s;
  display: inline-block;
  /* margin-right: 10px; */
}
.list-complete-enter, .list-complete-leave-to
/* .list-complete-leave-active for <2.1.8 */ {
  opacity: 0;
  transform: translateY(30px);
}
.list-complete-leave-active {
  position: absolute;
}

	a.corazon:hover { /*clase corazon, si se quiere que cuando se pase el mouse sobre el corazon cambien de color*/
    color: #ff3860;
}
.favorito{
	color: #ff3860;
}

</style>