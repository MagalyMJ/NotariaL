@extends('Budget.NewEditBuget')
@section('SpecialInputs') 

<!--  El costo de honorarios es un valor fijo para este servicio y puede incrementar en base alas hojas extra-->
 <label for="">Honorarios: ${{$Budget->case_service->service->findExpeseCostByName('Honorarios')}} </label> 
 <input name="honorarios"  class="input long" id="honorarios" type="hidden" autocomplete="off" value="{{$Budget->case_service->service->findExpeseCostByName('Honorarios')}}" />
 <label for="">Honorarios Por Hoja Extra: ${{$Budget->case_service->service->findExpeseCostByName('Honorarios Por Hoja Extra')}} </label> 
 <input name="honorarios_HojaExtra"  class="input long" id="honorarios_HojaExtra" type="checkbox" autocomplete="off" value="{{$Budget->case_service->service->findExpeseCostByName('Honorarios Por Hoja Extra')}}" />
 <label for="">Nº Hojas Extra: {{$Budget->n_extra_paper}} </label> 
 <input name="nhonorarios_HojaExtra"  class="input long" id="nhonorarios_HojaExtra" type="number" autocomplete="off" value="{{$Budget->n_extra_paper}} " />

@stop