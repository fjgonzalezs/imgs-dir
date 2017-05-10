<template>
<!-- <div @click ="quitarEnfoque"> -->
<div>

<div class="columns">
	
    <div v-if="mostrarOpciones" class="column is-3 ">
		<div class="nav-left">
            <a class="nav-item  " @click="restaurar"><span class="icon-btn" ><i class="fa fa-edit"></i></span>Restaurar</a>
        </div>
    </div>
</div>	
<hr>
<div class="columns">
	<div class="column is-12">
		<h2 class="subtitle">Carpetas</h2>
		
		</div>
</div>
	
	
	<transition-group v-for="carpetas in chunkCarpetas"
				 		name="list-complete"
				 		tag="div"
				 		class="columns is-multiline is-mobile "
				 		>
			 		
   <mi-carpeta v-for="carpeta in carpetas" :carpeta="carpeta" :key="carpeta.id" :enfocar ="enfocarCarpeta"   @abierta="onCarpetaAbierta"></mi-carpeta>
   

  </transition-group>
  

	
	
	</div>
</template>
<script>

	export default{
		
		data(){
			return{
				carpetas:[],
				carpetaActual: {},
				
				restaurarCarpeta:false,
				//enfocar: [],
				enfocarCarpeta: -1,
				mostrarOpciones: false
			}
		},

		created(){
			axios.get('/papelera/carpetas') //ver si solo funciona con "/carpetas/todas"
			.then(response =>{
				this.carpetas = response.data
				/*this.carpetas.forEach((data, index) =>{
					data.llave = index //agregando un nuevo objeto llave que va a tener el indice del array
					this.enfocar.push({state: false}) //se agregar un array con los estados de los objetos

				})*/
				console.log(response.data)


			})
			
		},
		computed:{
			chunkCarpetas(){
				return window._.chunk(this.carpetas,6);
			}
			

		},
		methods:{
			
			
			quitarEnfoque(event){ //aun no implementado
				console.log(event.target.tagName)
				if (event.target.tagName !== 'DIV') return;
        
				this.enfocar.forEach((data,index)=>{ 
					data.state = false
				});
			},
			
			onCarpetaAbierta(id){
				this.enfocarCarpeta = id
				this.mostrarOpciones = true
				this.carpetaActual = this.carpetas.find(carpeta => carpeta.id == id)
				//this.carpetaActual = this.carpetas[id - 1 ]
				//console.log(this.carpetaActual)
			},
			restaurar(){
				axios.patch('papelera/carpetas/restaurar',{
					id: this.carpetaActual.id
				})
				.then(response => {
					let index = this.carpetas.indexOf(this.carpetaActual);
  		this.carpetas.splice(index,1);
  		this.mostrarOpciones = false;
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