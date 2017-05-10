<template>
	<div>
		<div class="modal is-active">
  <div class="modal-background"></div>
  <div class="modal-content">
   
<!-- 				 <vue-clip  :on-sending="sending" :options="options"> se utiliza el parametro si se quiere usar el csrf (descomentar middleware)
				  -->	
		<div class="  box ">
			
					<vue-clip  :options="options" :on-complete="complete">
					
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
          {{ file.status }}
          <br>
           <progress class="progress is-primary is-small" :value="file.progress" v-bind:key="file" max="100"></progress>
        </p>
      </div>
      <nav class="level is-mobile">
        <div class="level-left">
          <a class="level-item">
            <span class="icon is-small"><i class="fa fa-reply"></i></span>
          </a>
          <a class="level-item">
            <span class="icon is-small"><i class="fa fa-retweet"></i></span>
          </a>
          <a class="level-item">
            <span class="icon is-small"><i class="fa fa-heart"></i></span>
          </a>
        </div>
      </nav>
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
	export default{
		data(){
			return {
				 activar: true,
         idcarpeta:'',
				 options: {
          url: 'http://cors-anywhere.herokuapp.com/http://kn3.net/upload.php',
          //url: 'http://kn3.net/upload.php',
          paramName: 'files[]' //tiene que ser asi paramName: 'files[]' para kn3
        }
       

			}
		},
    created(){
       Evento.$on('carpeta1', data =>{
       // console.log(data)
       // this.idcarpeta = data;
        this.idcarpeta = data;
      });
    },
		methods:{
			cancelar(file){
			//	console.log (file.abort);
			},
       complete (file, status, xhr) {
        let json = JSON.parse(xhr.response)
        // Adding server id to be used for deleting
        // the file.
        console.log(json)
        axios.post('/carpetas/'+ this.idcarpeta +'/fotos/web',{
          url: json.direct,
          bbcode: '[img='+ json.direct +']'
        })
        .then(response =>{
          Evento.$emit('foto',response.data);
        })
         //Evento.$emit('foto',json);
        console.log(json.direct)


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