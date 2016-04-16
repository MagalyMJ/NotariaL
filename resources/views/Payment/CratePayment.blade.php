@extends('layouts.homedefault')

@section('content')

	<div class="block_container">
		<h1>Generar Pago</h1>
		<h2>Para de Folio Nº {{$ServiceCase->id}}</h2>
		<form id="New_Payment" action="{{route('Payment_Store',$ServiceCase->id) }}" method='post' class="form_data">  
   			{{csrf_field()}}
   			<div class="form_data_payment formborder form_data_general">
          <div>
   			<label for="name">Nombre</label> 
        <input name="name" class="input long" id="name" type="text" autocomplete="off" value="" />
        
        <label for="concept">Concepto</label> 
        <textarea rows="4" cols="50" name="concept" id="concept" class="message_area"> </textarea> 
      
			<label for="payment_type" class="check">Modo de Pago </label>
      		<select id="payment_type" name="payment_type" form="New_Payment" >
        		<option value="1">Efectivo</option>
        		<option value="2">Transferencia</option>
        		<option value="3">Cheque</option>
      		</select>

      		<label for="amount_to_pay">Monto</label> 
      		<input name="amount_to_pay" class="input" id="amount_to_pay" type="number" step="0.01" autocomplete="off" value="" />
     </div>
      <section class = "action_buttons">  
      	<button type="submit"  class="budget-button button_normal" style=" margin: 0px;"> 
          <img class="title_icon" src="{{ asset('img/icons/system/check.ico') }}" alt="Guardar">
          <p>Guardar</p>
        </button>

        <a class="budget-button button_normal" href="{{route('Show_Case_path',$ServiceCase->id) }}" style=" margin-top: 0px;"> 
          <img class="title_icon" src="{{ asset('img/icons/system/cancel.ico') }}" alt="Cancelar">
          <p> Cancelar </p>
       </a>
      </section>
   </div>
   </form>
	</div>

@stop