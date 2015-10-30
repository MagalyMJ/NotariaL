@extends('Budget.NewEditBuget')
@section('SpecialInputs') 

	<!--  El costo de honorarios es determinado por el vaor de operacion  
	Mostramos el valor de onorarios actualmete registrados -->
	<label for="">Honorarios: ${{$Budget->fee}} </label> 
	<input name="honorarios"  class="input long" id="honorarios" type="hidden" value="" />
	<!-- Para que muestre el valor de operacion actualmente registrado y modificarlo -->
	<label for="">Valor de Operación: ${{$Budget->operation_value}} </label> 
	<input name="valor_operacion"  class="input long" id="valor_operacion" type="number" step="0.01" value="{{$Budget->operation_value}}" />
	<!-- Mostratos el costo de un Avaluo catastral registrado para este servicio lo ponemos en el input por si es requerido -->
	<label for="">Avalúo Catastral: ${{$Budget->case_service->service->findExpeseCostByName('Avalúo Catastral')}}</label> 
	<input name="avaluo_catastral"  class="input long" id="avaluo_catastral" type="checkbox" value="{{$Budget->case_service->service->findExpeseCostByName('Avalúo Catastral')}}" />
	<!-- Mostratos el costo de un Gestoria de Escritura registrado para este servicio lo ponemos en el input por si es requerido -->
	<label for="">Gestoria de Escritura: ${{$Budget->case_service->service->findExpeseCostByName('Gestoria de Escritura')}}</label> 
	<input name="gestoria"  class="input long" id="gestoria" type="checkbox" value="{{$Budget->case_service->service->findExpeseCostByName('Gestoria de Escritura')}}" />
	<!-- Para que muestre el ISNJIN actualmente registrado y modificarlo -->
	<label for="">ISNJIN: ${{$Budget->isnjin}}</label> 
	<input name="isnjin"  class="input long" id="isnjin" type="number" step="0.01"  value="{{$Budget->isnjin}}" />
	<!-- Mostramos el costo que tienen los Certificados Para este Servicio -->
	<label for="">Certificados: ${{$Budget->case_service->service->findExpeseCostByName('Certificados')}}</label> 
	<input name="certificados"  class="input long" id="certificados" type="hidden" value="{{$Budget->case_service->service->findExpeseCostByName('Certificados')}}" />
	<!-- Para que muestre el NºCertificados actualmente registrado y modificarlo -->
	<label for="">NºCertificados: {{$Budget->n_certificates}}</label> 
	<input name="ncertificados"  class="input long" id="ncertificados" type="number" value="{{$Budget->n_certificates}}" />
	<!-- Mostramos el costo que tienen los Gastos de Registro Para este Servicio -->
	<label for="">Gastos de Registro: ${{$Budget->case_service->service->findExpeseCostByName('Gastos de Registro')}}</label> 
	<input name="gastos_registro"  class="input long" id="gastos_registro" type="hidden" value="{{$Budget->case_service->service->findExpeseCostByName('Gastos de Registro')}}" />
	<!-- Por default se tieen que registrar por eso el value es 1-->
	<label for="">Nº Registros: 1 </label> 
	<input name="ngastos_resgistro"  class="input long" id="ngastos_resgistro" type="hidden" value="1" />
	
@stop