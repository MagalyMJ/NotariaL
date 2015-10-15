 @extends('layouts.homedefault')

@section('content') 

<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script>



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

 <form action="{{route('UpdateBudget',$Budget->id) }}" method='post' class="form_data aling_block">  
   {{csrf_field()}}

      <label for="operation_value">Valor de Operacion</label> 
      <input name="operation_value" onBlur="sText();" class="input long" id="name" type="text" autocomplete="off" value="{{ $Budget->operation_value}}" />
      
      <label for="payment_type">Forma de Pago </label>
      <select name="payment_type" >
        <option value="1">Efectivo</option>
        <option value="2">Transferencia</option>
        <option value="3">Cheque</option>
      </select>

      <label for="invoiced">Facturado</label>
      <select id="invoiced" onchange="sText()" name="invoiced" >
        <option value="0">NO</option>
        <option value="1">SI</option>
      </select>

      <label for="approved">Aprobado</label>
      <select name="approved" >
        <option value="0">NO</option>
        <option value="1">SI</option>
      </select>

      <label for="user_id">Encargado</label>
      <select name="user_id" >
        @foreach ($users as $user)
         <option value="{{$user->id}}">{{ $user->name." ".$user->fathers_last_name }}</option>
        @endforeach
      </select>

      <h2>Costos Calculados</h2>
      <p>-----------------------</p>
      <p id="show_cost" value=""> </p>
      <input name="cost" id="cost" type="hidden"value="" />
      <p>-----------------------</p>
      

      <input type="submit" value="Guardar" class="input budget-button">

    </form>
  </div> 
 </div> 


 @stop