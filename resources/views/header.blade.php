
   <nav class="nav has-shadow">
  <div class="nav-left">
    <a href="{{url('/')}}" class="nav-item">
      <h1 class="title">Inicio</h1>
    </a>
  </div>

  

  <!-- This "nav-toggle" hamburger menu is only visible on mobile -->
  <!-- You need JavaScript to toggle the "is-active" class on "nav-menu" -->
  <span class="nav-toggle" v-on:click="activarNav" v-bind:class="{'is-active': estadoNav}">
    <span></span>
    <span></span>
    <span></span>
  </span>

  <!-- This "nav-menu" is hidden on mobile -->
  <!-- Add the modifier "is-active" to display it on mobile -->
 <div class="nav-right nav-menu" v-bind:class="{'is-active': estadoNav}">
         @if(auth()->check())
         <!--  <span class="nav-item is-hidden-desktop is-hidden-tablet ">
           <a @click="activarModalWeb = true" class="button is-primary is-inverted">
             <span class="icon">
               <i class="fa fa-cloud-upload"></i>
             </span>
             <span>Subir imagenes</span>
           </a>
         </span> -->

          <div class="column is-hidden-desktop is-hidden-tablet">
          <span class="nav-item">
            <a href="{{url('carpetas')}}">Carpetas</a>
          </span>
          </div>
          <span class="nav-item is-hidden-desktop is-hidden-tablet">
             <a href="{{url('favoritos')}}">Favoritos</a>
          </span>

          @endif
          @if(auth()->check())
            <a href="#" class="nav-item">
             <span class="icon">
            <i class="fa fa-user-circle"></i>
            </span>  {{auth()->user()->name}}
          </a>
          @else
          <a href="{{action('loginController@index')}}" class="nav-item">
            Login
          </a>
          @endif
                   
        </div>
</nav>
  