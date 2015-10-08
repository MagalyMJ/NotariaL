@extends('layouts.homedefault')

@section('content') 
 <div class="form_container"> 

 <form action="{{route('customer_service_post_path') }}" method='post' class="form_data aling_block">  
   {{csrf_field()}}

		 	
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
        
          @foreach ($documents as $user)
              <label class="control checkbox">
              <input type="checkbox" id="{{ $user->document_name }}" name="{{ $user->document_name }}">
             {{ $user->document_name }}
        </label>

        @endforeach
      

				  <label  for="opertationValue"class="control checkbox">
  			 		Valor de operacion
				  </label>
			   	<input class="input" name="operationValue" id="operationValue" type="text" autocomplete="off"/>
       </div>

        <input type="submit" value="Registrar" class="input budget-button">

  </form>
 </div> 
 @stop
