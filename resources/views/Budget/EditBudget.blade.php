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
   var payment_type = "<?php echo $Budget->payment_type; ?>" ;
   var invoiced = "<?php echo $Budget->invoiced; ?>" ;
   var approved = "<?php echo $Budget->approved; ?>" ;
   var user_id = "<?php echo $Budget->user_id; ?>" ;

   document.forms['Edit_budget']['payment_type'].value = tipoPago(payment_type)
   document.forms['Edit_budget']['invoiced'].value = invoiced
   document.forms['Edit_budget']['approved'].value = approved
   document.forms['Edit_budget']['user_id'].value = user_id
});
 
 function sText(){
    if ( document.getElementById("invoiced").value == 1 ) {
      var IVA = 0.16
      var valorSinIVA = parseInt(document.getElementById("name").value)
      var valorIVA = Math.round((valorSinIVA+(valorSinIVA * IVA)) * 100) / 100 

    document.getElementById("show_cost").innerHTML = '$'+ valorIVA 

    document.getElementById("cost").value = valorIVA 
    
    }else{
       document.getElementById("show_cost").innerHTML = '$'+ parseInt(document.getElementById("name").value)
      document.getElementById("cost").value = document.getElementById("name").value
    }
  }

</script>
<div class="block_container">
 <div class="form_container"> 

 <form id="Edit_budget" action="{{route('UpdateBudget',$Budget->id) }}" method='post' class="form_data aling_block">  
   {{csrf_field()}}

      <label for="operation_value">Valor de Operacion</label> 
      <input name="operation_value" onBlur="sText();" class="input long" id="name" type="text" autocomplete="off" value="{{ $Budget->operation_value}}" />
      
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

      <label for="approved">Aprobado</label>
      <select id="approved" name="approved" form="Edit_budget" >
        <option value="0">NO</option>
        <option value="1">SI</option>
      </select>

      <label for="user_id">Encargado</label>
      <select id="user_id" name="user_id" form="Edit_budget" >
        @foreach ($users as $user)
         <option value="{{$user->id}}">{{ $user->name." ".$user->fathers_last_name }}</option>
        @endforeach
      </select>

      <h2>Costos Calculados</h2>
      <p>-----------------------</p>
      <p id="show_cost" value="">{{$Budget->cost}} </p>
      <input name="cost" id="cost" type="hidden"value="" />
      <p>-----------------------</p>
      

      <input type="submit" value="Guardar" class="input budget-button">

    </form>
  </div> 
 </div> 


 @stop