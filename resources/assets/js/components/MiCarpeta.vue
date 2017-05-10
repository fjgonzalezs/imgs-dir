<template>
	
		 
  <div class="column is-2-desktop is-one-third-tablet is-half-mobile list-complete-item " >	
 <div class="button is-medium  cursor" :class="{'is-focused': carpeta.id === enfocar}" :title="carpeta.nombre" @click="enfocarCarpeta" @dblclick = "redireccion(carpeta.id)">

    <span class="icon is-medium">
      <i v-if="enfocar !== carpeta.id" class="fa fa-folder"></i>
      <i v-if="enfocar === carpeta.id" class="fa fa-folder-o"></i>
    </span>
    <h6 class=" title is-6 "><strong>{{carpeta.nombre | truncate(15)}}</strong></h6>
  </div>
</div>
  
	
</template>
<script>
	export default{ // implementar la respuesta https://es.stackoverflow.com/questions/61634/seleccionar-solamente-un-item-de-una-lista-de-componentes-hijos-en-vue-js-2/62759#62759 (listo)
		props:['carpeta','focus', 'enfocar'],
		/*data(){
			return{
				enfoca: this.enfocar
			}
		},*/
		methods:{
			
			redireccion(id){

				//window.location.replace('carpetas/'+id+'/fotos');
				window.location.href = 'carpetas/'+id+'/fotos';
				//window.location.assign('carpetas/'+id+'/fotos');
			},
			enfocarCarpeta(){
				this.$emit('abierta', this.carpeta.id)
			}
		},
		mounted(){
			//this.enfoca = this.focus
		},
		computed:{
			cambiarEstado(){
				this.enfoca = this.focus
				 return this.enfoca
			}
		}
	}
</script>

<style>
	.cursor{
		cursor: default;
	}
	
</style>