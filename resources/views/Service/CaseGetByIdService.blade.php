@extends('layouts.homedefault')

@section('content')
<!-- Mostrara Todos los Casos Activos del servicio-Post  obtenido 
	Parametros: Objeto Service encotrado por id, Array CaseService filtrado por atributo service_id,
-->
	<div class="block_container">
		
		<section class="title_continer">
			<img class="title_icon" src="{{ asset($service->icon_path) }}" alt=""> 
			<h1>{{ $service->name }}</h1>
		</section>
		
		<section class = "action_buttons">
			
				  <a class="button button_normal" href="{{route('Select_Customers_toCase',$service->id) }}">
					<img class="title_icon" src="{{ asset('img/icons/system/nuevotramite.ico') }}" alt="Nuevo Tramite">
				  	<p>Nuevo Trámite</p>
				  </a>
				  
		</section>
			<table class="table-fill">
				<thead>
					<tr>
						<th class="text-center"> Nº Trámite
						<!-- Buscador por Folio -->
						{!! Form::open(array('route' =>array('service_show_path',$service->id ),'method' => 'Get','class' => 'form_search')) !!}
							
							{!! Form::number('id',null,['class' => 'form_input_search small' ,'placeholder' => 'Id' ]) !!}
							
						{!! Form::close() !!}
						</th>
						<th class="text-center"> Nº Escritura 
						<!-- Buscador por Numero de Escritura -->
						{!! Form::open(array('route' =>array('service_show_path',$service->id ),'method' => 'Get','class' => 'form_search')) !!}
							
							{!! Form::number('N_write',null,['class' => 'form_input_search small' ,'placeholder' => 'Nº Escritura' ]) !!}
							
						{!! Form::close() !!}
						</th>
						<th class="text-center">Avance</th>
						<th class="text-center th_big"> Cliente
						<!-- Buscador por el nombre de algun cliente relacionado -->
						{!! Form::open(array('route' =>array('service_show_path',$service->id ),'method' => 'Get','class' => 'form_search')) !!}
							
							{!! Form::text('FullName_write',null,['class' => 'form_input_search th_medium' ,'placeholder' => 'Nombre o Apellido' ]) !!}
							
						{!! Form::close() !!}

						</th>
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
							<td class="text-center"> 
								@foreach($case_service->customer->all() as $customerCase )
    								{{ $customerCase->name." ".$customerCase->fathers_last_name." ".$customerCase->mothers_last_name }} 
    								<br>
								@endforeach
							</td>
    						<td class="text-center"> ${{ $case_service->budget->total }} </td>
    						<td class="text-center"> {{ $case_service->observations }} </td>
    						<td class="text-center"> 
    						<a class="budget-button button_normal" href="{{route('Show_Case_path',$case_service->id) }}"> 
								<img class="title_icon" src="{{ asset('img/icons/system/detalle_de_Tramite.ico') }}" alt="Detalles">
        						<p>Detalles</p>
    						</a></td>
    					</tr>

					@endforeach
				</tbody>
				</table>
			</div>

<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script>
	
</script>

@stop
