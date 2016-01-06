@extends('layouts.homedefault')

@section('content')

	<div class="block_container">

		<h1>Tramite Nº {{$ServiceCase->id}}</h1>
		<section class="title_continer">
    		<img class="title_icon" src="{{ asset($ServiceCase->service->icon_path) }}" alt=""> 
    		<h2>{{$ServiceCase->service->name}}</h2>
  		</section>

	 <form id="Edit_Case" action="{{route('Update_Case_path',$ServiceCase->id) }}" method='post' class="form_data">  
   		{{csrf_field()}}
		<div class="long">
			<label for="service_detail">Detalle del Tramite</label> 
      		<input name="service_detail"class="input long" id="service_detail" type="text" autocomplete="off" value="{{ $ServiceCase->service_detail}}" />
     	</div>
      <div class="form_data_participans">
		<section class="title_continer">
					<img class="title_icon" src="{{ asset('img/icons/system/participantes.ico') }}" alt="">
					<h3 class="title" >Participantes</h3>
				</section>
			@foreach ($ServiceCase->customer()->orderBy('participants_type')->get() as $customerSelect)
    			
    			<div class="form_data_participans_detail">
    				
					<p class="text-center"> 
						<section class="title_continer">
							<strong>{{$customerSelect->pivot->participants_type}}</strong>
						</section>
						
    					{{ $customerSelect->name .' '. $customerSelect->fathers_last_name .' '. $customerSelect->mothers_last_name }} 
						<br> <strong>Documentos Entregados: </strong>
						{{ $customerSelect->pivot->documents_list }}
    				</p>				
    				<a class="budget-button button_big" href="{{route('Edit_CustomerinCase',array($ServiceCase->id, $customerSelect->id) ) }}"> 
    					<img class="title_icon" src="{{ asset('img/icons/system/edit_file.ico') }}" alt="Documentos">
              			<p>Documentos</p>   
              		</a>
    			</div>
					@endforeach
		</div>
		<div class="form_caseDetail">
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
		
			<label for="N_write">Número de Escritura</label>
	     	<input name="N_write" class="input long" id="N_write" type="number" value="{{$ServiceCase->N_write}}"/> 
			
			<label for="public_register">Fecha de Registro (registro publico):{{$ServiceCase->public_register}} </label> 
	     	<input name="public_register" class="input long" id="public_register" type="date" value="{{$ServiceCase->public_register}}"/> 
			
			<label for="voucher">Número de Volante</label>
	     	<input name="voucher" class="input long" id="voucher" type="number" value="{{$ServiceCase->voucher}}"/> 

			<label for="voucher_date">Fecha del Volante (registro publico):{{$ServiceCase->voucher_date}} </label> 
	     	<input name="voucher_date" class="input long" id="voucher_date" type="date" value="{{$ServiceCase->voucher_date}}"/> 
		
		</div>

		<div class="form_data_observations">
   	    	<textarea rows="4" cols="50" name="observations" placeholder="Observaciones" class="message_area" value="">{{ $ServiceCase->observations }}</textarea>
		</div>

		<section class = "action_buttons">	
    	  <button type="submit" class="budget-button button_normal">
    	 	 <img class="title_icon" src="{{ asset('img/icons/system/check.ico') }}" alt="Nuevo Registro">
             <p> Guardar </p> 
            </button>
    	  <a class="budget-button button_normal" href="{{route('Show_Case_path',$ServiceCase->id) }}"> 
    	  		<img class="title_icon" src="{{ asset('img/icons/system/cancel.ico') }}" alt="Cancelar">
              	<p> Cancelar </p>  
          </a>
		</section>
    </form>
	</div>

@stop