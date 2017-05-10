<template>
<!-- <div @click ="quitarEnfoque"> -->
<div>

<div class="columns">
	<div class="column is-3 ">
		<div class="nav-left">
            <a class="nav-item  " @click.prevent="crearCarpeta= true"><span class="icon-btn" ><i class="fa fa-plus"></i></span>Nueva carpeta</a>
        </div>
    </div>
    <div v-if="mostrarOpciones" class="column is-3 ">
		<div class="nav-left">
            <a class="nav-item  " @click.prevent="renombrarCarpeta= true"><span class="icon-btn" ><i class="fa fa-edit"></i></span>Renombrar... </a>
        </div>
    </div>

    <div v-if="mostrarOpciones" class="column is-3 ">
		<div class="nav-left">
            <a class="nav-item" @click="eliminar" ><span class="icon-btn" ><i class="fa fa-trash"></i></span>Eliminar... </a>
        </div>
    </div>
</div>	
<hr>
<div class="columns">
	<div class="column is-12">
		<h1 class="title">Carpetas</h1>
		
		</div>
</div>
	
	
	<transition-group v-for="carpetas in chunkCarpetas"
				 		name="list-complete"
				 		tag="div"
				 		class="columns is-multiline is-mobile "
				 		>
			 		
   <mi-carpeta v-for="carpeta in carpetas" :carpeta="carpeta" :key="carpeta.id" :enfocar ="enfocarCarpeta"   @abierta="onCarpetaAbierta"></mi-carpeta>
   

  </transition-group>
  

	<crear-carpeta v-if="crearCarpeta" @cerrar="crearCarpeta = false" @carpeta ="data =>{carpetas.unshift(data)}"></crear-carpeta> <!-- Se puede usar $event o pasarlo a un metodo para que no se vea tan feo (? -->
	<renombrar-carpeta  v-if="renombrarCarpeta" @cerrar="renombrarCarpeta = false" :carpeta="carpetaActual" @nombrecarpeta="renombreCarpeta"></renombrar-carpeta>
	
	</div>
</template>
<script>
import RenombrarCarpeta from './RenombrarCarpeta.vue'
	export default{
		components: {'renombrar-carpeta':RenombrarCarpeta}, //tambien se puede poner en app
		data(){
			return{
				carpetas:[],
				carpetaActual: {},
				crearCarpeta: false,
				renombrarCarpeta: false,
				//enfocar: [],
				enfocarCarpeta: -1,
				mostrarOpciones: false
			}
		},

		created(){
			axios.get('/carpetas/todas') //ver si solo funciona con "/carpetas/todas"
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
			
			cambiarEstado(posicion){ 
				this.enfocar.forEach((data,index)=>{ //primero ponemos todo en falso
					data.state = false
				});
				this.enfocar[posicion].state = true //enfoco al seleccionado

				this.carpetaActual = {'carpeta':this.carpetas[posicion], 'posicion':posicion} // envio el objeto de la carpeta actual al componente renombrarCarpeta
				this.mostrarOpciones = true
			},
			quitarEnfoque(event){ //aun no implementado
				console.log(event.target.tagName)
				if (event.target.tagName !== 'DIV') return;
        
				this.enfocar.forEach((data,index)=>{ 
					data.state = false
				});
			},
			renombreCarpeta(data){
				console.log(data)
				this.carpetas.find(carpeta =>{
					if(carpeta.id == data.id){
						carpeta.nombre = data.nombre
						this.renombrarCarpeta = false
					}
				})
				
				
			},
			onCarpetaAbierta(id){
				this.enfocarCarpeta = id
				this.mostrarOpciones = true
				this.carpetaActual = this.carpetas.find(carpeta => carpeta.id == id)
				//this.carpetaActual = this.carpetas[id - 1 ]
				//console.log(this.carpetaActual)
			},
			eliminar(){
				axios.delete('/carpetas/'+ this.carpetaActual.id)
				.then(response => {
					let index = this.carpetas.indexOf(this.carpetaActual);
  					this.carpetas.splice(index,1);
  					this.mostrarOpciones = false
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