<!-- parameter 
$customer object customer
$address object adress -->
@extends('layouts.homedefault')

@section('content')
<div class="block_container">
  <section class="title_continer">
    <img class="title_icon" src="{{ asset('img/icons/system/registrocliente.ico') }}" alt=""> 
    <h1>Editar Datos de Cliente</h1>
  </section>
  
 <div class="form_container"> 

 <form action="{{route('Update_customer',$customer->id)}}" method='post' class="form_data">  
   {{csrf_field()}}
      <div class="form_data_general">
          <label for="name">Nombre</label> 
          <input name="name" class="input long" id="name" type="text" autocomplete="off" value="{{$customer->name}}"/>
            
          <label for="fathers_last_name">Apellido Paterno</label> 
          <input name="fathers_last_name" class="input long" id="fathers_last_name" type="text" autocomplete="off" value="{{$customer->fathers_last_name}}" /> 

          <label for="mothers_last_name">Apellido Materno</label> 
          <input name="mothers_last_name" class="input long" id="lmothers_last_name" type="text" autocomplete="off" value="{{$customer->mothers_last_name}}" /> 
            
          <label for="from">Originario de</label> 
          <input name="from" class="input long" id="from" type="text" autocomplete="off" value="{{$customer->from}}"/> 
            
          <label for="birth_day">Fecha de Nacimiento</label> 
          <input name="birth_day" class="input long" id="birth_day" type="date" autocomplete="off" value="{{$customer->birthdate}}" /> 
            
          <label for="marital_status">Estado Civil</label> 
          <select name="marital_status">
                <option value="1" @if($customer->marital_status == 'soltero/a' ){{ "selected" }} @endif >soltero/a</option>
                <option value="2" @if($customer->marital_status == 'casado/a' ){{ "selected" }} @endif >casado/a</option>
                <option value="3" @if($customer->marital_status == 'divorciado/a' ){{ "selected" }} @endif>divorciado/a</option>
                <option value="4" @if($customer->marital_status == 'viudo/a' ){{ "selected" }} @endif>viudo/a</option>
          </select>
        </div>

        <div class="form_data_general">
          <label for="rfc">RFC</label> 
          <input name="rfc" class="input long" id="marital_status" type="text" autocomplete="off" value="{{$customer->rfc}}" /> 
                    
          <label for="occupation">Ocupación</label> 
          <input name="occupation" class="input long" id="occupation" type="text" autocomplete="off" value="{{$customer->occupation}}"/>

          <label for="phone">Teléfono</label> 
          <input name="phone" class="input long" id="phone" type="tel" autocomplete="off" value="{{$customer->phone}}"/> 
 
            
          <label for="street">Calle</label> 
          <input name="street" class="input long" id="street" type="text" autocomplete="off" value="{{$address->street}}"/> 
         
          <label for="number">Número</label> 
          <input name="number" class="input long" id="number" type="text" autocomplete="off" value="{{$address->number}}"/> 
          
          <label for="colony">Colonia</label> 
          <input name="colony" class="input long" id="colony" type="text" autocomplete="off" value="{{$address->colony}}"/> 
          
          <label for="postal_code">CP</label> 
          <input name="postal_code" class="input long" id="postal_code" type="text" autocomplete="off" value="{{$address->postal_code}}"/> 
        </div>
        <section class = "action_buttons">
          <div class="action_buttons_diplay">
            <button type="submit" class="budget-button button_normal">
              <img class="title_icon" src="{{ asset('img/icons/system/check.ico') }}" alt="Guardar">
              <p> Guardar </p> 
            </button>
            <a class="budget-button button_normal" href="{{route('Customer_List') }}"> 
              <img class="title_icon" src="{{ asset('img/icons/system/cancel.ico') }}" alt="Cacelar">
              <p> Cancelar </p> </a>
          </div>
        </section>
  </form>
 </div> 
 </div> 

@endsection