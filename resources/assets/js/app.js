
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example', require('./components/Example.vue'));
Vue.component('fotos',require('./components/Fotos.vue'));
Vue.component('modal',require('./components/Modal.vue'));
Vue.component('modal-web',require('./components/ModalWeb.vue'));
Vue.component('modal-links',require('./components/ModalLinks.vue'));
Vue.component('carpetas',require('./components/Carpetas.vue'));
Vue.component('crear-carpeta',require('./components/CrearCarpeta.vue'));
Vue.component('mi-carpeta',require('./components/MiCarpeta.vue'));
Vue.component('modal-enlace',require('./components/ModalSubirEnlace.vue'));
Vue.component('breadcrumb',require('./components/BreadCrumb.vue'));
Vue.component('favoritos',require('./components/Favoritos.vue'));
Vue.component('papelera-fotos',require('./components/papelera/PapeleraFotos.vue'));
Vue.component('papelera-carpetas',require('./components/papelera/PapeleraCarpetas.vue'));


const app = new Vue({
    el: '#app',
    created(){
    //	this.$Progress.start(); //revisar ese progress
    },
    mounted(){
    //	this.$Progress.finish(); //este tambien

    },
    data(){
    	return{
    		activarModal: false,
    		activarModalWeb: false,
            activarModalEnlace: false,
    		estadoNav: false,
            cargando: true
            
    		

    	}

    },
    methods:{
    	activarNav(){
    		if(this.estadoNav == false){
    			this.estadoNav = true
    		}
    		else{
    			this.estadoNav = false
    		}
    		
    	}
    	},
        computed:{
            oncargando(){

                
             this.$on('cargado', data => this.cargando = data)
             return this.cargando
            }
        },
        mounted(){
           // this.$on('cargado', data => this.cargando = data)    
        }

});
