<template>
	<div>
		<ul class="breadcrumb">
  <li><a href="/carpetas">Carpetas</a></li>
  <li v-if="activo= true"><a href="#">{{nombrecarpeta}}</a></li>
  
</ul>
	</div>
</template>

<script>
	export default{
		props:['nombrecarpeta','bread'],
		data(){
			return{
				activo: this.bread
			}
		}

	}
</script>