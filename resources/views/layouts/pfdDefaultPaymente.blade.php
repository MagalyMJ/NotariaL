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
      <div id="logo">
        <img src="{{ asset('img/logo.png') }}" alt="">
      </div>
      <h1>Recibo de Pago</h1>
      <div id="project">

          <div>Notaria Publica 55</div>
          <div><span>Lugar:</span> Montes Himalaya 304 Fraccionamiento Los Bosques</div>
          <div><span>Tel:</span>0000000</div>
          <div><span>EMAIL</span><a href="mailto:company@example.com">company@example.com</a></div>
  

        <div><span>Servicio</span> {{ $ServiceCase->service->name}} </div>
        <div><span>Cliente</span> {{ $ServiceCase->customer->first()->name .' '.$ServiceCase->customer->first()->fathers_last_name .' '. $ServiceCase->customer->first()->mothers_last_name }}</div>
        <div><span>Folio</span>{{ $ServiceCase->id}} </div>
       <!--    <div><span>EMAIL</span></div> -->
        <div><span>Fecha</span> {{ $date }} </div>
      </div>
    </header>

	<section class="general_content">
    <div class="payment_leyent" >
        <p>RECIBO</p>
        <p>  Yo, Licenciado ADRIAN VENTURA DÁVILA, Notario Público Número CINCUENTA Y CINCO de las 
          del Estado, con despacho ubicado en la calle Montes Himalaya trescientos cuatro,Fraccionamiento Los Bosques de esta Ciudad, 
          RECIBI POR CONCEPTO DE HONORARIOS LA CANTIDAD DE: <strong>${{ $Payment->amount_to_pay}}</strong> MN POR PARTE DE <strong>{{ $Payment->name}}</strong> 
          POR LOS SIGUIENTES CONCEPTOS: <strong>{{ $Payment->concept }}</strong> </p>
        <p> Teniendo un adeudo de :<strong> ${{ $ServiceCase->remaining}}</strong></p>
    </div>
  
	</section>

	</body>
</html>