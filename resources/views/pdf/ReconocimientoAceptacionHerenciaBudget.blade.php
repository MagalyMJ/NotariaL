@extends('layouts.pdfDefaultBudget')

@section('content')

<section>
<h4>DEfault PDF de Presupuesto</h4>
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

            <tr>
              <td class="text-center">Gastos de Registro Edictos</td>
              <td class="text-center">$ {{$Budget->edicts}}</td>
            </tr>
        
        </tbody>
        </table>
</section>

@stop