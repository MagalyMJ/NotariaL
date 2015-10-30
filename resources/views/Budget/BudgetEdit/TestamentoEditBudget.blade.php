@extends('Budget.NewEditBuget')
@section('SpecialInputs') 

<!--  El costo de honorarios es de 4500 para este servicio -->

 <label for="">Honorarios: ${{$Budget->case_service->service->findExpeseCostByName('Honorarios')}} </label> 
 <input name="honorarios"  class="input long" id="honorarios" type="hidden" autocomplete="off" value="{{$Budget->case_service->service->findExpeseCostByName('Honorarios')}}" />

@stop