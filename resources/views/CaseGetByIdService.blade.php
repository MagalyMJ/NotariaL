@extends('layouts.homedefault')

@section('content')
<!-- Mostrara Todos los Casos Activos del servicio-Post  obtenido -->


	<div class="block_container">

		<h1>{{ $service->name }}</h1>
			<table class="table-fill">
				<thead>
					<tr>
						<th class="text-left">Nº Escritura</th>
						<th class="text-left">Avance</th>
						<th class="text-left">Cliente</th>
						<th class="text-left">Observaciones</th>

					</tr>
				</thead>
				<tbody class="table-hover">
					
					@foreach ($cases_services as $case_service)
					<a href="{{url('servicio/'.$service->id.'/caso/'.$case_service->id)}}">
    					<tr>
    						<td class="text-center"> {{ $case_service->id }} </td>
    						<td class="text-center"> {{ $case_service->progress }} %</td>
							<td class="text-center"> 
								@foreach($case_service->customer->all() as $customerCase )
    								{{ $customerCase->name." ".$customerCase->fathers_last_name." ".$customerCase->mothers_last_name }} 
    								<br>
								@endforeach
							</td>
    						<td class="text-center"> {{ $case_service->observations }} </td>
    					</tr>
    				</a>
					@endforeach
				</tbody>
				</table>

			<div>
				  <a class="menu_service_link" href="{{url('nuevo/'.$service->id )}} "> Nuevo Caso </a>
			</div>
			</div>

<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script>
	
</script>

@stop
