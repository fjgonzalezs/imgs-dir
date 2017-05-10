<template>
	<div>
		<div class="modal is-active">
  <div class="modal-background"></div>
  <div class="modal-card">
    <header class="modal-card-head">
      <p class="modal-card-title">Renombrar carpeta a "{{nombre}}"</p>
      <button class="delete" @click ="$emit('cerrar')"></button>
    </header>
    <section class="modal-card-body">
      <div class="field is-horizontal">
  <div class="field-label is-normal">
    <label class="label">Ingrese el nuevo nombre</label>
  </div>
  <div class="field-body">
    <div class="field">
      <div class="control">
        <input class="input" type="text" placeholder="Nombre de la carpeta" v-model="nombre" autofocus>
      </div>
    </div>
  </div>
</div>
    </section>
    <footer class="modal-card-foot">
      <a class="button is-success" @click="actualizar">Actualizar</a>
      <a class="button" @click ="$emit('cerrar')">Cancelar</a>
    </footer>
  </div>
</div>
	</div>
</template>
<script>
	export default{
		props:['carpeta'],
		data(){
			return{
				nombre: this.carpeta.nombre
			}
		},
    created(){
      console.log(this.carpeta)
     // this.nombre = this.carpeta.nombre
    },
		methods:{
			actualizar(){
				axios.patch('/carpetas/'+this.carpeta.id,{
					nombre: this.nombre
				})
				.then(response =>{
					this.$emit('nombrecarpeta',{'nombre':response.data.nombre, 'id':response.data.id}) 

				})
			}
		}

	}
</script>