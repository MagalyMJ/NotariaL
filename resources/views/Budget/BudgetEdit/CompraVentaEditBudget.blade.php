@extends('Budget.NewEditBuget')
@section('SpecialInputs') 

	<!--  El costo de honorarios es determinado por el vaor de operacion  
    Mostramos el valor de onorarios actualmete registrados -->
    <label for="" id="labelfee" >Honorarios: ${{$Budget->fee}} </label> 
    <input name="honorarios"  class="input medium" id="honorarios" type="hidden" value="" />
    <!-- Para que muestre el valor de operacion actualmente registrado y modificarlo -->
    <label for="">Valor de Operación: ${{$Budget->operation_value}} </label> 
    <input name="valor_operacion"  class="input medium" onkeyup="operationValue()" id="valor_operacion" type="number" step="0.01" value="{{$Budget->operation_value}}" />
    <!-- Mostratos el costo de un Avaluo catastral registrado para este servicio lo ponemos en el input por si es requerido -->
	<label for="" class="check" >Avalúo Catastral: ${{$Budget->case_service->service->findExpeseCostByName('Avalúo Catastral')}}</label> 
	<input name="avaluo_catastral"  class="input" id="avaluo_catastral" type="checkbox" value="{{$Budget->case_service->service->findExpeseCostByName('Avalúo Catastral')}}" 
	@if($Budget->property_valuation == $Budget->case_service->service->findExpeseCostByName('Avalúo Catastral') ){{ "checked" }} @endif />
	<!-- Mostratos el costo de un Avalúo Comercial registrado para este servicio lo ponemos en el input por si es requerido -->
	<label for="" class="check">Avalúo Comercial: ${{$Budget->case_service->service->findExpeseCostByName('Avalúo Comercial')}}</label> 
	<input name="avaluo_comercial"  class="input" id="avaluo_comercial" type="checkbox" value="{{$Budget->case_service->service->findExpeseCostByName('Avalúo Comercial')}}" 
	@if($Budget->commercial_appraisal == $Budget->case_service->service->findExpeseCostByName('Avalúo Comercial') ){{ "checked" }} @endif />
	<!-- Mostratos el costo de un Gestoria de Escritura registrado para este servicio lo ponemos en el input por si es requerido -->
	<label for="" class="check">Gestoria de Escritura: ${{$Budget->case_service->service->findExpeseCostByName('Gestoria de Escritura')}}</label> 
	<input name="gestoria"  class="input" id="gestoria" type="checkbox" value="{{$Budget->case_service->service->findExpeseCostByName('Gestoria de Escritura')}}" 
	@if($Budget->writing_management == $Budget->case_service->service->findExpeseCostByName('Gestoria de Escritura') ){{ "checked" }} @endif />
	<!-- Este es un dato calculado en base al valor de operacion solo mostramos el valor actualmente registrado -->
	<label for="">ISABI: ${{$Budget->isabi}}</label> 
	<input name="isabi"  class="input medium" id="isabi" type="hidden" value="" />
	<!-- Para que muestre el ISR actualmente registrado y modificarlo -->
	<label for="">ISR: ${{$Budget->isr}}</label> 
	<input name="isr"  class="input medium" id="isr" type="number" step="0.01"  value="{{$Budget->isr}}" />
	<!-- Mostramos el costo que tienen los Certificados Para este Servicio -->
	<label for="">Certificados: ${{$Budget->case_service->service->findExpeseCostByName('Certificados')}}</label> 
	<input name="certificados"  class="input medium" id="certificados" type="hidden" value="{{$Budget->case_service->service->findExpeseCostByName('Certificados')}}" />
	<!-- Para que muestre el NºCertificados actualmente registrado y modificarlo -->
	<label for="">NºCertificados: {{$Budget->n_certificates}}</label> 
	<input name="ncertificados"  class="input medium" id="ncertificados" type="number" value="{{$Budget->n_certificates}}" />
	<!-- Mostramos el costo que tienen los Gastos de Registro Para este Servicio -->
	<label for="">Gastos de Registro: ${{$Budget->case_service->service->findExpeseCostByName('Gastos de Registro')}}</label> 
	<input name="gastos_registro"  class="input medium" id="gastos_registro" type="hidden" value="{{$Budget->case_service->service->findExpeseCostByName('Gastos de Registro')}}" />
	<!-- Por default se tieen que registrar por eso el value es 1-->
	<label for="">Nº Registros: 1 </label> 
	<input name="ngastos_resgistro"  class="input medium" id="ngastos_resgistro" type="hidden" value="1" />
@stop