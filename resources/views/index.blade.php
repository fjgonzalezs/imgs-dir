@extends('master')
@section('contenido')
@if(Auth::check())
{{Auth::user()->name}}
<br>
@foreach($fotos as $foto)
<input type="text" id="fecha[{{$loop->iteration}}]" onblur="actualiza('fecha[{{$loop->iteration}}]',{{$foto->id}})" value="{{$foto->created_at}}">
<input hidden type="text" id="id[{{$loop->iteration}}]" value="{{$foto->id}}">
@endforeach

@else
<div class="columns">
	<div class="column is-4">
		<h3 class="title"> No está logeado</h3>
		
	</div>
</div>

@endif
@stop