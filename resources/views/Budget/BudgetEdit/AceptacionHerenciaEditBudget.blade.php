@extends('Budget.NewEditBuget')
@section('SpecialInputs') 

<!--  El costo de honorarios es un valor fijo para este servicio -->
 <label for="">Honorarios: ${{$Budget->case_service->service->findExpeseCostByName('Honorarios')}} </label> 
 <input name="honorarios"  class="input medium" id="honorarios" type="hidden" value="{{$Budget->case_service->service->findExpeseCostByName('Honorarios')}}" />
<!-- Este es un gasto exclusivo de este servicio y va directo en la tabla de presupeusto -->
 <label for="">Edictos: ${{$Budget->case_service->service->findExpeseCostByName('Edictos')}} </label> 
 <input name="edictos"  class="input medium" id="edictos" type="hidden" value="{{$Budget->case_service->service->findExpeseCostByName('Edictos')}}" />

@stop