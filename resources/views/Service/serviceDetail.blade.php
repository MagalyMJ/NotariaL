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
    				
    			<p class="text-center"> {{ $customerSelect->name .' '. $customerSelect->fathers_last_name .' '. $customerSelect->mothers_last_name }} </p>
    			
    			</div>
					@endforeach
		</section>

		<section id="thisCase_Data">
			<h3>Detalles de caso </h3>
			<p class="text-center">Detalle de Servicio: {{ $ServiceCase->service_detail}} </p>		
			<p class="text-center">Lugar: {{ $ServiceCase->place }} </p>		
			<p class="text-center">Progreso: {{ $ServiceCase->progress}} </p>		
			<p class="text-center">Avisos: {{ $ServiceCase->notices}} </p>		
			<p class="text-center">Observaciones: {{ $ServiceCase->observations}} </p>		
			<a class="input budget-button"  href="{{route('Edit_Case_path',$ServiceCase->id) }}"> Editar </a> 		   

		</section>

		<section id="budget_thisCase">
			<h3>Datos generales de presupuesto</h3>
			<p class="text-center">Aprovado: {{ $ServiceCase->budget->approved }} </p>		
			<p class="text-center">Facturado: {{ $ServiceCase->budget->invoiced }} </p>		
			<p class="text-center">Tipo de Pago: {{ $ServiceCase->budget->payment_type}} </p>		
			<p class="text-center">Valor de Operacion: $ {{ $ServiceCase->budget->operation_value}} </p>		
			<p class="text-center">Costo: $ {{ $ServiceCase->budget->cost}} </p>		
			<p class="text-center">Descuento de Honorarios: $ {{ $ServiceCase->budget->discount}} </p>		
			<p class="text-center">Gastos de Viaje: $ {{ $ServiceCase->budget->travel_expenses}} </p>		
			<p class="text-center">Varios: $ {{ $ServiceCase->budget->miscellaneous_expense}} </p>		
			<p class="text-center">Anticipo: $ {{ $ServiceCase->budget->advance_payment}} </p>		
			<p class="text-center">Recargos: $ {{ $ServiceCase->budget->surcharges}} </p>		
			<p class="text-center">ISNJIN: $ {{ $ServiceCase->budget->isnjin}} </p>		
			<p class="text-center">ISR: $ {{ $ServiceCase->budget->isr}} </p>		
			<p class="text-center">Encargado: {{ $ServiceCase->budget->user->name." ".$ServiceCase->budget->user->fathers_last_name }} </p>		
			
			<a class="input budget-button"  href="{{route('EditBudget',$ServiceCase->budget->id) }}"> Editar </a> 		   
		
		</section>


	</div>

@stop
