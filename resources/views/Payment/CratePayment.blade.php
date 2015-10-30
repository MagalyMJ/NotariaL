@extends('layouts.homedefault')

@section('content')

	<div class="block_container">
		<h1>hacer un pago </h1>
		<h2>Para de la Escritura Nº {{$ServiceCase->id}}</h2>
		<form id="New_Payment" action="{{route('Payment_Store',$ServiceCase->id) }}" method='post' class="form_data aling_block">  
   			{{csrf_field()}}
   			
   			<label for="name">Nombre</label> 
      		<input name="name" class="input long" id="name" type="text" autocomplete="off" value="" />
      
			<label for="payment_type">Forma de Pago </label>
      		<select id="payment_type" name="payment_type" form="New_Payment" >
        		<option value="1">Efectivo</option>
        		<option value="2">Transferencia</option>
        		<option value="3">Cheque</option>
      		</select>

      		<label for="amount_to_pay">Cantidad</label> 
      		<input name="amount_to_pay" class="input long" id="amount_to_pay" type="number" step="0.01" autocomplete="off" value="" />
      
      		<input type="submit" value="Guardar" class="input budget-button">
   	 	</form>

      <a class="input budget-button" href="{{route('Show_Case_path',$ServiceCase->id) }}"> Cancelar </a>

	</div>

@stop