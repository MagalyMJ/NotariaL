@extends('layouts.homedefault')

@section('content')
<!-- Mostrara Todos los Casos Activos del servicio-Post  obtenido -->


	<div class="block_container">

		<h1>Escritura Nº {{$ServiceCase->id}}</h1>
		<h3>{{$ServiceCase->service->name}}</h3>

	 <form id="Edit_Case" action="{{route('Update_Case_path',$ServiceCase->id) }}" method='post' class="form_data aling_block">  
   		{{csrf_field()}}
		
		<label for="service_detail">Detalle del Servicio</label> 
      	<input name="service_detail"class="input long" id="service_detail" type="text" autocomplete="off" value="{{ $ServiceCase->service_detail}}" />
      
		<h3>Participantes</h3>
			@foreach ($ServiceCase->customer as $customerSelect)
    			<div>
    				
    			<p class="text-center"> {{ $customerSelect->name .' '. $customerSelect->fathers_last_name .' '. $customerSelect->mothers_last_name }} </p>
    			
    			</div>
					@endforeach

		<label for="place">Lugar:</label> 
      	<select name="place">
			<option value="Aguascalientes">Aguascalientes</option>
			<option value="Asientos">Asientos</option>
			<option value="Calvillo">Calvillo</option>
			<option value="Cosio">Cosio</option>
			<option value="Jesus Maria">Jesus Maria</option>
			<option value="Pabellon de Arteaga">Pabellon de Arteaga</option>
			<option value="Rincon de Romos">Rincon de Romos</option>
			<option value="San Jose de Gracia">San Jose de Gracia</option>
			<option value="Tepezala">Tepezala</option>
			<option value="El Llano">El Llano</option>
			<option value="San Francisco de los Romo">San Francisco de los Romo</option>
		</select>
      	
      	<label for="observations">Observaciones:</label> 
   	    <textarea rows="4" cols="50" name="observations" placeholder="Observaciones" class="message_area" value="{{ $ServiceCase->observations}}"></textarea>

      <input type="submit" value="Guardar" class="input budget-button">

    </form>
	</div>

@stop