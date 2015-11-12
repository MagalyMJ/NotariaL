@extends('Service.Edit.EditCaseService')
@section('notices')

      	<label for="notices_one_date">Fecha de inicio de Registro (Priver aviso):{{$ServiceCase->notices_one_date}} </label> 
     	<input name="notices_one_date" class="input long" id="notices_one_date" type="date" value="{{$ServiceCase->notices_one_date}}"/> 
      	<label for="notices_two_date">Fecha de (Segundo aviso) Registrada:{{$ServiceCase->notices_two_date}} </label> 
     	<input name="notices_two_date" class="input long" id="notices_two_date" type="date" value="{{$ServiceCase->notices_two_date}}"/> 
		<label for="public_register">Fecha de Registro (registro publico):{{$ServiceCase->notices_two_date}} </label> 
     	<input name="public_register" class="input long" id="public_register" type="date" value="{{$ServiceCase->public_register}}"/> 

@stop