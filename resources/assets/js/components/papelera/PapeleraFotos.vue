<template>
<div>
	<h2 class="subtitle">Fotos</h2>
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
         
          <a class="level-item">
            <span class="icon is-small " @click="restaurar(foto)"><i class="fa fa-history"></i></span>
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
	
	export default{
		
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
			axios.get('papelera/fotos')
			.then(response => {
				this.fotos = response.data
				this.cargando = false
			})

			//this.fotosGenerar(); //debe tener nombre diferente de cualquier dato
			//console.log(window.Laravel.csrfToken)

			
			
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
			restaurar(foto){
				axios.patch('papelera/fotos/restaurar',{
					id: foto.id
				})
				.then(response => {
					let index = this.fotos.indexOf(foto);
  		this.fotos.splice(index,1);
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

	

</style>