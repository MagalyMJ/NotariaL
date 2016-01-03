@extends('layouts.homedefault')

@section('content')
<!-- Mostrara Todos los Casos de un Cliente.
	Parametros: 
-->
	<div class="block_container">

		<h1>{{ $customer->name." ".$customer->fathers_last_name." ".$customer->mothers_last_name }} </h1>
		<section>	
		 <p>RFC: {{ $customer->rfc }}</p>
	     <p>Teléfono: {{$customer->phone}} </p>
	     <p> Fecha de Nacimiento: {{$customer->birthdate}} </p>
	     <p> Estado Civil: {{$customer->marital_status}} </p>
	     <p> Ocupacion: {{$customer->occupation}} </p>
	     <p> Originario:{{$customer->from}} </p>
	     @foreach ($customer->address as $address)
	     		<p> Dirección: {{ $address->street . " #" .$address->number }} </p>
			@endforeach	
		</section>
		<section class = "action_buttons">
			
			<!-- 	  <a class="input budget-button button_normal" href="">Editar</a>
				  <a class="input budget-button button_normal" href="">Eliminar </a> -->
				  
		</section>
			<table class="table-fill">
				<caption class="text-center"> <h2>Tramites de {{ $customer->name." ".$customer->fathers_last_name." ".$customer->mothers_last_name }}</h2></caption>
				<thead>
					<tr>
						<th class="text-center"> 
							<p>NºFolio</p> 
						</th>
						<th class="text-center"> <p>NºEscritura</p> 
					
						</th>
						<th class="text-center">Avance</th>
						<th class="text-center th_medium">Trámite</th>
						<th class="text-center">Total de Operación</th>
						<th class="text-center th_medium">Observaciones</th>
						<th class="text-center">Detalles</th>

					</tr>
				</thead>
				<tbody class="table-hover">
					
					@foreach ($cases_services as $case_service)
    					<tr>
    						<td class="text-center"> {{ $case_service->id }} </td>
                			<td class="text-center"> {{ $case_service->N_write}} </td>
    						<td class="text-center"> {{ $case_service->progress }} %</td>
    						<td class="text-center"> {{ $case_service->service->name }} </td>
    						<td class="text-center"> ${{ $case_service->budget->total }} </td>
    						<td class="text-center"> {{ $case_service->observations }} </td>
    						<td class="text-center"> 
    							<a class="budget-button button_normal" href="{{route('Show_Case_path',$case_service->id) }}"> 
    								<img class="title_icon" src="{{ asset('img/icons/system/detalle_de_Tramite.ico') }}" alt="Detalles">
                      				<p>Detalles</p>
    							</a>
    						</td>
    					</tr>
					@endforeach
				</tbody>
				</table>
	</div>

<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script>
	
</script>

@stop