<template>
	<div>
		<div class="modal is-active">
  <div class="modal-background"></div>
  <div class="modal-card">
    <header class="modal-card-head">
      <p class="modal-card-title">Crear carpeta</p>
      <button class="delete" @click ="$emit('cerrar')"></button>
    </header>
    <section class="modal-card-body">
      <div class="field is-horizontal">
  <div class="field-label is-normal">
    <label class="label">Nombre de la carpeta</label>
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
      <a class="button is-success" @click="crear">Guardar</a>
      <a class="button" @click ="$emit('cerrar')">Cancelar</a>
    </footer>
  </div>
</div>
	</div>
</template>
<script>
	export default{
		data(){
			return{
				nombre: ''
			}
		},
		methods:{
			crear(){
				axios.post('/carpetas',{nombre: this.nombre}).
				then(response => {
					console.log(response.data)
					this.$emit('carpeta',response.data)
				})
			}
		}
	}
</script>