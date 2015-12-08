@extends('layouts.homedefault')

@section('content')
<!-- Mostrara Todos los Casos Activos del servicio-Post  obtenido -->


<div class="block_container">
		
		<h1>Nº Folio{{$ServiceCase->id}}</h1>
		<h3>{{$ServiceCase->service->name}}</h3>
	<div class="flex-container">

		<section class="caseDetail" >

			<div id="partisipans_thisCase" class="Detail_participants" >
			<h2>Participantes</h2>
			@foreach ($ServiceCase->customer()->orderBy('participants_type')->get() as $customerSelect)
    			<div>
    				
    			<p class="text-center"> 
					<strong>{{$customerSelect->pivot->participants_type}}: </strong>
    				{{ $customerSelect->name .' '. $customerSelect->fathers_last_name .' '. $customerSelect->mothers_last_name }} 
					<br> <strong>Documentos Entregados: </strong>
					{{ $customerSelect->pivot->documents_list }}
    			</p>
    			
    			</div>
					@endforeach
			</div>
			<section class = "action_buttons">
				<a class="input budget-button button_normal"  href="{{route('Select_customer_InExisting_Case',$ServiceCase->id) }}">+ Participantes</a> 		   
			</section>
		</section>

		<div>
			<section class="caseDetail " >
				<div id="thisCase_Data" class="Detail_general " >
				
					<h3>Detalles de Tramite</h3>
					<div class="flex-container">
						<div>
							<p class="text-center"><strong> Detalle de Servicio:</strong>  {{ $ServiceCase->service_detail}} </p>		
							<p class="text-center"><strong> Lugar:</strong>  {{ $ServiceCase->place }} </p>
							<p class="text-center"><strong> Progreso:</strong>  %{{ $ServiceCase->progress}} </p>	
							<p class="text-center"><strong> Nº de Escritura:</strong>  {{$ServiceCase->N_write}} </p>	
						</div>
						<div>
							<p class="text-center"><strong> Avisos:</strong>  {{ $ServiceCase->notices}} - Dias Transcurridos: {{$ServiceCase->diffDateNotices()}}</p>				
							<p class="text-center"><strong> Firmado:</strong>  {{$ServiceCase->signature}} </p>
							<p class="text-center observation"><strong> Observaciones:</strong>  {{ $ServiceCase->observations}} </p>	
						</div>
					</div>
					<section class = "action_buttons">
						<a class="input budget-button button_normal"  href="{{route('Edit_Case_path',$ServiceCase->id) }}"> Editar </a> 		   
					</section>
				</div>

			
			</section>

			<section class="caseDetail" >
				<div id="budget_thisCase" class="Detail_budeget" >
				
					<h3>Datos Generales de Presupuesto</h3>
					<div class="flex-container">
						<div>
							<p class="text-center"><strong>Honorarios:</strong> ${{ $ServiceCase->budget->fee }} </p>		
							<p class="text-center"><strong>Aprobado:</strong>  {{ $ServiceCase->budget->approved }} </p>		
							<p class="text-center"><strong>Facturado:</strong>  {{ $ServiceCase->budget->invoiced }} </p>		
							<p class="text-center"><strong>IVA:</strong>  ${{ $ServiceCase->budget->iva }} </p>		
							<p class="text-center"><strong>Tipo de Pago:</strong>  {{ $ServiceCase->budget->payment_type}} </p>		
						</div>
						<div>
							<p class="text-center"><strong>Total:</strong>  ${{ $ServiceCase->budget->total}} </p>		
							<p class="text-center"><strong>Descuento de Honorarios:</strong>  $ {{ $ServiceCase->budget->discount}} </p>		
							<p class="text-center"><strong>Gastos de Viaje:</strong>  $ {{ $ServiceCase->budget->travel_expenses}} </p>		
							<p class="text-center"><strong>Varios:</strong>  ${{ $ServiceCase->budget->miscellaneous_expense}} </p>		
							<p class="text-center"><strong>Anticipo:</strong>  $ {{ $ServiceCase->budget->advance_payment}} </p>
						</div>		
					</div>
				
					<section class = "action_buttons">

						<a class="input budget-button button_normal"  href="{{route('PdfBuget',$ServiceCase->budget->id) }}" target="_blank">PDF</a>
						
						<a class="input budget-button button_big"  href="{{route('EditBudget',$ServiceCase->budget->id) }}">Crear Presupuesto</a> 
							   
						<a class="input budget-button button_normal"  href="{{route('Case_Payments',$ServiceCase->id) }}"> Pagos </a> 		   
					</section>

				</div>	
			</section>
		</div>


	</div>
</div>

@stop
