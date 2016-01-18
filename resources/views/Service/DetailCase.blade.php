@extends('layouts.homedefault')

@section('content')
<!-- Mostrara Los detalles de un caso en particular
	$SeriveCase objets
	$CanEdit boolean
	-->


<div class="block_container">
		
	<h1>Tramite Nº {{$ServiceCase->id}}</h1>
	<section class="title_continer">
		<img class="title_icon" src="{{ asset($ServiceCase->service->icon_path) }}" alt="">
		<h3 class="title" >{{$ServiceCase->service->name}}</h3>
	</section>
	<div class="flex-container">

		<section class="caseDetail" >

			<div id="partisipans_thisCase" class="Detail_participants" >
				<section class="title_continer">
					<img class="title_icon" src="{{ asset('img/icons/system/participantes.ico') }}" alt="">
					<h2 class="title" >Participantes</h2>
				</section>
			@foreach ($ServiceCase->customer()->orderBy('participants_type')->get() as $customerSelect)
    			<div>
    				
    			<p class="text-center"> 
					<strong>{{$customerSelect->pivot->participants_type}} </strong>
    				{{ $customerSelect->name .' '. $customerSelect->fathers_last_name .' '. $customerSelect->mothers_last_name }} 
					<br> <strong>Documentos Entregados: </strong>
					{{ $customerSelect->pivot->documents_list }}
    			</p>
    			
    			</div>
					@endforeach
			</div>
			@if($CanEdit)
				<section class = "action_buttons">
					<a class="budget-button button_big"  href="{{route('Select_customer_InExisting_Case',$ServiceCase->id) }}">
						<img class="title_icon" src="{{ asset('img/icons/system/mas_Participantes.ico') }}" alt="Agregar más Participantes">
						<p>Agregar Participantes</p>
					</a>
				</section>
			@endif
		</section>

		<div>
			<section class="caseDetail " >
				<div id="thisCase_Data" class="Detail_general " >
					<section class="title_continer">
						<img class="title_icon" src="{{ asset('img/icons/system/detalle_de_Tramite.ico') }}" alt="">
						<h3 class="title" >Detalles de Tramite</h3>
					</section>
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
					@if($CanEdit)
						<section class = "action_buttons">
							<a class="budget-button button_normal"  href="{{route('Edit_Case_path',$ServiceCase->id) }}"> 
								<img class="title_icon" src="{{ asset('img/icons/system/edit_file.ico') }}" alt="Editar Datos del Tramite">
								<p>Editar</p> 
							</a> 		   
						
						</section>
					@endif
				</div>

			
			</section>

			@if($CanEdit)
			<section class="caseDetail" >
				<div id="budget_thisCase" class="Detail_budeget" >
					<section class="title_continer">
						<img class="title_icon" src="{{ asset('img/icons/system/generales_Presupuesto.ico') }}" alt="">
						<h3 class="title">Datos Generales de Presupuesto</h3>
					</section>
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

						<a class="budget-button button_normal"  href="{{route('PdfBuget',$ServiceCase->budget->id) }}" target="_blank">
							<img class="title_icon" src="{{ asset('img/icons/system/pdf.ico') }}" alt="Generar PDF">
							<p>PDF</p> 
						</a>
						
						<a class="budget-button button_big"  href="{{route('EditBudget',$ServiceCase->budget->id) }}">
							<img class="title_icon" src="{{ asset('img/icons/system/edit_Presupuesto.ico') }}" alt="Editar Datos del Presupuesto">
							<p>Editar Presupuesto</p> 
						</a> 
							   
						<a class="budget-button button_normal"  href="{{route('Case_Payments',$ServiceCase->id) }}"> 
							<img class="title_icon" src="{{ asset('img/icons/system/pago.ico') }}" alt="Editar Datos del Presupuesto">
							<p>Pagos</p> 
						</a> 
							   
					</section>
				
				</div>	
			</section>
		@endif	
		</div>


	</div>
</div>

@stop
