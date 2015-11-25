@extends('layouts.homedefault')

@section('content')
<!-- Mostrara Todos los Casos Activos del servicio-Post  obtenido -->


	<div class="block_container">

		<h1>Escritura Nº {{$ServiceCase->id}}</h1>
		<h3>{{$ServiceCase->service->name}}</h3>

   

		<h3>Participante</h3>

    	<h3 class="text-center"> <strong>{{ $customerSelect->name .' '. $customerSelect->fathers_last_name .' '. $customerSelect->mothers_last_name }}</strong></h3>
    			 
 		<form  id='customerDocuments' method='POST'>  
 	  		{{csrf_field()}}

    		
    			@foreach ($ServiceCase->service->participant_type_service as $participat)
      				<div class="form_data_participant_type">
						<div class="form_data_participant_type_name">
      						<label for="participant_type" class="check">{{$participat->name}}</label> 
      						<input name="participant_type" type="radio" value="{{$participat->name}}" />
						</div>
      					<ul>
      						@foreach ($ServiceCase->service->findDocumentsByParticipant($participat->name) as $document )
							<li>
									<input name="document_participant_type" type="checkbox" value="{{$document->document_name}}" />
									<label for="document_participant_type">{{ $document->document_name }} </label> 	
      						</li>
      						@endforeach
      					</ul>
      				</div>
      			@endforeach
      			<input id="documents_selected" name="documents_selected" type="hidden" value="">		
    		</form>
	
		<section class = "action_buttons">
    	  <input type="submit" value="Guardar" class="input budget-button" onClick="UpdateDocuments()">
    	  <a class="input budget-button" href="{{route('Show_Case_path',$ServiceCase->id) }}"> Cancelar </a>
		</section>
   
	</div>

<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script>

function UpdateDocuments(){
	
	var documents_selected = new Array();

	$("input:checkbox[name=document_participant_type]:checked").each(function(){
    	documents_selected.push($(this).val()); 	
	});

	document.getElementById("documents_selected").value = documents_selected; 

	document.getElementById("customerDocuments").action = "{{route('Update_CustomerinCase',array($ServiceCase->id , $customerSelect->id) ) }}";

	document.getElementById("customerDocuments").submit(); 
}

	
</script>
@stop