@extends('Budget.NewEditBuget')
@section('SpecialInputs') 

	<!--  El costo de honorarios es un valor fijo para este servicio Pero entre 3 opcciones diferentes -->
	 <label for="">Honorarios Por Cancelacion de Infonavit: ${{$Budget->case_service->service->findExpeseCostByName('Honorarios Por Cancelacion Infonavit')}} </label> 
	 <input name="honorarios"  class="input long" id="honorarios" type="radio" value="{{$Budget->case_service->service->findExpeseCostByName('Honorarios Por Cancelacion Infonavit')}}" />
	 <label for="">Honorarios Por Pernsona Fisica: ${{$Budget->case_service->service->findExpeseCostByName('Honorarios Por Pernsona Fisica')}} </label> 
	 <input name="honorarios"  class="input long" id="honorarios" type="radio" value="{{$Budget->case_service->service->findExpeseCostByName('Honorarios Por Pernsona Fisica')}}" />
	 <label for="">Honorarios Por Cancelacion de Banco: ${{$Budget->case_service->service->findExpeseCostByName('Honorarios Por Cancelacion Banco')}} </label> 
	 <input name="honorarios"  class="input long" id="honorarios" type="radio" value="{{$Budget->case_service->service->findExpeseCostByName('Honorarios Por Cancelacion Banco')}}" />
	<!-- Para que muestre el ISNJIN actualmente registrado y modificarlo -->
	 <label for="">ISNJIN: ${{$Budget->isnjin}}</label> 
	 <input name="isnjin"  class="input long" id="isnjin" type="number" step="0.01"  value="{{$Budget->isnjin}}" />
	<!-- Mostramos el costo que tienen los Gastos de Registro Para este Servicio -->
	<label for="">Gastos de Registro: ${{$Budget->case_service->service->findExpeseCostByName('Gastos de Registro')}}</label> 
	<input name="gastos_registro"  class="input long" id="gastos_registro" type="hidden" value="{{$Budget->case_service->service->findExpeseCostByName('Gastos de Registro')}}" />
	<!-- Por default se tieen que registrar por eso el value es 1-->
	<label for="">Nº Registros: 1 </label> 
	<input name="ngastos_resgistro"  class="input long" id="ngastos_resgistro" type="hidden" value="1" />	
@stop