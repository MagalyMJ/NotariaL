@extends('Budget.NewEditBuget')
@section('SpecialInputs') 

<!--  El costo de honorarios es un valor fijo para este servicio e inculle un costo por horas extra -->
 <label for="">Honorarios: ${{$Budget->case_service->service->findExpeseCostByName('Honorarios')}} </label> 
 <input name="honorarios"  class="input long" id="honorarios" type="hidden" value="{{$Budget->case_service->service->findExpeseCostByName('Honorarios')}}" />
 <label for="">Honorarios Por Hora Extra: ${{$Budget->case_service->service->findExpeseCostByName('Honorarios Por Hora Extra')}} </label> 
 <input name="hora_extra"  class="input long" id="hora_extra" type="checkbox" autocomplete="off" value="{{$Budget->case_service->service->findExpeseCostByName('Honorarios Por Hora Extra')}}" />
 <label for="">Nº Hora Extra: {{$Budget->n_extra_hours}} </label> 
 <input name="nhora_extra"  class="input long" id="nhora_extra" type="number" autocomplete="off" value="{{$Budget->n_extra_hours}}" />
<!-- Para que muestre el ISNJIN actualmente registrado y modificarlo -->
<label for="">ISNJIN: ${{$Budget->isnjin}}</label> 
<input name="isnjin"  class="input long" id="isnjin" type="number" step="0.01"  value="{{$Budget->isnjin}}" />
	
@stop