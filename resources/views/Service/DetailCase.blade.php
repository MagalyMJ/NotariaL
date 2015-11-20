@extends('layouts.homedefault')

@section('content')
<!-- Mostrara Todos los Casos Activos del servicio-Post  obtenido -->


	<div class="block_container">
		<h1>Escritura Nº {{$ServiceCase->id}}</h1>
		<h3>{{$ServiceCase->service->name}}</h3>
		<section id="partisipans_thisCase" >
			<h3>Participantes</h3>
			@foreach ($ServiceCase->customer as $customerSelect)
    			<div>
    				
    			<p class="text-center"> 
					<strong>{{$customerSelect->pivot->participants_type}}: </strong>
    				{{ $customerSelect->name .' '. $customerSelect->fathers_last_name .' '. $customerSelect->mothers_last_name }} 
					<br> <strong>Documentos Entregados: </strong>
					{{ $customerSelect->pivot->documents_list }}
    			</p>
    			
    			</div>
					@endforeach
			<a class="input budget-button"  href="{{route('Select_customer_InExisting_Case',$ServiceCase->id) }}">+ Participantes</a> 		   
		</section>

		<section id="thisCase_Data">
			<h3>Detalles de caso </h3>
			<p class="text-center">Detalle de Servicio: {{ $ServiceCase->service_detail}} </p>		
			<p class="text-center">Lugar: {{ $ServiceCase->place }} </p>
			<p class="text-center">Observaciones: {{ $ServiceCase->observations}} </p>		
			<p class="text-center">Progreso: %{{ $ServiceCase->progress}} </p>		
			<p class="text-center">Avisos: {{ $ServiceCase->notices}} - Dias Transcurridos: {{$ServiceCase->diffDateNotices()}}</p>				
			<p class="text-center">Firma: {{$ServiceCase->signature}} </p>
			<a class="input budget-button"  href="{{route('Edit_Case_path',$ServiceCase->id) }}"> Editar </a> 		   

		</section>

		<section id="budget_thisCase">
			<h3>Datos generales de presupuesto</h3>

			<p class="text-center">Honorarios: {{ $ServiceCase->budget->fee }} </p>		
			<p class="text-center">Aprovado: {{ $ServiceCase->budget->approved }} </p>		
			<p class="text-center">Facturado: {{ $ServiceCase->budget->invoiced }} </p>		
			<p class="text-center">IVA: ${{ $ServiceCase->budget->iva }} </p>		
			<p class="text-center">Tipo de Pago: {{ $ServiceCase->budget->payment_type}} </p>		
			<p class="text-center">Total: ${{ $ServiceCase->budget->total}} </p>		
			<p class="text-center">Descuento de Honorarios: $ {{ $ServiceCase->budget->discount}} </p>		
			<p class="text-center">Gastos de Viaje: $ {{ $ServiceCase->budget->travel_expenses}} </p>		
			<p class="text-center">Varios: ${{ $ServiceCase->budget->miscellaneous_expense}} </p>		
			<p class="text-center">Anticipo: $ {{ $ServiceCase->budget->advance_payment}} </p>		
		
			<a class="input budget-button"  href="{{route('PdfBuget',$ServiceCase->budget->id) }}" target="_blank">PDF</a>
				<br>
			<a class="input budget-button"  href="{{route('EditBudget',$ServiceCase->budget->id) }}">CrearPresupuesto</a> 
				<br>		   
			<a class="input budget-button"  href="{{route('Case_Payments',$ServiceCase->id) }}"> Pagos </a> 		   
		
		</section>


	</div>

@stop
