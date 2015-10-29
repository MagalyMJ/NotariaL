 @extends('layouts.homedefault')

@section('content') 

<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script>
 
function tipoPago(Pago){
  switch(Pago) {
    case 'efectivo':
       return 1
        break;
    case 'transferencia':
        return 2
        break;
    case 'cheque' :
    return 3
        break;
  }
}

 $( document ).ready(function() {
   //cagamos los datos previos  
   // var payment_type = "<?php echo $Budget->payment_type; ?>" ;
   // var invoiced = "<?php echo $Budget->invoiced; ?>" ;
   // var approved = "<?php echo $Budget->approved; ?>" ;
   // var user_id = "<?php echo $Budget->user_id; ?>" ;

   // document.forms['Edit_budget']['payment_type'].value = tipoPago(payment_type)
   // document.forms['Edit_budget']['invoiced'].value = invoiced
   // document.forms['Edit_budget']['approved'].value = approved
   // document.forms['Edit_budget']['user_id'].value = user_id
});

</script>
<div class="block_container">

  <h1>Presupuesto de Escritura Nº {{ $Budget->case_service->id}}</h1>
  <h1>{{ $Budget->case_service->service->name}}</h1>

 <div class="form_container"> 
 <form id="Edit_budget" action="{{route('UpdateBudget',$Budget->id) }}" method='post' class="form_data aling_block">  
   {{csrf_field()}}

  
      <!-- Inpust que se Quitaran dependiendo del servicio -->
 
      @foreach($Budget->case_service->service->expenses as $Expense )

      <label for="">{{ $Expense->expense_name .': '.$Expense->pivot->cost }} </label> 
      <input name="{{ $Expense->pivot->input_name }}" class="input long" id="" type="{{ $Expense->pivot->type_input }}" autocomplete="off" value="{{ $Expense->pivot->cost }}" />

                    
      @endforeach

  <!-- Inputs por default de un presupesto -->
      
      <label for="discount">Descuento de Honorarios</label> 
      <input name="discount"  class="input long" id="discount" type="text" autocomplete="off" value="" />
      
      <label for="travel_expenses">Gastos de Viaje</label> 
      <input name="travel_expenses"  class="input long" id="travel_expenses" type="text" autocomplete="off" value="" />
      
      <label for="miscellaneous_expense">Varios</label> 
      <input name="miscellaneous_expense"  class="input long" id="miscellaneous_expense" type="text" autocomplete="off" value="" />
      
      <label for="advance_payment">Anticipo</label> 
      <input name="advance_payment" class="input long" id="advance_payment" type="text" autocomplete="off" value="" />

      <label for="surcharges">Recargos</label> 
      <input name="surcharges" class="input long" id="surcharges" type="text" autocomplete="off" value="" />
     
<!-- Inputs por default de un presupesto -->
      <label for="payment_type">Forma de Pago </label>
      <select id="payment_type" name="payment_type" form="Edit_budget" >
        <option value="1">Efectivo</option>
        <option value="2">Transferencia</option>
        <option value="3">Cheque</option>
      </select>

      <label for="invoiced">Facturado</label>
      <select id="invoiced" onchange="sText()" name="invoiced" form="Edit_budget"  >
        <option value="0">NO</option>
        <option value="1">SI</option>
      </select>


      <input type="submit" value="Guardar" class="input budget-button">
      <a class="input budget-button" href="{{route('Show_Case_path',$Budget->case_service->id) }}"> Cancelar </a>

    </form>
  </div> 
 </div> 


 @stop