@extends('layouts.pdfDefaultBudget')

@section('content')

<section>

   	<p class="text-center">Valor de Operación: {{$Budget->operation_value}}</p>
	
	<table class="table-fill" >
				<thead>
					<tr class="tablehead">
						<th class="text-left">Descripción</th>
						<th class="text-left">Cantidad</th>
					</tr>
				</thead>
				<tbody class="table-hover">
    				<tr >
   						<td class="text-center">Honorarios</td>
    					<td class="text-center">$ {{$Budget->fee}}</td>
            </tr>
    				<tr >
   						<td class="text-center">Avalúo Catastral</td>
    					<td class="text-center">$ {{$Budget->property_valuation}}</td>
    				</tr>
    				<tr >
   						<td class="text-center">Gestoria de Escritura</td>
    					<td class="text-center">$ {{$Budget->writing_management}}</td>
    				</tr>

    				<tr>
   						<td class="text-center">Gastos de Registro</td>
    					<td class="text-center">$ {{$Budget->total_registration_costs}}</td>
    				</tr>
    				<tr>
   						<td class="text-center">Gastos de Certificados</td>
    					<td class="text-center">$ {{$Budget->total_certified_expenditure}}</td>
    				</tr>
				
				</tbody>
				</table>
</section>

@stop