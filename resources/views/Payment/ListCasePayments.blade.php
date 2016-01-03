@extends('layouts.homedefault')

@section('content')

  <div class="block_container">
    <h1>Pagos </h1>
    <h2>Del Folio Nº {{$ServiceCase->id}}</h2>
    <ul>
      <il>Total en Pagos: <strong>${{$SumPayments}}</strong></il>
      <il>Total a Pagar: <strong>${{$BudgetTotal}}</strong></il>
      <il>Adeudo: <strong>${{$DiffToPay}}</strong></il>
    </ul>

    <table id="customers_Table" class="table-fill">
        <thead>
          <tr>

            <th class="text-center">Folio de Pago</th>
            <th class="text-center">Nombre</th>
            <th class="text-center">Concepto</th>
            <th class="text-center">Modo</th>
            <th class="text-center">Monto</th>
            <th class="text-center th_big">Fecha</th>
            <th class="text-center">Imprimir</th>
          </tr>
        </thead>
        <tbody id="body_table" class="table-hover">
        
         {{csrf_field()}}

          @foreach ($ServiceCase->payment as $payment)
              <tr>
                <td class="text-center"> {{ $payment->id }} </td>
                <td class="text-center"> {{ $payment->name }} </td>
                <td class="text-center"> {{ $payment->concept }} </td>
                <td class="text-center"> {{ $payment->payment_type }} </td>
                <td class="text-center"> ${{ $payment->amount_to_pay }} </td>
                <td class="text-center"> {{ $payment->created_at }} </td>
                <td class="text-center"> 
                  <a class="budget-button button_normal" href="{{route('PdfPayment',$payment->id ) }}" target="_blank" >
                    <img class="title_icon" src="{{ asset('img/icons/system/pdf.ico') }}" alt="Imprimir">
                    <p>Imprimir</p>
                  </a>
                </td>

              </tr>
          @endforeach
          
        </tbody>
        </table>
    <section class = "action_buttons">
      <a class="budget-button button_normal"  href="{{route('Payment_Create',$ServiceCase->id) }}"> 
        <img class="title_icon" src="{{ asset('img/icons/system/pago.ico') }}" alt="Hacer Pago">
        <p>Hacer Pago </p>
      </a>        
      <a class="budget-button button_normal" href="{{route('Show_Case_path',$ServiceCase->id) }}">
        <img class="title_icon" src="{{ asset('img/icons/system/detalle_de_Tramite.ico') }}" alt="Detalles">
        <p>Detalles Tramite</p>
      </a>
    </section>
  </div>

@stop