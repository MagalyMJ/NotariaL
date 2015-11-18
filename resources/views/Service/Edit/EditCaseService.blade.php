@extends('layouts.homedefault')

@section('content')

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
    				
					<p class="text-center"> 
						<strong>{{$customerSelect->pivot->participants_type}}: </strong>
    					{{ $customerSelect->name .' '. $customerSelect->fathers_last_name .' '. $customerSelect->mothers_last_name }} 
						<br> <strong>Documentos Entregados: </strong>
						{{ $customerSelect->pivot->documents_list }}
    				</p>				
    				<a class="input budget-button" href="{{route('Edit_CustomerinCase',array($ServiceCase->id, $customerSelect->id) ) }}"> Documentos </a>
    			
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
		
		@yield('notices')
     	
		<label for="signature">Firmado:</label> 
      	<select name="signature">
			<option value="0">No</option>
			<option value="1">Si</option>
		</select>

		<label for="public_register">Fecha de Registro (registro publico):{{$ServiceCase->notices_two_date}} </label> 
     	<input name="public_register" class="input long" id="public_register" type="date" value="{{$ServiceCase->public_register}}"/> 

      	<label for="observations">Observaciones:</label> 
   	    <textarea rows="4" cols="50" name="observations" placeholder="Observaciones" class="message_area" value="">{{ $ServiceCase->observations }}</textarea>
		
      <input type="submit" value="Guardar" class="input budget-button">
      <a class="input budget-button" href="{{route('Show_Case_path',$ServiceCase->id) }}"> Cancelar </a>

    </form>
	</div>

@stop