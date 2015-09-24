@extends('layouts.homedefault')

@section('content')


 <div class="form_container"> 
 <form action="" id="general_data" class="form_data aling_block">
				
     			<label for="name">Nombre</label> 
     			<input class="input long" id="name" type="text" autocomplete="off" />
     			 	
     			<label for="lastname">Apellido</label> 
     			<input class="input long" id="lastname" type="text" autocomplete="off" /> 
     			 	
     			<label for="from">Originario de</label> 
     			<input class="input long" id="from" type="text" autocomplete="off" /> 
     			 	
     			<label for="birth_day">Fecha de Nacimiento</label> 
     			<input class="input long" id="birth_day" type="date" autocomplete="off" /> 
     			 	
     			<label for="marital_status">Estado Civil</label> 
     			<input class="input long" id="marital_status" type="text" autocomplete="off" /> 
     			 	
     			<label for="neighbor">Vecino De</label> 
     			<input class="input long" id="neighbor" type="text" autocomplete="off" /> 
     			  
     			<label for="occupation">Ocupación</label> 
     			<input class="input long" id="occupation" type="text" autocomplete="off" /> 
     			 	
     			<label for="domicile">Domicilio</label> 
     			<input class="input long" id="domicile" type="text" autocomplete="off" /> 
     			 	
     			<label for="phone">Teléfon</label> 
     			<input class="input long" id="phone" type="tel" autocomplete="off" /> 

     			<form class="controls-stacked">
  					<label class="control radio">
  						<input type="radio" id="testador" name="radio">
   						Testador
					</label>
					<label class="control radio">
  						<input type="radio" id="testigos" name="radio">
  						Testigos
					</label>
					<textarea rows="4" cols="50" name="subject" placeholder="Observaciones" class="message_area" ></textarea>
				</form>
     			
 </form>

 <form class="controls-stacked form_data">
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
				<input class="input" id="opertationValue" type="text" autocomplete="off" />
				<a href="testamento_presupuesto.php" class="input budget-button">  Presupuesto </a>
 </form>

</div>
@endsection