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
              <td class="text-center">ISR</td>
              <td class="text-center">$ {{$Budget->isr}}</td>
            </tr>
            <tr >
              <td class="text-center">ISABI</td>
              <td class="text-center">$ {{$Budget->isabi}}</td>
            </tr>
            
            <tr>
              <td class="text-center">Avalúo Comercial</td>
              <td class="text-center">$ {{$Budget->commercial_appraisal}}</td>
            </tr>

            <tr>
              <td class="text-center">Gastos de Registro</td>
              <td class="text-center">$ {{$Budget->total_registration_costs}}</td>
            </tr>
				
				</tbody>
				</table>
</section>

@stop