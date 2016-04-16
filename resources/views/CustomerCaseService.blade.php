  @extends('layouts.homedefault')

@section('content') 
 <div class="form_container"> 

 <form action="{{route('customer_service_path') }}" method='post' class="form_data aling_block">  
   {{csrf_field()}}

        <!-- @foreach ($customers as $customer) -->

		 	      <h2>{{$customers->name .$customers->fathers_last_name  }}</h2>

      			<div class="controls-stacked">
  					<label class="control radio">
  						<input name="testador" type="radio" id="testador">
   						Testador
					</label>
					<label class="control radio">
  						<input name="testigo" type="radio" id="testigos" >
  						Testigo
					
       
        
      @foreach ($documents as $document)
              <label class="control checkbox">
              <input type="checkbox" id="{{ $document->document_name }}" name="{{ $document->document_name }}">
             {{ $document->document_name }}
        </label>

            @endforeach
       <!--  @endforeach -->
      </label>
          <textarea rows="4" cols="50" name="subject" placeholder="Observaciones" class="message_area" ></textarea>
      </div>

				  <label  for="opertationValue"class="control checkbox">
  			 		Valor de operacion
				  </label>
			   	<input class="input" name="operationValue" id="operationValue" type="text" autocomplete="off"/>

           <input id="idcustomer" name="idcustomer" type="hidden" value="{{$customers->id}}">
       </div>

        <input type="submit" value="Registrar" class="input budget-button button_normal">

  </form>
 </div> 
 @stop
