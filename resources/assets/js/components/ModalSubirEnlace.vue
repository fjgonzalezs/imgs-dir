<template>
	<div>
		<div class="modal is-active">
  <div class="modal-background"></div>
  <div class="modal-card">
    <header class="modal-card-head">
      <p class="modal-card-title">Agregar imagen de enlace</p>
      <button class="delete" @click ="$emit('cerrar-modal')"></button>
    </header>
    <section class="modal-card-body">
      <div class="field is-horizontal">
  <div class="field-label is-normal">
    <label class="label">Url de la imagen</label>
  </div>
  <div class="field-body">
    <div class="field">
      <div class="control">
        <input class="input" type="text" placeholder="Url de la imagen" v-model="imagen" autofocus>
        <li v-show="estados" v-for="estado in estados">{{estado}}</li>
      </div>
      
    </div>
  </div>
</div>
    </section>
    <footer class="modal-card-foot">
      <a class="button is-success":class="{'is-loading': cargando === true}" @click="subir">Guardar</a>
      <a class="button"  @click ="$emit('cerrar-modal')">Cancelar</a>
    </footer>
  </div>
</div>
	</div>
</template>
<script>
import Evento from '../Evento.js';
	export default{
		
		data(){
			return{
				 idcarpeta:'',
				imagen: '',
        estados: '',
        cargando:false

			}
		},

		created(){
			  Evento.$on('carpeta1', data =>{
              this.idcarpeta = data;
      });
		},

		methods:{
			subir(){
				  this.cargando = true
			axios.post('/carpetas/'+ this.idcarpeta +'/fotos/web',{
          url: this.imagen,
          bbcode: '[img='+ this.imagen +']'
        })
        .then(response =>{
        	console.log(response)
          this.estados = ['Subido']
          this.cargando = false
          Evento.$emit('foto',response.data)
        })
        .catch( error => {
        console.log(error.response)
        this.cargando = false
        this.estados = error.response.data.url
        //this.errores = 'no es una imagen'
    });
			},

			subir2(){
			/*	 var config = {
            onDownloadProgress: function(progressEvent) {
              var percentCompleted = Math.round( (progressEvent.loaded * 100) / progressEvent.total );
              console.log(percentCompleted)
            },
             
          };
          axios.get('http://danbooru.donmai.us/data/__nishikino_maki_love_live_and_love_live_school_idol_project_drawn_by_shamakho__85964982146604e3cf4eb9b14646f0ae.jpg')
          .then(response => console.log(response))*/
			this.$http.get('http://danbooru.donmai.us/data/__nishikino_maki_love_live_and_love_live_school_idol_project_drawn_by_shamakho__85964982146604e3cf4eb9b14646f0ae.jpg', {
    progress(e) {
        if (e.lengthComputable) {
            console.log(e.loaded / e.total * 100);
        }
    },
     
    headers: {
       'Access-Control-Allow-Origin': '*'
    }
})
			}

		}

	}
</script>