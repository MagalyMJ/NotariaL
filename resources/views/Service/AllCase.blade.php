@extends('layouts.homedefault')

@section('content')
<!-- Mostrara Todos los Casos Activos 
	Parametros: Objeto Service encotrado por id, Array CaseService filtrado por atributo service_id,
-->
	<div class="block_container">

		<h1> Tramites </h1>
			<table class="table-fill">
				<thead>
					<tr>
						<th class="text-center"> 
							<p>NºFolio</p> 
						<!-- Buscador por Folio -->
						{!! Form::open(array('route' =>'show_all_case','method' => 'Get','class' => 'form_search')) !!}
							<div class="navbar_seach">
								{!! Form::number('id',null,['class' => 'form_input_search' ,'placeholder' => 'Id' ]) !!}
							</div>
						{!! Form::close() !!}
						</th>
						<th class="text-center"> <p> NºEscritura</p> 
						<!-- Buscador por Numero de Escritura -->
						{!! Form::open(array('route' =>'show_all_case','method' => 'Get','class' => 'form_search')) !!}
							<div class="navbar_seach">
								{!! Form::number('N_write',null,['class' => 'form_input_search' ,'placeholder' => 'Nº Escritura' ]) !!}
							</div>
						{!! Form::close() !!}
						</th>
						<th class="text-center">Avance</th>
						<th class="text-center th_big">Cliente</th>
						<th class="text-center">Trámite</th>
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
    						<td class="text-center"> {{ $case_service->service->name }} </td>
    						<td class="text-center"> ${{ $case_service->budget->total }} </td>
    						<td class="text-center"> {{ $case_service->observations }} </td>
    						<td class="text-center"> <a class="input budget-button button_normal" href="{{route('Show_Case_path',$case_service->id) }}">Detalles</a></td>
    					</tr>
    				</a>
					@endforeach
				</tbody>
				</table>

			<section class = "action_buttons">
				  
			</section>
			</div>
@stop