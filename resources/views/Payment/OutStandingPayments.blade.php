@extends('layouts.homedefault')

@section('content')

  <div class="block_container">
    
    <section class="title_continer">
      <img class="title_icon" src="{{ asset('img/icons/system/pendientesdepago.ico') }}" alt=""> 
      <h1>Pagos Pendientes</h1>
    </section>

    <table id="customers_Table" class="table-fill">
        <thead>
          <tr>

            <th class="text-center">Nº Folio</th>
            <th class="text-center">Nº Escritura</th>
            <th class="text-center">Total a Pagar</th>
            <th class="text-center">Adeudo</th>
            <th class="text-center">Pagos</th>
          </tr>
        </thead>
        <tbody id="body_table" class="table-hover">
        
         {{csrf_field()}}

          @foreach ($ServicesCases as $Case )
              <tr>
                <td class="text-center"> {{ $Case->id }} </td>
                <td class="text-center"> {{ $Case->N_write}} </td>
                <td class="text-center">$ {{ $Case->budget->total }} </td>
                <td class="text-center">$ {{ $Case->remaining }} </td>
                <td class="text-center"> 
                  <a class="budget-button button_normal"  href="{{route('Case_Payments',$Case->id) }}">
                    <img class="title_icon" src="{{ asset('img/icons/system/detalle_de_Tramite.ico') }}" alt="Detalles">
                      <p>Detalles</p>
                  </a>
                </td>
              </tr>
          @endforeach
          
        </tbody>
        </table>
  </div>

@stop