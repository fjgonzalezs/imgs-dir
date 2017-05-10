<template>
	<div>
		<div class="modal is-active">
  <div class="modal-background"></div>
  <div class="modal-content">
   
<!-- 				 <vue-clip  :on-sending="sending" :options="options"> se utiliza el parametro si se quiere usar el csrf (descomentar middleware)
				  -->	
		<div class="  box ">
			
					<vue-clip  :on-sending="sending" :options="options" :on-complete="complete">
					
					<template slot="clip-uploader-action">
      <div class="subir" >
        <div class="dz-message"><h2 class="subtitle"> Click o arrastra las imagenes aquí </h2></div>
      </div>
    </template>
				 <template slot="clip-uploader-body" scope="props">
				
				 		<transition-group 
				 		name="custom-classes-transition"
    					enter-active-class="animated fadeIn"
    					leave-active-class="animated bounceOutRight">
      <div  v-for="file in props.files" v-bind:key="file" class="box">
  <article class="media">
    <div class="media-left">
      <figure class="image is-64x64">
     
          <img v-bind:src="file.dataUrl" v-bind:key="file"/>
      </figure>
    </div>
    <div class="media-content">
      <div class="content">
        <p>
          <strong><small>{{ file.name }}</small></strong>
          <br>
          <span v-show="file.status == 'added' && file.progress >= 1 " class="tag is-primary">Subiendo</span>
          <span v-show="file.status == 'added' && file.progress < 1" class="tag is-info">A la espera</span>
          <span v-show="file.status == 'error'" class="tag is-danger">Error</span>
          <li v-if="file.status == 'error'" v-for="error in errors">{{error}}</li>
          <span v-show="file.status == 'success'" class="tag is-success">Finalizado</span>
          <br>
          
           <progress class="progress is-primary is-small" :value="file.progress" v-bind:key="file" max="100"></progress>
        </p>
      </div> 
      <!-- <nav v-if="file.status == 'success'" class="level is-mobile">
        <div class="level-left">
          <a class="level-item">
            <span class="icon is-small" @click="enlace"><i class="fa fa-link"></i></span>
          </a>
          <a class="level-item">
            <span class="icon is-small"><i class="fa fa-retweet"></i></span>
          </a>
          <a class="level-item">
            <span class="icon is-small"><i class="fa fa-heart"></i></span>
          </a>
        </div>
      </nav> -->
    </div>
  </article>
</div>
      </transition-group>
				 	
    

    </template>				
						
		
  </vue-clip>
			
		</div>
		
			
		
	 
  </div>
  <button class="modal-close" @click= "$emit('cerrar-modal')"></button>
</div>
	</div>
</template>
<script>
import Evento from '../Evento.js';
//import eve from '../Evento.js';
	export default{
		
		data(){
			return {
				 activar: true,
       //   idcarpeta: '',
				 options: {
          url: 'urldefault',
          paramName: 'files', //tiene que ser asi paramName: 'files[]' para kn3
          
        },
        errors: ''
         
       

			}
		},
    created(){
     
      Evento.$on('carpeta1', data =>{
       // console.log(data)
       // this.idcarpeta = data;
        this.options.url = '/carpetas/'+ data +'/fotos'
      });
    },
    
		methods:{
			  sending (file, xhr, formData) {
       formData.append('_token',window.Laravel.csrfToken)
       //formData.append('files[]')
      },
      enlace(){
      	
      },
       complete (file, status, xhr) {
        let json = JSON.parse(xhr.response)
        // Adding server id to be used for deleting
        // the file.
        console.log(json)
        //console.log(json.files)
        if(status == 'error'){
          this.errors = json.files
        }
        else{
          Evento.$emit('foto',json);
        }
        
        //console.log(json.direct)


      }
		}


	}
</script>

<style>
	.slide-fade-enter-active {
  transition: all .3s ease;
}
.slide-fade-leave-active {
  transition: all .8s cubic-bezier(1.0, 0.5, 0.8, 1.0);
}
.slide-fade-enter, .slide-fade-leave-to
/* .slide-fade-leave-active for <2.1.8 */ {
  transform: translateX(10px);
  opacity: 0;
}
 .custom-columns {
    flex-direction: column-reverse;
    display: flex;
  }
  .subir{
  	height: 50px;
  }
</style>