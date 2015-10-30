@extends('Budget.NewEditBuget')
@section('SpecialInputs') 

<!--  El costo de honorarios es un valor fijo para este servicio -->
 <label for="">Honorarios: ${{$Budget->case_service->service->findExpeseCostByName('Honorarios')}} </label> 
 <input name="honorarios"  class="input long" id="honorarios" type="hidden" autocomplete="off" value="{{$Budget->case_service->service->findExpeseCostByName('Honorarios')}}" />
<!-- Para que muestre el ISNJIN actualmente registrado y modificarlo -->
 <label for="">ISNJIN: ${{$Budget->isnjin}}</label> 
 <input name="isnjin"  class="input long" id="isnjin" type="number" step="0.01"  value="{{$Budget->isnjin}}" />
	
@stop