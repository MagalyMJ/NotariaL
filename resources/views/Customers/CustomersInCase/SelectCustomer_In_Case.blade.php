@extends('layouts.homedefault')

@section('content')
<!-- Parametros: Array Customer, $service->id as $id_service, -->
	<div class="block_container">

			<table id="customers_Table" class="table-fill">
				<thead>
					<tr>

						<th class="text-left">selcted</th>
						<th class="text-left">id</th>
						<th class="text-left">Nombre</th>
						<th class="text-left">rfc</th>
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
	
		
			<section class = "action_buttons">
				  <a class="input budget-button button_normal" href="{{route('New_Customer_inCase',$id_caseService) }}"> Nuevo cliente </a>
				  <input id="more_cusotmers_inThis" name="customers" type="submit" onClick="more_customers_inThisCase()" value="Asignar al Caso" class="input budget-button">				  
				  <a class="input budget-button button_normal" href="{{route('Show_Case_path',$id_caseService) }}"> Cancelar </a>
			</section>
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