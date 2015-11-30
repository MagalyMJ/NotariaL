@extends('layouts.homedefault')

@section('content')

  <div class="block_container">
    <h1>Pagos Pendientes</h1>

    <table id="customers_Table" class="table-fill">
        <thead>
          <tr>

            <th class="text-left">Nº Escritura</th>
            <th class="text-left">Total a Pagar</th>
            <th class="text-left">Adeudo</th>
            <th class="text-left">Pagos</th>
          </tr>
        </thead>
        <tbody id="body_table" class="table-hover">
        
         {{csrf_field()}}

          @foreach ($ServicesCases as $Case )
              <tr>
                <td class="text-center"> {{ $Case->id }} </td>
                <td class="text-center">$ {{ $Case->budget->total }} </td>
                <td class="text-center">$ {{ $Case->remaining }} </td>
                <td class="text-center"> <a class="input budget-button"  href="{{route('Case_Payments',$Case->id) }}">Detalles</a></td>
              </tr>
          @endforeach
          
        </tbody>
        </table>
  </div>

@stop