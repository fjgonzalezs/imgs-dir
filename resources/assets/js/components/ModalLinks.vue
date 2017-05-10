<template>
	<div>
		<div class="modal is-active">
  <div class="modal-background" @click= "$emit('cerrar-modal')"></div>
  <div class="modal-content">
   
<!-- 				 <vue-clip  :on-sending="sending" :options="options"> se utiliza el parametro si se quiere usar el csrf (descomentar middleware)
				  -->	
		<div class="  box ">
    <h1 class="title">Enlaces</h1>
    <h2 class="subtitle">Haga click sobre el enlace para seleccionarlo</h2>
     <div class="columns is-multiline is-mobile">
          <div class="column is-half is-offset-one-quarter">
          <figure class="box image">
            <a target="_blank" :href="foto.url">
       <img :src="foto.url">
       </a>
          </figure>
         
          </div>
        </div>
			

			<div class="field is-horizontal">
  <div class="field-label is-normal">
    <label class="label">Url directa</label>
  </div>
  <div class="field-body">
    <div class="field is-grouped">
      <p class="control is-expanded">
        <input class="input puntero" type="text" placeholder="Url directa" :value="foto.url"   @click="seleccionarUrl">
      </p>
    </div>
    
  </div>
</div>
  
      <div class="field is-horizontal">
  <div class="field-label is-normal">
    <label class="label">BBcode</label>
  </div>
  <div class="field-body">
    <div class="field is-grouped">
      <p class="control is-expanded">
        <input class="input puntero" type="text" placeholder="BBcode" :value="foto.bbcode" @click="seleccionarBBcode">
      </p>
    </div>
    
  </div>
</div>
			
		</div>
		
			
		
	 
  </div>
  <button class="modal-close" @click= "$emit('cerrar-modal')"></button>
</div>
	</div>
</template>
<script>
	export default{
    props: ['foto'],
    data(){
      return{
        enlace: '',
        bbcode: ''

      }
    },
    mounted(){
      this.enlace = this.foto.url
      this.bbcode = this.foto.bbcode
      //this.url = this.foto.url
    },
    methods:{
      seleccionarUrl: function (event){
       // this.url = this.foto.url;
        event.target.setSelectionRange(0, this.enlace.length);
      },
      seleccionarBBcode: function (event){
       // this.url = this.foto.url;
        event.target.setSelectionRange(0, this.bbcode.length);
      }
    }
	

	}
</script>
<style>
  .puntero{
    cursor: default;
  }
</style>

