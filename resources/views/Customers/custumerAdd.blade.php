@extends('layouts.homedefault')

@section('content')
<div class="block_container">
 <h1>Registro de Nuevo Cliente para un Nuevo Tramite</h1>
 <div class="form_container"> 

 <form action="{{ route('customer_new_path') }}" method='post' class="form_data">  
   {{csrf_field()}}
        <div class="form_data_general">
     			<label for="name">Nombre</label> 
     			<input name="name" class="input long" id="name" type="text" autocomplete="off" />
     			 	
     			<label for="fathers_last_name">Apellido Paterno</label> 
          <input name="fathers_last_name" class="input long" id="fathers_last_name" type="text" autocomplete="off" /> 

          <label for="mothers_last_name">Apellido Materno</label> 
     			<input name="mothers_last_name" class="input long" id="lmothers_last_name" type="text" autocomplete="off" /> 
     			 	
     			<label for="from">Originario de</label> 
     			<input name="from" class="input long" id="from" type="text" autocomplete="off" /> 
     			 	
     			<label for="birth_day">Fecha de Nacimiento</label> 
     			<input name="birth_day" class="input long" id="birth_day" type="date" autocomplete="off" /> 
     			 	
          <label for="marital_status">Estado Civil</label> 
          <select name="marital_status">
                <option value="1">soltero/a</option>
                <option value="2">casado/a</option>
                <option value="3">divorciado/a</option>
                <option value="4">viudo/a</option>
          </select>
     		</div>

        <div class="form_data_general">
          <label for="rfc">RFC</label> 
     			<input name="rfc" class="input long" id="marital_status" type="text" autocomplete="off" /> 
     			 	<!-- 
     			<label for="neighbor">Vecino De</label> 
     			<input name="neighbor" class="input long" id="neighbor" type="text" autocomplete="off" />  -->
     			 
     			<label for="occupation">Ocupación</label> 
     			<input name="occupation" class="input long" id="occupation" type="text" autocomplete="off" />

          <label for="phone">Teléfono</label> 
          <input name="phone" class="input long" id="phone" type="tel" autocomplete="off" /> 
 
     			 	
          <label for="street">Calle</label> 
          <input name="street" class="input long" id="street" type="text" autocomplete="off" /> 
         
          <label for="number">Número</label> 
          <input name="number" class="input long" id="number" type="text" autocomplete="off" /> 
     			
          <label for="colony">Colonia</label> 
          <input name="colony" class="input long" id="colony" type="text" autocomplete="off" /> 
          
          <label for="postal_code">CP</label> 
     			<input name="postal_code" class="input long" id="postal_code" type="text" autocomplete="off" /> 
     	  </div>

      <section class = "action_buttons">
          <div class="action_buttons_diplay">
            <input id="id_service" name="id_service" type="hidden" value="{{$id_service}}">
            <button type="submit" class="budget-button button_normal">
              <img class="title_icon" src="{{ asset('img/icons/system/check.ico') }}" alt="Nuevo Registro">
              <p> Registrar </p> 
            </button>
            <a class="budget-button button_normal" href="{{route('home') }}"> 
              <img class="title_icon" src="{{ asset('img/icons/system/cancel.ico') }}" alt="Cancelar">
              <p> Cancelar </p> 
            </a>
          </div>
      </section>
  </form>
 </div> 
</div>

@endsection