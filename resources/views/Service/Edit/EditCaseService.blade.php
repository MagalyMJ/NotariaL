@extends('layouts.homedefault')

@section('content')

	<div class="block_container">

		<h1>Escritura Nº {{$ServiceCase->id}}</h1>
		<h3>{{$ServiceCase->service->name}}</h3>

	 <form id="Edit_Case" action="{{route('Update_Case_path',$ServiceCase->id) }}" method='post' class="form_data">  
   		{{csrf_field()}}
		
		<label for="service_detail">Detalle del Servicio</label> 
      	<input name="service_detail"class="input long" id="service_detail" type="text" autocomplete="off" value="{{ $ServiceCase->service_detail}}" />
      
      <div class="form_data_participans">
		<h3>Participantes</h3>
			@foreach ($ServiceCase->customer as $customerSelect)
    			<div class="form_data_participans_detail">
    				
					<p class="text-center"> 
						<strong>{{$customerSelect->pivot->participants_type}}: </strong>
    					{{ $customerSelect->name .' '. $customerSelect->fathers_last_name .' '. $customerSelect->mothers_last_name }} 
						<br> <strong>Documentos Entregados: </strong>
						{{ $customerSelect->pivot->documents_list }}
    				</p>				
    				<a class="input budget-button" href="{{route('Edit_CustomerinCase',array($ServiceCase->id, $customerSelect->id) ) }}"> Documentos </a>
    			</div>
					@endforeach
		</div>
		<div class="">
			<label for="place">Lugar:</label> 
	      	<select name="place">
				<option value="Aguascalientes" @if($ServiceCase->place == 'Aguascalientes'){{ "selected" }} @endif>Aguascalientes</option>
				<option value="Asientos" @if($ServiceCase->place == 'Asientos'){{ "selected" }} @endif >Asientos</option>
				<option value="Calvillo" @if($ServiceCase->place == 'Calvillo'){{ "selected" }} @endif >Calvillo</option>
				<option value="Cosio" @if($ServiceCase->place == 'Cosio'){{ "selected" }} @endif >Cosio</option>
				<option value="Jesus Maria" @if($ServiceCase->place == 'Jesus Maria'){{ "selected" }} @endif >Jesus Maria</option>
				<option value="Pabellon de Arteaga" @if($ServiceCase->place == 'Pabellon de Arteaga'){{ "selected" }} @endif >Pabellon de Arteaga</option>
				<option value="Rincon de Romos" @if($ServiceCase->place == 'Rincon de Romos'){{ "selected" }} @endif >Rincon de Romos</option>
				<option value="San Jose de Gracia" @if($ServiceCase->place == 'San Jose de Gracia'){{ "selected" }} @endif >San Jose de Gracia</option>
				<option value="Tepezala" @if($ServiceCase->place == 'Tepezala'){{ "selected" }} @endif >Tepezala</option>
				<option value="El Llano" @if($ServiceCase->place == 'El Llano'){{ "selected" }} @endif >El Llano</option>
				<option value="San Francisco de los Romo" @if($ServiceCase->place == 'San Francisco de los Romo'){{ "selected" }} @endif >San Francisco de los Romo</option>
			</select>
			
			@yield('notices')
	     	
			<label for="signature">Firmado:</label> 
	      	<select name="signature">
				<option value="0" @if($ServiceCase->signature == 0){{ "selected" }} @endif >No</option>
				<option value="1" @if($ServiceCase->signature == 1){{ "selected" }} @endif >Si</option>
			</select>

			<label for="public_register">Fecha de Registro (registro publico):{{$ServiceCase->public_register}} </label> 
	     	<input name="public_register" class="input long" id="public_register" type="date" value="{{$ServiceCase->public_register}}"/> 
		</div>

		<div class="form_data_observations">
      		<label for="observations">Observaciones:</label> 
   	    	<textarea rows="4" cols="50" name="observations" placeholder="Observaciones" class="message_area" value="">{{ $ServiceCase->observations }}</textarea>
		</div>

		<section class = "action_buttons">	
    	  <input type="submit" value="Guardar" class="input budget-button">
    	  <a class="input budget-button" href="{{route('Show_Case_path',$ServiceCase->id) }}"> Cancelar </a>
		</section>
    </form>
	</div>

@stop