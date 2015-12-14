@extends('Budget.NewEditBuget')
@section('SpecialInputs') 

	<!--  El costo de honorarios es un valor fijo para este servicio Pero entre 3 opcciones diferentes -->
	 <label for="" class="check">Cancelacion de Infonavit: ${{$Budget->case_service->service->findExpeseCostByName('Honorarios Por Cancelacion Infonavit')}} </label> 
	 <input name="honorarios"  class="input" id="honorarios" type="radio" value="{{$Budget->case_service->service->findExpeseCostByName('Honorarios Por Cancelacion Infonavit')}}" 
	 @if($Budget->fee == $Budget->case_service->service->findExpeseCostByName('Honorarios Por Cancelacion Infonavit') ){{ "checked" }} @endif/>
	 
	 <label for="" class="check">Persona Fisica: ${{$Budget->case_service->service->findExpeseCostByName('Honorarios Por Persona Fisica')}} </label> 
	 <input name="honorarios"  class="input" id="honorarios" type="radio" value="{{$Budget->case_service->service->findExpeseCostByName('Honorarios Por Persona Fisica')}}" 
	 @if($Budget->fee == $Budget->case_service->service->findExpeseCostByName('Honorarios Por Persona Fisica') ){{ "checked" }} @endif/>

	 <label for="" class="check">Cancelacion de Banco: ${{$Budget->case_service->service->findExpeseCostByName('Honorarios Por Cancelacion Banco')}} </label> 	 
	 <input name="honorarios"  class="input" id="honorarios" type="radio" value="{{$Budget->case_service->service->findExpeseCostByName('Honorarios Por Cancelacion Banco')}}" 
	 @if($Budget->fee == $Budget->case_service->service->findExpeseCostByName('Honorarios Por Cancelacion Banco') ){{ "checked" }} @endif/>

	<!-- Para que muestre el ISNJIN actualmente registrado y modificarlo -->
	 <label for="">ISNJIN: ${{$Budget->isnjin}}</label> 
	 <input name="isnjin"  class="input medium" id="isnjin" type="number" step="0.01"  value="{{$Budget->isnjin}}" />
	<!-- Mostramos el costo que tienen los Gastos de Registro Para este Servicio -->
	<label for="">Gastos de Registro: ${{$Budget->case_service->service->findExpeseCostByName('Gastos de Registro')}}</label> 
	<input name="gastos_registro"  class="input medium" id="gastos_registro" type="hidden" value="{{$Budget->case_service->service->findExpeseCostByName('Gastos de Registro')}}" />
	<!-- Por default se tieen que registrar por eso el value es 1-->
	<label for="">Nº Registros: 1 </label> 
	<input name="ngastos_resgistro"  class="input medium" id="ngastos_resgistro" type="hidden" value="1" />	
@stop