@extends('layouts.homedefault')

@section('content')

  <div class="block_container">
    <h1>Pagos </h1>
    <h2>De la Escritura Nº {{$ServiceCase->id}}</h2>
    <ul>
      <il>Total en Pagos: <strong>${{$SumPayments}}</strong></il>
      <il>Total a Pagar: <strong>${{$BudgetTotal}}</strong></il>
      <il>Adeudo: <strong>${{$DiffToPay}}</strong></il>
    </ul>

    <table id="customers_Table" class="table-fill">
        <thead>
          <tr>

            <th class="text-left">Folio de Pago</th>
            <th class="text-left">Nombre</th>
            <th class="text-left">Modo</th>
            <th class="text-left">Monto</th>
            <th class="text-left">Fecha</th>
          </tr>
        </thead>
        <tbody id="body_table" class="table-hover">
        
         {{csrf_field()}}

          @foreach ($ServiceCase->payment as $payment)
              <tr>
                <td class="text-center"> {{ $payment->id }} </td>
                <td class="text-center"> {{ $payment->name }} </td>
                <td class="text-center"> {{ $payment->payment_type }} </td>
                <td class="text-center"> ${{ $payment->amount_to_pay }} </td>
                <td class="text-center"> {{ $payment->created_at }} </td>
              </tr>
          @endforeach
          
        </tbody>
        </table>

      <a class="input budget-button"  href="{{route('Payment_Create',$ServiceCase->id) }}"> Hacer Pago </a>        
          <br>
      <a class="input budget-button" href="{{route('Show_Case_path',$ServiceCase->id) }}">Detalles Caso</a>
  </div>

@stop