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
	<!-- Mostratos el costo de un Avalúo Comercial registrado para este servicio lo ponemos en el input por si es requerido -->
	<label for="">Avalúo Comercial: ${{$Budget->case_service->service->findExpeseCostByName('Avalúo Comercial')}}</label> 
	<input name="avaluo_comercial"  class="input long" id="avaluo_comercial" type="checkbox" value="{{$Budget->case_service->service->findExpeseCostByName('Avalúo Comercial')}}" />
	<!-- Este es un dato calculado en base al valor de operacion solo mostramos el valor actualmente registrado -->
	<label for="">ISABI: ${{$Budget->isabi}}</label> 
	<input name="isabi"  class="input long" id="isabi" type="hidden" value="" />
	<!-- Para que muestre el ISR actualmente registrado y modificarlo -->
	<label for="">ISR: ${{$Budget->isr}}</label> 
	<input name="isr"  class="input long" id="isr" type="number" step="0.01"  value="{{$Budget->isr}}" />
	<!-- Mostramos el costo que tienen los Gastos de Registro Para este Servicio -->
	<label for="">Gastos de Registro: ${{$Budget->case_service->service->findExpeseCostByName('Gastos de Registro')}}</label> 
	<input name="gastos_registro"  class="input long" id="gastos_registro" type="hidden" value="{{$Budget->case_service->service->findExpeseCostByName('Gastos de Registro')}}" />
	<!-- !"$%!%"$ No podemos mostrar el numero de registros efectuados poque se combianan junto con los registros de hipoeteca-->
	<label for="">Nº Propiedades: </label> 
	<input name="ngastos_resgistro"  class="input long" id="ngastos_resgistro" type="number" value="" />
	<!-- en este servicio tambien se pueden registrar las cancelaciones de hipoteca -->
	<label for="">Registro de Cacelacion de Hipotecas: ${{$Budget->case_service->service->findExpeseCostByName('Cacelacion de Hipotecas')}}</label> 
	<input name="cancelacion_hipoteca"  class="input long" id="cancelacion_hipoteca" type="checkbox" value="{{$Budget->case_service->service->findExpeseCostByName('Cacelacion de Hipotecas')}}" />
	<label for="">Nº Hipotecas Canceladas: </label> 
	<input name="ncancelacion_hipoteca"  class="input long" id="ncancelacion_hipoteca" type="number" value="" />
	
@stop