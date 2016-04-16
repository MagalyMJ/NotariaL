@extends('layouts.pdfDefaultBudget')

@section('content')

<section>

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
   						<td class="text-center">ISNJIN</td>
    					<td class="text-center">$ {{$Budget->isnjin}}</td>
    				</tr>

    				<tr>
   						<td class="text-center">Gastos de Registro</td>
    					<td class="text-center">$ {{$Budget->total_registration_costs}}</td>
    				</tr>
				
				</tbody>
				</table>
</section>

@stop