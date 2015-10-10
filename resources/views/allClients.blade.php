@extends('layouts.homedefault')

@section('content')
<!-- Mostrara Todos los Casos Activos del servicio-Post  obtenido -->


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
	
		
			<div>
				  <a class="menu_service_link" href="{{url('cliente/nuevo')}}"> Nuevo cliente </a>
				  <input id="new_case_service" name="customers" type="submit" onClick="newCase()" value="Crear Caso" class="input budget-button">
				<!--   <a class="menu_service_link" onClick="newCase" href="{{url('crearcaso/'.$id_service)}}"> Crear Caso </a> 	 -->	   
			</div>
	</div>
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script>



function newCase(){
	var id_service = "<?php echo $id_service; ?>" ;
	var customers_selected = new Array();

	$("input:checkbox[name=select]:checked").each(function(){
    	customers_selected.push($(this).val()); 	
	});

	document.getElementById("customers_selected").value = customers_selected; 

	

	// var customers =  customers_selected;
	//    $.ajax({
 //                    url: 'nuevo/crearcaso/' + id_service ,
 //                    type: 'POST',
 //                    data: { customers },
 //                    dataType: 'json',
                    
 //                    success: function(info){
 //                        console.log(info);
 //                    }

 //                });

	document.getElementById("select_customers").action = "crearcaso/" + id_service ;

	document.getElementById("select_customers").submit(); 
}



	
</script>


@stop