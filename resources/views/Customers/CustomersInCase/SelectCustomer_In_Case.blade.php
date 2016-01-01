@extends('layouts.homedefault')

@section('content')
<!-- Parametros: Array Customers, $id_caseService, -->
	<div class="block_container">
	<section class="title_continer">
		<img class="title_icon" src="{{ asset('img/icons/system/selectcustomer.ico') }}" alt=""> 
		<h2 class="title">Seleccionar Cliente para un Tramite Existente</h2>
	</section>	
	<section class = "action_buttons">
		<a class="input budget-button button_normal" href="{{route('New_Customer_inCase',$id_caseService) }}"> Nuevo cliente </a>
		<input id="more_cusotmers_inThis" name="customers" type="submit" onClick="more_customers_inThisCase()" value="Asignar al Tramite" class="input budget-button">				  
		<a class="input budget-button button_normal" href="{{route('Show_Case_path',$id_caseService) }}"> Cancelar </a>
	</section>
			<table id="customers_Table" class="table-fill">
				<thead>
					<tr>

						<th class="text-center">Selcted</th>
						<th class="text-center">Id</th>
						<th class="text-center th_medium">Nombre
								<!-- Buscador por Nombre Completo -->
							{!! Form::open(array('route' => array('Select_customer_InExisting_Case' , $id_caseService) ,'method' => 'Get','class' => 'form_search')) !!}

								{!! Form::text('FullName_write',null,['class' => 'form_input_search th_medium' ,'placeholder' => 'Nombre o Apellidos' ]) !!}
						
							{!! Form::close() !!}
						</th>
						<th class="text-center">RFC</th>
					</tr>
				</thead>
				<tbody id="body_table" class="table-hover">
				
				<form  id="select_customers" method='POST' >
				 {{csrf_field()}}

					@foreach ($customers as $customer)
    					<tr>
    						<td><input name="select" type="checkbox" value="{{ $customer->id }}"></td>
    						<td name="id" class="text-center"> {{ $customer->id }} </td>
    						<td class="text-center"> {{ $customer->name .' '.$customer->fathers_last_name }} </td>
    						<td class="text-center"> {{ $customer->rfc }} </td>
    					</tr>
					@endforeach
					
					 <input id="customers_selected" name="customers_selected" type="hidden" value="">
				  
				</form>
			</tbody>
		</table>
	
	</div>
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script>



function more_customers_inThisCase(){
	var id_caseService = "<?php echo $id_caseService; ?>" ;

	var customers_selected = new Array();

	$("input:checkbox[name=select]:checked").each(function(){
    	customers_selected.push($(this).val()); 	
	});

	document.getElementById("customers_selected").value = customers_selected; 

	document.getElementById("select_customers").action = "{{route('Update_customer_InExisting_Case',$id_caseService) }}";

	document.getElementById("select_customers").submit(); 
}



	
</script>


@stop