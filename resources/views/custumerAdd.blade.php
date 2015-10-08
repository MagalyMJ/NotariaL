@extends('layouts.homedefault')

@section('content')


 <div class="form_container"> 

 <form action="{{route('customer_post_path') }}" method='post' class="form_data aling_block">  
   {{csrf_field()}}

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
     			
          <label for="rfc">RFC</label> 
     			<input name="rfc" class="input long" id="marital_status" type="text" autocomplete="off" /> 
     			 	<!-- 
     			<label for="neighbor">Vecino De</label> 
     			<input name="neighbor" class="input long" id="neighbor" type="text" autocomplete="off" />  -->
     			 
     			<label for="occupation">Ocupación</label> 
     			<input name="occupation" class="input long" id="occupation" type="text" autocomplete="off" />

          <label for="phone">Teléfon</label> 
          <input name="phone" class="input long" id="phone" type="tel" autocomplete="off" /> 
 
     			 	
          <label for="street">Calle</label> 
          <input name="street" class="input long" id="street" type="text" autocomplete="off" /> 
         
          <label for="number">Numero</label> 
          <input name="number" class="input long" id="number" type="text" autocomplete="off" /> 
     			
          <label for="colony">Colonia</label> 
          <input name="colony" class="input long" id="colony" type="text" autocomplete="off" /> 
          
          <label for="postal_code">CP</label> 
     			<input name="postal_code" class="input long" id="postal_code" type="text" autocomplete="off" /> 
     			 	
  <!-- 

     			<div class="controls-stacked">
  					<label class="control radio">
  						<input name="testador" type="radio" id="testador">
   						Testador
					</label>
					<label class="control radio">
  						<input name="testigo" type="radio" id="testigos" >
  						Testigo
					</label>
					<textarea rows="4" cols="50" name="subject" placeholder="Observaciones" class="message_area" ></textarea>
				</div>

       
  		
          <div class="controls-stacked form_data">
  				  <label class="control checkbox">
  					 <input type="checkbox" id="identificacion" name="checkbox">
   				 	 Identificacion
				  </label>

				  <label class="control checkbox">
  				  	<input type="checkbox" id="escrituras" name="checkbox">
  				  	Escrituras
				  </label>


				  <label  for="opertationValue"class="control checkbox">
  			 		Valor de operacion
				  </label>
			   	<input class="input" id="opertationValue" type="text" autocomplete="off"/>
       </div>
 -->
        <input type="submit" value="Registrar" class="input budget-button">

  </form>
 </div> 

@endsection