@extends('Budget.NewEditBuget')
@section('SpecialInputs') 

<script> 
window.onload = function(){
	Pfisica();
	PMoral();
}

function Pfisica(){ 
// Cuando se trata de una persona Fisica, no lleva registro 
	var Hf= document.getElementById("honorariosFisica");
   	if( Hf.checked ){
   		document.getElementById("labelGastos_registro").innerHTML = 'Gastos de Registro: 0 por ser Persona Fisica'
   		document.getElementById("labelNGastos_registro").innerHTML = 'Nº Registros: 0'
   		document.getElementById("gastos_registro").value = 0 ;
   	}

   }
   function PMoral(){ 
   	var cost = "<?php echo $Budget->case_service->service->findExpeseCostByName('Gastos de Registro'); ?>" ;
	var Hf= document.getElementById("honorariosMoral");
   	if( Hf.checked ){
   		document.getElementById("labelGastos_registro").innerHTML = 'Gastos de registro: $' + cost
   		document.getElementById("labelNGastos_registro").innerHTML = 'Nº Registros: 1 '
   		document.getElementById("gastos_registro").value = cost;
   	}
   }
</script>

	<!--  El costo de honorarios es un valor fijo para este servicio Pero entre 2 opcciones diferentes -->
	 <label for="" class="check">Honorarios Por Persona Moral: ${{$Budget->case_service->service->findExpeseCostByName('Honorarios Por Persona Moral')}} </label> 
	 <input name="honorarios" onclick="PMoral()" class="input" id="honorariosMoral" type="radio" value="{{$Budget->case_service->service->findExpeseCostByName('Honorarios Por Persona Moral')}}" 
	 @if($Budget->fee == $Budget->case_service->service->findExpeseCostByName('Honorarios Por Persona Moral') ){{ "checked" }} @endif/>
	 <label for="" class="check">Honorarios Por Persona Fisica: ${{$Budget->case_service->service->findExpeseCostByName('Honorarios Por Persona Fisica')}} </label> 
	 <input name="honorarios" onclick="Pfisica()" class="input" id="honorariosFisica" type="radio" value="{{$Budget->case_service->service->findExpeseCostByName('Honorarios Por Persona Fisica')}}" 
	 @if($Budget->fee == $Budget->case_service->service->findExpeseCostByName('Honorarios Por Persona Fisica') ){{ "checked" }} @endif/>
	<!-- Mostratos el costo de un Gestoria de Escritura registrado para este servicio lo ponemos en el input por si es requerido -->
	<label for="" class="check">Gestoria de Escritura: ${{$Budget->case_service->service->findExpeseCostByName('Gestoria de Escritura')}}</label> 
	<input name="gestoria"  class="input" id="gestoria" type="checkbox" value="{{$Budget->case_service->service->findExpeseCostByName('Gestoria de Escritura')}}" 
	@if($Budget->writing_management == $Budget->case_service->service->findExpeseCostByName('Gestoria de Escritura') ){{ "checked" }} @endif />
	<!-- Para que muestre el ISNJIN actualmente registrado y modificarlo -->
	 <label for="">ISNJIN: ${{$Budget->isnjin}}</label> 
	 <input name="isnjin"  class="input medium" id="isnjin" type="number" step="0.01"  value="{{$Budget->isnjin}}" />
	<!-- Mostramos el costo que tienen los Gastos de Registro Para este Servicio -->
	<label for="gastos_registro" id="labelGastos_registro" ></label> 
	<input name="gastos_registro" class="input medium" id="gastos_registro" type="hidden" value="" />
	<!-- Por default se tieen que registrar por eso el value es 1-->
	<label for="" id="labelNGastos_registro"></label> 
	<input name="ngastos_resgistro"  class="input medium" id="ngastos_resgistro" type="hidden" value="1" />	
@stop
