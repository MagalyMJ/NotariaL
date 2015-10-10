@extends('layouts.homedefault')

@section('content')
<!-- Mostrara Todos los Casos Activos del servicio-Post  obtenido -->


	<div class="block_container">

		<h1></h1>
			<table class="table-fill">
				<thead>
					<tr>
						<th class="text-left">Nº Escritura</th>
						<th class="text-left">Cliente</th>
						<th class="text-left">Avance</th>
						<th class="text-left">Observaciones</th>

					</tr>
				</thead>
				<tbody class="table-hover">
					
					@foreach ($cases_services as $case_service)
    					<tr>
    						<td class="text-center"> {{ $case_service->id }} </td>
    						<td class="text-center"> {{ $case_service->budget->operation_value }} </td>
    						<td class="text-center"> {{ $case_service->budget->cost }} </td>
    						<td class="text-center"> {{ $case_service->budget->cost }} </td>
    					</tr>
					@endforeach
				</tbody>
				</table>

			<div>
				  <a class="menu_service_link" href="{{url('nuevo/'.$service_id)}} "> Nuevo Caso </a>
			</div>
			</div>

@stop
