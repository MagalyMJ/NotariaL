@extends('layouts.homedefault')

@section('content')
<!-- Mostrara Todos los Casos Activos del servicio-Post  obtenido -->


	<div class="block_container">

		<h1>Escritura Nº {{$ServiceCase->id}}</h1>
		<section id="partisipans_thisCase" >
			@foreach ($ServiceCase->customer as $customerSelect)
    			<div>
    				
    			<p class="text-center"> {{ $customerSelect->name .' '. $customerSelect->fathers_last_name .' '. $customerSelect->mothers_last_name }} </p>
    			
    			</div>
					@endforeach
		</section>
		<section id="budget_thisCase">
			
		</section>	
	</div>

@stop
