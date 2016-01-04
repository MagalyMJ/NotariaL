@extends('layouts.homedefault')

@section('content')
<!-- Mostrara Todos los Clientes Activos
	Parametros: $customers Customer::Array 
-->
	<div class="block_container">

		<section class="title_continer">
      		<img class="title_icon" src="{{ asset('img/icons/system/clientes.ico') }}" alt=""> 
     	 	<h1>Clientes</h1>
    	</section>

		<section class = "action_buttons">
			
				  <a class="budget-button button_normal" href="{{ route('Create_Customer') }}">
				  	<img class="title_icon" src="{{ asset('img/icons/system/registrocliente.ico') }}" alt="Nuevo Cliente">
              		<p>Nuevo Cliente</p> 
				  </a>
				  
		</section>
			<table class="table-fill">
				<thead>
					<tr>
						
						<th class="text-center th_small">Id Cliente</th>
						<th class="text-center th_medium"> Nombre Completo
							<!-- Buscador por Nombre Completo -->
						{!! Form::open(array('route' =>'Customer_List','method' => 'Get','class' => 'form_search')) !!}

							{!! Form::text('FullName_write',null,['class' => 'form_input_search th_medium' ,'placeholder' => 'Nombre o Apellidos' ]) !!}
						
						{!! Form::close() !!}
						</th>
						<th class="text-center">Tramites</th>

					</tr>
				</thead>
				<tbody class="table-hover">
					
					@foreach ($customers as $customer)
    					<tr>
    						<td class="text-center"> {{ $customer->id }} </td>
                			<td class="text-center"> {{ $customer->name." ".$customer->fathers_last_name." ".$customer->mothers_last_name }} </td>
    						<td class="text-center"> 
    							<a class="budget-button button_normal" href="{{ route('Customer_Show_path',$customer->id ) }}">
    								<img class="title_icon" src="{{ asset('img/icons/system/nuevotramite.ico') }}" alt="Tramites">
				  					<p>Tramites</p>
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