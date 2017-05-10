@extends ('master')
@section('contenido')
<section class="hero is-fullheight is-dark is-bold">
  <div class="hero-body">
    <div class="container">
      <div class="columns is-vcentered">
        <div class="column is-4 is-offset-4">
         <h1 class="title">Login</h1>
          <div class="box">  
     
      <form action="{{action('loginController@store')}}" method="POST">
       {{ csrf_field() }}
        <div class="field">
  <p class="control has-icon">
    <input class="input" name="email" type="email" placeholder="Ingrese su correo electronico" autofocus>
    <span class="icon">
      <i class="fa fa-envelope"></i>
    </span>
  </p>
</div>
  <div class="field">
  <p class="control has-icon">
    <input class="input" name="password" type="password" placeholder="Ingrese su contraseña">
    <span class="icon">
      <i class="fa fa-key"></i>
    </span>
  </p>
</div>
<div class="field">
  <p class="control">
    <label class="checkbox">
      <input type="checkbox">
      <label for="recordarme" class="label">Recordarme</label>
    </label>
  </p>
</div>

<div class="field is-grouped">
  <p class="control">
    <button class="button is-primary">Ingresar</button>
  </p>
 
</div>
      </form>
    </div>
        </div>
      </div>
    </div>
  </div>
</section>

@stop