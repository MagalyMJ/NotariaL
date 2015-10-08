@extends('layouts.homedefault')

@section('content')
<!-- Mostrara Todos los Casos Activos del servicio-Post  obtenido -->


	<div class="block_container">

			<table class="table-fill">
				<thead>
					<tr>

						<th class="text-left">selcted</th>
						<th class="text-left">id</th>
						<th class="text-left">Nombre</th>
						<th class="text-left">rfc</th>
					</tr>
				</thead>
				<tbody class="table-hover">
					
					@foreach ($customers as $customer)
    					<tr>
    						<td><input type="checkbox"></td>
    						<td class="text-center"> {{ $customer->id }} </td>
    						<td class="text-center"> {{ $customer->name .' '.$customer->fathers_last_name }} </td>
    						<td class="text-center"> {{ $customer->rfc }} </td>
    					</tr>
					@endforeach
				</tbody>
				</table>
	
		
			<div>
				  <a class="menu_service_link" href="{{url('cliente/nuevo')}}"> Nuevo cliente </a>
				  <a class="menu_service_link" href="{{url('nuevo/servicio/'.$id_service)}}"> Crear Caso </a>		  
			</div>
	</div>



@stop