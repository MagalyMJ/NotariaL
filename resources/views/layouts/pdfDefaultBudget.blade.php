<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<!-- Mobile Specific Metas
 ================================================== --> 
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
</style>
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
  <link rel="stylesheet" href="{{ asset('css/pdf.css')}}">
<!-- Favicons
  ================================================== -->
</head>

	<body>
  <header class="clearfix">
      <h1>Presupuesto</h1>
      <div id="project">

       
          <div>Notaria Publica 55</div>
          <div><span>Lugar:</span> Montes Himalaya 304 Fraccionamiento Los Bosques</div>
          <div><span>Tel:</span>0000000</div>
          <div><span>EMAIL</span><a href="mailto:company@example.com">company@example.com</a></div>
  

        <div><span>Servicio</span> {{ $Budget->case_service->service->name}} </div>
        <div><span>Cliente</span> {{ $Budget->case_service->customer->first()->name .' '.$Budget->case_service->customer->first()->fathers_last_name .' '. $Budget->case_service->customer->first()->mothers_last_name }}</div>
       <!--  <div><span>ADDRESS</span>Calle, </div>
        <div><span>EMAIL</span></div> -->
        <div><span>Fecha</span> {{ $date }} </div>
      </div>
    </header>
	
		 @yield('content')

	<section class="general_content">

		<table class="table-fill" >
				<thead>
					<tr class="tablehead">
						<th class="text-left">Descripción</th>
						<th class="text-left">Cantidad</th>
					</tr>
				</thead>
					<tr>
   						<td class="text-center">Gastos de Viaje</td>
    					<td class="text-center">$ {{$Budget->travel_expenses}}</td>
    				</tr>
    				<tr>
   						<td class="text-center">Gastos de Varios</td>
    					<td class="text-center">$ {{$Budget->miscellaneous_expense}}</td>
    				</tr>

    				<tr>
   						<td class="text-center">Recargos</td>
    					<td class="text-center">$ {{$Budget->surcharges}}</td>
    				</tr>

    				<tr>
   						<td class="text-center">Descuento de Honorarios</td>
    					<td class="text-center">- $ {{$Budget->discount}}</td>
    				</tr>
    				
    				<tr>
   						<td class="text-center">Sub-Total</td>
    					<td class="text-center">$ {{$Budget->sub_total}}</td>
    				</tr>

    				<tr>
   						<td class="text-center">IVA</td>
    					<td class="text-center">$ {{$Budget->iva}}</td>
    				</tr>

    				<tr>
   						<td class="text-center">Total</td>
    					<td class="text-center">$ {{$Budget->total}}</td>
    				</tr>
    	</table>
      <h3>Solicitando un Anticipo de ${{$Budget->advance_payment}}</h3>
	</section>

	</body>
</html>